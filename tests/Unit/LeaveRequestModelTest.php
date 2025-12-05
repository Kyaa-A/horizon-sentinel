<?php

namespace Tests\Unit;

use App\Enums\LeaveStatus;
use App\Enums\UserRole;
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeaveRequestModelTest extends TestCase
{
    use RefreshDatabase;

    protected User $manager;

    protected User $employee;

    protected function setUp(): void
    {
        parent::setUp();

        $this->manager = User::factory()->create(['role' => 'manager']);
        $this->employee = User::factory()->create([
            'role' => 'employee',
            'manager_id' => $this->manager->id,
        ]);
    }

    public function test_leave_request_belongs_to_user(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
        ]);

        $this->assertInstanceOf(User::class, $leaveRequest->user);
        $this->assertEquals($this->employee->id, $leaveRequest->user->id);
    }

    public function test_leave_request_belongs_to_manager(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
        ]);

        $this->assertInstanceOf(User::class, $leaveRequest->manager);
        $this->assertEquals($this->manager->id, $leaveRequest->manager->id);
    }

    public function test_status_check_methods(): void
    {
        $pending = LeaveRequest::factory()->create(['status' => 'pending']);
        $approved = LeaveRequest::factory()->create(['status' => 'approved']);
        $denied = LeaveRequest::factory()->create(['status' => 'denied']);
        $cancelled = LeaveRequest::factory()->create(['status' => 'cancelled']);

        $this->assertTrue($pending->isPending());
        $this->assertFalse($pending->isApproved());
        $this->assertFalse($pending->isDenied());
        $this->assertFalse($pending->isCancelled());

        $this->assertTrue($approved->isApproved());
        $this->assertFalse($approved->isPending());

        $this->assertTrue($denied->isDenied());
        $this->assertFalse($denied->isPending());

        $this->assertTrue($cancelled->isCancelled());
        $this->assertFalse($cancelled->isPending());
    }

    public function test_for_manager_scope_filters_by_manager(): void
    {
        $otherManager = User::factory()->create(['role' => 'manager']);

        // Requests for first manager
        LeaveRequest::factory()->count(3)->create([
            'manager_id' => $this->manager->id,
        ]);

        // Requests for other manager
        LeaveRequest::factory()->count(2)->create([
            'manager_id' => $otherManager->id,
        ]);

        $requests = LeaveRequest::forManager($this->manager->id)->get();

        $this->assertCount(3, $requests);
        foreach ($requests as $request) {
            $this->assertEquals($this->manager->id, $request->manager_id);
        }
    }

    public function test_pending_scope_filters_by_status(): void
    {
        LeaveRequest::factory()->count(3)->create(['status' => 'pending']);
        LeaveRequest::factory()->count(2)->create(['status' => 'approved']);
        LeaveRequest::factory()->count(1)->create(['status' => 'denied']);

        $pending = LeaveRequest::pending()->get();

        $this->assertCount(3, $pending);
        foreach ($pending as $request) {
            $this->assertEquals(LeaveStatus::Pending, $request->status);
        }
    }

    public function test_approved_scope_filters_by_status(): void
    {
        LeaveRequest::factory()->count(2)->create(['status' => 'approved']);
        LeaveRequest::factory()->count(3)->create(['status' => 'pending']);

        $approved = LeaveRequest::approved()->get();

        $this->assertCount(2, $approved);
        foreach ($approved as $request) {
            $this->assertEquals(LeaveStatus::Approved, $request->status);
        }
    }

    public function test_overlapping_scope_finds_overlapping_dates(): void
    {
        // Create request from Jan 10-15
        LeaveRequest::factory()->create([
            'start_date' => '2025-01-10',
            'end_date' => '2025-01-15',
        ]);

        // Create request from Jan 20-25 (no overlap)
        LeaveRequest::factory()->create([
            'start_date' => '2025-01-20',
            'end_date' => '2025-01-25',
        ]);

        // Query for overlapping with Jan 12-17 (should find first one)
        $overlapping = LeaveRequest::overlapping('2025-01-12', '2025-01-17')->get();

        $this->assertCount(1, $overlapping);
    }

    public function test_overlapping_scope_finds_requests_that_contain_range(): void
    {
        // Create request from Jan 5-20 (contains the query range)
        LeaveRequest::factory()->create([
            'start_date' => '2025-01-05',
            'end_date' => '2025-01-20',
        ]);

        // Query for Jan 10-15 (contained within first request)
        $overlapping = LeaveRequest::overlapping('2025-01-10', '2025-01-15')->get();

        $this->assertCount(1, $overlapping);
    }

    public function test_overlapping_scope_finds_requests_at_boundaries(): void
    {
        // Create request from Jan 10-15
        LeaveRequest::factory()->create([
            'start_date' => '2025-01-10',
            'end_date' => '2025-01-15',
        ]);

        // Query for Jan 15-20 (overlaps at boundary)
        $overlapping = LeaveRequest::overlapping('2025-01-15', '2025-01-20')->get();

        $this->assertCount(1, $overlapping);
    }

    public function test_record_history_creates_history_entry(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
        ]);

        $history = $leaveRequest->recordHistory(
            'approved',
            $this->manager->id,
            'Looks good!'
        );

        $this->assertDatabaseHas('leave_request_history', [
            'leave_request_id' => $leaveRequest->id,
            'action' => 'approved',
            'performed_by_user_id' => $this->manager->id,
            'notes' => 'Looks good!',
        ]);

        $this->assertEquals('approved', $history->action);
        $this->assertEquals($this->manager->id, $history->performed_by_user_id);
    }

    public function test_leave_request_has_history_relationship(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
        ]);

        $leaveRequest->recordHistory('submitted', $this->employee->id);
        $leaveRequest->recordHistory('approved', $this->manager->id);

        $this->assertCount(2, $leaveRequest->history);
    }

    public function test_dates_are_cast_to_carbon(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'start_date' => '2025-01-10',
            'end_date' => '2025-01-15',
            'submitted_at' => '2025-01-05 10:00:00',
        ]);

        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $leaveRequest->start_date);
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $leaveRequest->end_date);
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $leaveRequest->submitted_at);
    }

    public function test_scope_chaining_works(): void
    {
        // Create pending requests for this manager
        LeaveRequest::factory()->count(2)->create([
            'manager_id' => $this->manager->id,
            'status' => 'pending',
        ]);

        // Create approved requests for this manager
        LeaveRequest::factory()->count(3)->create([
            'manager_id' => $this->manager->id,
            'status' => 'approved',
        ]);

        // Create pending requests for other manager
        $otherManager = User::factory()->create(['role' => 'manager']);
        LeaveRequest::factory()->count(1)->create([
            'manager_id' => $otherManager->id,
            'status' => 'pending',
        ]);

        // Chain scopes
        $requests = LeaveRequest::forManager($this->manager->id)->pending()->get();

        $this->assertCount(2, $requests);
        foreach ($requests as $request) {
            $this->assertEquals($this->manager->id, $request->manager_id);
            $this->assertEquals(LeaveStatus::Pending, $request->status);
        }
    }
}
