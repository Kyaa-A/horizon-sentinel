<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Services\ConflictDetectionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ManagerController extends Controller
{
    public function __construct(protected ConflictDetectionService $conflictService)
    {
        // Ensure only managers can access these methods
        $this->middleware(function ($request, $next) {
            if (! $request->user()->isManager()) {
                abort(403, 'Access denied. Manager privileges required.');
            }

            return $next($request);
        });
    }

    /**
     * Display the manager dashboard.
     */
    public function dashboard(Request $request): View
    {
        $user = $request->user();

        // Get statistics
        $pendingCount = LeaveRequest::forManager($user->id)->pending()->count();
        $approvedThisMonth = LeaveRequest::forManager($user->id)
            ->approved()
            ->whereMonth('reviewed_at', now()->month)
            ->whereYear('reviewed_at', now()->year)
            ->count();

        // Get recent pending requests
        $recentRequests = LeaveRequest::with(['user'])
            ->forManager($user->id)
            ->pending()
            ->orderByDesc('submitted_at')
            ->limit(5)
            ->get();

        // Get upcoming approved leaves
        $upcomingLeaves = LeaveRequest::with(['user'])
            ->forManager($user->id)
            ->approved()
            ->where('start_date', '>=', now())
            ->orderBy('start_date')
            ->limit(5)
            ->get();

        // Get conflict summary
        $conflictSummary = $this->conflictService->getConflictSummary($user->id);

        // Get current team availability (next 30 days)
        $currentAvailability = $this->conflictService->calculateTeamAvailability(
            $user->id,
            now(),
            now()->addDays(30)
        );

        return view('manager.dashboard', [
            'pendingCount' => $pendingCount,
            'approvedThisMonth' => $approvedThisMonth,
            'teamSize' => $user->directReports()->count(),
            'recentRequests' => $recentRequests,
            'upcomingLeaves' => $upcomingLeaves,
            'conflictSummary' => $conflictSummary,
            'currentAvailability' => $currentAvailability,
        ]);
    }

    /**
     * Display all pending leave requests from the manager's team.
     */
    public function pendingRequests(Request $request): View
    {
        $user = $request->user();

        $pendingRequests = LeaveRequest::with(['user'])
            ->forManager($user->id)
            ->pending()
            ->orderByDesc('submitted_at')
            ->paginate(20);

        // Check for conflicts for each request using the service
        foreach ($pendingRequests as $leaveRequest) {
            $leaveRequest->conflicts = $this->conflictService->checkConflicts($leaveRequest, $user->id);
        }

        return view('manager.pending-requests', [
            'pendingRequests' => $pendingRequests,
        ]);
    }

    /**
     * Show a specific leave request for review.
     */
    public function showRequest(LeaveRequest $leaveRequest): View
    {
        // Ensure the request belongs to this manager's team
        if ($leaveRequest->manager_id !== auth()->id()) {
            abort(403, 'You can only review requests from your team.');
        }

        $leaveRequest->load(['user', 'manager', 'history.performedBy']);

        // Check for conflicts using the service
        $conflicts = $this->conflictService->checkConflicts($leaveRequest, auth()->id());

        return view('manager.review-request', [
            'leaveRequest' => $leaveRequest,
            'conflicts' => $conflicts,
        ]);
    }

    /**
     * Approve a leave request.
     */
    public function approve(Request $request, LeaveRequest $leaveRequest): RedirectResponse
    {
        // Ensure the request belongs to this manager's team
        if ($leaveRequest->manager_id !== $request->user()->id) {
            abort(403, 'You can only approve requests from your team.');
        }

        if (! $leaveRequest->isPending()) {
            return back()->withErrors(['status' => 'Only pending requests can be approved.']);
        }

        $request->validate([
            'manager_notes' => 'nullable|string|max:1000',
        ]);

        $leaveRequest->update([
            'status' => 'approved',
            'manager_notes' => $request->manager_notes,
            'reviewed_at' => now(),
        ]);

        $leaveRequest->recordHistory(
            'approved',
            $request->user()->id,
            'Approved by manager'.($request->manager_notes ? ': '.$request->manager_notes : '')
        );

        return redirect()
            ->route('manager.pending-requests')
            ->with('success', 'Leave request approved successfully!');
    }

    /**
     * Deny a leave request.
     */
    public function deny(Request $request, LeaveRequest $leaveRequest): RedirectResponse
    {
        // Ensure the request belongs to this manager's team
        if ($leaveRequest->manager_id !== $request->user()->id) {
            abort(403, 'You can only deny requests from your team.');
        }

        if (! $leaveRequest->isPending()) {
            return back()->withErrors(['status' => 'Only pending requests can be denied.']);
        }

        $request->validate([
            'manager_notes' => 'required|string|max:1000',
        ], [
            'manager_notes.required' => 'Please provide a reason for denying this request.',
        ]);

        $leaveRequest->update([
            'status' => 'denied',
            'manager_notes' => $request->manager_notes,
            'reviewed_at' => now(),
        ]);

        $leaveRequest->recordHistory(
            'denied',
            $request->user()->id,
            'Denied by manager: '.$request->manager_notes
        );

        return redirect()
            ->route('manager.pending-requests')
            ->with('success', 'Leave request denied.');
    }

    /**
     * Display team calendar with all approved leaves.
     */
    public function teamCalendar(Request $request): View
    {
        $user = $request->user();

        // Get month and year from request, default to current
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $startDate = now()->setYear($year)->setMonth($month)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        // Get all approved and pending leaves for the month
        $leaves = LeaveRequest::with(['user'])
            ->forManager($user->id)
            ->whereIn('status', ['approved', 'pending'])
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        $q->where('start_date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            })
            ->orderBy('start_date')
            ->get();

        // Get daily availability breakdown
        $dailyAvailability = $this->conflictService->getDailyAvailability($user->id, $startDate);

        // Get month availability summary
        $monthAvailability = $this->conflictService->calculateTeamAvailability(
            $user->id,
            $startDate,
            $endDate
        );

        return view('manager.team-calendar', [
            'leaves' => $leaves,
            'currentMonth' => $startDate,
            'teamSize' => $user->directReports()->count(),
            'dailyAvailability' => $dailyAvailability,
            'monthAvailability' => $monthAvailability,
        ]);
    }
}
