<?php

namespace Tests\Feature;

use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManagerTest extends TestCase
{
    use RefreshDatabase;

    protected User $employee;

    protected User $manager;

    protected User $otherManager;

    protected function setUp(): void
    {
        parent::setUp();

        // Create managers
        $this->manager = User::factory()->create([
            'role' => 'manager',
            'manager_id' => null,
        ]);

        $this->otherManager = User::factory()->create([
            'role' => 'manager',
            'manager_id' => null,
        ]);

        // Create an employee under the first manager
        $this->employee = User::factory()->create([
            'role' => 'employee',
            'manager_id' => $this->manager->id,
        ]);
    }

    public function test_manager_can_access_dashboard(): void
    {
        $this->actingAs($this->manager);

        $response = $this->get(route('manager.dashboard'));

        $response->assertOk();
        $response->assertViewIs('manager.dashboard');
    }

    public function test_employee_cannot_access_manager_dashboard(): void
    {
        $this->actingAs($this->employee);

        $response = $this->get(route('manager.dashboard'));

        $response->assertForbidden();
    }

    public function test_manager_can_view_pending_requests(): void
    {
        $this->actingAs($this->manager);

        $response = $this->get(route('manager.pending-requests'));

        $response->assertOk();
        $response->assertViewIs('manager.pending-requests');
    }

    public function test_manager_can_view_team_calendar(): void
    {
        $this->actingAs($this->manager);

        $response = $this->get(route('manager.team-calendar'));

        $response->assertOk();
        $response->assertViewIs('manager.team-calendar');
    }

    public function test_manager_can_view_team_member_leave_request(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
            'status' => 'pending',
        ]);

        $this->actingAs($this->manager);

        $response = $this->get(route('manager.show-request', $leaveRequest));

        $response->assertOk();
        $response->assertViewIs('manager.review-request');
        $response->assertViewHas('leaveRequest', $leaveRequest);
    }

    public function test_manager_cannot_view_other_managers_team_request(): void
    {
        $otherEmployee = User::factory()->create([
            'role' => 'employee',
            'manager_id' => $this->otherManager->id,
        ]);

        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $otherEmployee->id,
            'manager_id' => $this->otherManager->id,
            'status' => 'pending',
        ]);

        $this->actingAs($this->manager);

        $response = $this->get(route('manager.show-request', $leaveRequest));

        $response->assertForbidden();
    }

    public function test_manager_can_approve_team_member_leave_request(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
            'status' => 'pending',
        ]);

        $this->actingAs($this->manager);

        $response = $this->post(route('manager.approve', $leaveRequest), [
            'manager_notes' => 'Approved - enjoy your time off!',
        ]);

        $response->assertRedirect(route('manager.pending-requests'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('leave_requests', [
            'id' => $leaveRequest->id,
            'status' => 'approved',
            'manager_notes' => 'Approved - enjoy your time off!',
        ]);

        // Check history record was created
        $this->assertDatabaseHas('leave_request_history', [
            'leave_request_id' => $leaveRequest->id,
            'action' => 'approved',
            'performed_by_user_id' => $this->manager->id,
        ]);

        // Check reviewed_at timestamp was set
        $leaveRequest->refresh();
        $this->assertNotNull($leaveRequest->reviewed_at);
    }

    public function test_manager_can_deny_team_member_leave_request(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
            'status' => 'pending',
        ]);

        $this->actingAs($this->manager);

        $response = $this->post(route('manager.deny', $leaveRequest), [
            'manager_notes' => 'Insufficient staffing during this period',
        ]);

        $response->assertRedirect(route('manager.pending-requests'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('leave_requests', [
            'id' => $leaveRequest->id,
            'status' => 'denied',
            'manager_notes' => 'Insufficient staffing during this period',
        ]);

        // Check history record was created
        $this->assertDatabaseHas('leave_request_history', [
            'leave_request_id' => $leaveRequest->id,
            'action' => 'denied',
            'performed_by_user_id' => $this->manager->id,
        ]);

        // Check reviewed_at timestamp was set
        $leaveRequest->refresh();
        $this->assertNotNull($leaveRequest->reviewed_at);
    }

    public function test_manager_must_provide_notes_when_denying(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
            'status' => 'pending',
        ]);

        $this->actingAs($this->manager);

        $response = $this->post(route('manager.deny', $leaveRequest), [
            'manager_notes' => '',
        ]);

        $response->assertSessionHasErrors('manager_notes');

        $this->assertDatabaseHas('leave_requests', [
            'id' => $leaveRequest->id,
            'status' => 'pending', // Status unchanged
        ]);
    }

    public function test_manager_cannot_approve_other_managers_team_request(): void
    {
        $otherEmployee = User::factory()->create([
            'role' => 'employee',
            'manager_id' => $this->otherManager->id,
        ]);

        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $otherEmployee->id,
            'manager_id' => $this->otherManager->id,
            'status' => 'pending',
        ]);

        $this->actingAs($this->manager);

        $response = $this->post(route('manager.approve', $leaveRequest));

        $response->assertForbidden();

        $this->assertDatabaseHas('leave_requests', [
            'id' => $leaveRequest->id,
            'status' => 'pending', // Status unchanged
        ]);
    }

    public function test_manager_cannot_deny_other_managers_team_request(): void
    {
        $otherEmployee = User::factory()->create([
            'role' => 'employee',
            'manager_id' => $this->otherManager->id,
        ]);

        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $otherEmployee->id,
            'manager_id' => $this->otherManager->id,
            'status' => 'pending',
        ]);

        $this->actingAs($this->manager);

        $response = $this->post(route('manager.deny', $leaveRequest), [
            'manager_notes' => 'Some reason',
        ]);

        $response->assertForbidden();

        $this->assertDatabaseHas('leave_requests', [
            'id' => $leaveRequest->id,
            'status' => 'pending', // Status unchanged
        ]);
    }

    public function test_manager_cannot_approve_already_approved_request(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
            'status' => 'approved',
        ]);

        $this->actingAs($this->manager);

        $response = $this->post(route('manager.approve', $leaveRequest));

        $response->assertSessionHasErrors('status');
    }

    public function test_manager_cannot_deny_already_denied_request(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
            'status' => 'denied',
        ]);

        $this->actingAs($this->manager);

        $response = $this->post(route('manager.deny', $leaveRequest), [
            'manager_notes' => 'Some reason',
        ]);

        $response->assertSessionHasErrors('status');
    }

    public function test_dashboard_shows_correct_statistics(): void
    {
        // Create various leave requests
        LeaveRequest::factory()->count(3)->create([
            'manager_id' => $this->manager->id,
            'status' => 'pending',
        ]);

        LeaveRequest::factory()->count(2)->create([
            'manager_id' => $this->manager->id,
            'status' => 'approved',
            'reviewed_at' => now(),
        ]);

        $this->actingAs($this->manager);

        $response = $this->get(route('manager.dashboard'));

        $response->assertOk();
        $response->assertViewHas('pendingCount', 3);
        $response->assertViewHas('approvedThisMonth', 2);
    }

    public function test_pending_requests_page_shows_only_managers_team_requests(): void
    {
        // Create requests for this manager's team
        LeaveRequest::factory()->count(2)->create([
            'manager_id' => $this->manager->id,
            'status' => 'pending',
        ]);

        // Create requests for other manager's team
        LeaveRequest::factory()->count(3)->create([
            'manager_id' => $this->otherManager->id,
            'status' => 'pending',
        ]);

        $this->actingAs($this->manager);

        $response = $this->get(route('manager.pending-requests'));

        $response->assertOk();
        $pendingRequests = $response->viewData('pendingRequests');

        // Should only see 2 requests from their own team
        $this->assertCount(2, $pendingRequests);

        // Verify all requests belong to this manager
        foreach ($pendingRequests as $request) {
            $this->assertEquals($this->manager->id, $request->manager_id);
        }
    }

    public function test_team_calendar_shows_only_managers_team_leaves(): void
    {
        // Create approved leaves for this manager's team
        LeaveRequest::factory()->count(2)->create([
            'manager_id' => $this->manager->id,
            'status' => 'approved',
            'start_date' => now()->startOfMonth(),
            'end_date' => now()->startOfMonth()->addDays(3),
        ]);

        // Create leaves for other manager's team
        LeaveRequest::factory()->count(3)->create([
            'manager_id' => $this->otherManager->id,
            'status' => 'approved',
            'start_date' => now()->startOfMonth(),
            'end_date' => now()->startOfMonth()->addDays(3),
        ]);

        $this->actingAs($this->manager);

        $response = $this->get(route('manager.team-calendar'));

        $response->assertOk();
        $leaves = $response->viewData('leaves');

        // Should only see 2 leaves from their own team
        $this->assertCount(2, $leaves);

        // Verify all leaves belong to this manager
        foreach ($leaves as $leave) {
            $this->assertEquals($this->manager->id, $leave->manager_id);
        }
    }
}
