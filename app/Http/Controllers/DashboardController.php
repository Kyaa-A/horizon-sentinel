<?php

namespace App\Http\Controllers;

use App\Enums\LeaveStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Redirect to the appropriate dashboard based on user role.
     */
    public function index(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->isHRAdmin()) {
            return redirect()->route('hr-admin.dashboard');
        }

        if ($user->isManager()) {
            return redirect()->route('manager.dashboard');
        }

        return redirect()->route('dashboard');
    }

    /**
     * Display the employee dashboard.
     */
    public function show(Request $request): View
    {
        $user = $request->user();

        // Get all statistics in a single query using selectRaw
        $stats = $user->leaveRequests()
            ->selectRaw('
                COUNT(*) as total,
                SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as approved,
                SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as denied
            ', [LeaveStatus::Pending->value, LeaveStatus::Approved->value, LeaveStatus::Denied->value])
            ->first();

        $totalRequests = $stats->total ?? 0;
        $pendingRequests = $stats->pending ?? 0;
        $approvedRequests = $stats->approved ?? 0;
        $deniedRequests = $stats->denied ?? 0;

        // Get upcoming approved leaves
        $upcomingLeaves = $user->leaveRequests()
            ->where('status', LeaveStatus::Approved)
            ->where('start_date', '>=', now())
            ->orderBy('start_date')
            ->limit(5)
            ->get();

        // Get recent requests
        $recentRequests = $user->leaveRequests()
            ->with('manager')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalRequests',
            'pendingRequests',
            'approvedRequests',
            'deniedRequests',
            'upcomingLeaves',
            'recentRequests'
        ));
    }
}
