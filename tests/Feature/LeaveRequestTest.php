<?php

namespace Tests\Feature;

use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeaveRequestTest extends TestCase
{
    use RefreshDatabase;

    protected User $employee;

    protected User $manager;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a manager
        $this->manager = User::factory()->create([
            'role' => 'manager',
            'manager_id' => null,
        ]);

        // Create an employee with the manager
        $this->employee = User::factory()->create([
            'role' => 'employee',
            'manager_id' => $this->manager->id,
        ]);
    }

    public function test_employee_can_view_leave_requests_index(): void
    {
        $this->actingAs($this->employee);

        $response = $this->get(route('leave-requests.index'));

        $response->assertOk();
        $response->assertViewIs('leave-requests.index');
    }

    public function test_employee_can_view_create_leave_request_form(): void
    {
        $this->actingAs($this->employee);

        $response = $this->get(route('leave-requests.create'));

        $response->assertOk();
        $response->assertViewIs('leave-requests.create');
    }

    public function test_employee_can_submit_leave_request(): void
    {
        $this->actingAs($this->employee);

        $requestData = [
            'leave_type' => 'vacation',
            'start_date' => now()->addDays(7)->format('Y-m-d'),
            'end_date' => now()->addDays(10)->format('Y-m-d'),
            'employee_notes' => 'Family vacation',
        ];

        $response = $this->post(route('leave-requests.store'), $requestData);

        $response->assertRedirect();
        $this->assertDatabaseHas('leave_requests', [
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
            'leave_type' => 'vacation',
            'status' => 'pending',
            'employee_notes' => 'Family vacation',
        ]);

        // Check history record was created
        $leaveRequest = LeaveRequest::where('user_id', $this->employee->id)->first();
        $this->assertDatabaseHas('leave_request_history', [
            'leave_request_id' => $leaveRequest->id,
            'action' => 'submitted',
            'performed_by_user_id' => $this->employee->id,
        ]);
    }

    public function test_employee_cannot_submit_leave_request_without_manager(): void
    {
        $employeeWithoutManager = User::factory()->create([
            'role' => 'employee',
            'manager_id' => null,
        ]);

        $this->actingAs($employeeWithoutManager);

        $requestData = [
            'leave_type' => 'vacation',
            'start_date' => now()->addDays(7)->format('Y-m-d'),
            'end_date' => now()->addDays(10)->format('Y-m-d'),
            'employee_notes' => 'Family vacation',
        ];

        $response = $this->post(route('leave-requests.store'), $requestData);

        $response->assertSessionHasErrors('manager');
        $this->assertDatabaseMissing('leave_requests', [
            'user_id' => $employeeWithoutManager->id,
        ]);
    }

    public function test_leave_request_requires_valid_dates(): void
    {
        $this->actingAs($this->employee);

        // Test past start date
        $response = $this->post(route('leave-requests.store'), [
            'leave_type' => 'vacation',
            'start_date' => now()->subDays(1)->format('Y-m-d'),
            'end_date' => now()->addDays(5)->format('Y-m-d'),
        ]);

        $response->assertSessionHasErrors('start_date');

        // Test end date before start date
        $response = $this->post(route('leave-requests.store'), [
            'leave_type' => 'vacation',
            'start_date' => now()->addDays(10)->format('Y-m-d'),
            'end_date' => now()->addDays(5)->format('Y-m-d'),
        ]);

        $response->assertSessionHasErrors('end_date');
    }

    public function test_leave_request_requires_valid_leave_type(): void
    {
        $this->actingAs($this->employee);

        $response = $this->post(route('leave-requests.store'), [
            'leave_type' => 'invalid_type',
            'start_date' => now()->addDays(7)->format('Y-m-d'),
            'end_date' => now()->addDays(10)->format('Y-m-d'),
        ]);

        $response->assertSessionHasErrors('leave_type');
    }

    public function test_employee_can_view_their_own_leave_request(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
        ]);

        $this->actingAs($this->employee);

        $response = $this->get(route('leave-requests.show', $leaveRequest));

        $response->assertOk();
        $response->assertViewIs('leave-requests.show');
        $response->assertViewHas('leaveRequest', $leaveRequest);
    }

    public function test_employee_cannot_view_other_employee_leave_request(): void
    {
        $otherEmployee = User::factory()->create([
            'role' => 'employee',
            'manager_id' => $this->manager->id,
        ]);

        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $otherEmployee->id,
            'manager_id' => $this->manager->id,
        ]);

        $this->actingAs($this->employee);

        $response = $this->get(route('leave-requests.show', $leaveRequest));

        $response->assertForbidden();
    }

    public function test_employee_can_cancel_pending_leave_request(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
            'status' => 'pending',
        ]);

        $this->actingAs($this->employee);

        $response = $this->patch(route('leave-requests.cancel', $leaveRequest));

        $response->assertRedirect();
        $this->assertDatabaseHas('leave_requests', [
            'id' => $leaveRequest->id,
            'status' => 'cancelled',
        ]);

        // Check history record was created
        $this->assertDatabaseHas('leave_request_history', [
            'leave_request_id' => $leaveRequest->id,
            'action' => 'cancelled',
            'performed_by_user_id' => $this->employee->id,
        ]);
    }

    public function test_employee_can_cancel_approved_leave_request(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
            'status' => 'approved',
        ]);

        $this->actingAs($this->employee);

        $response = $this->patch(route('leave-requests.cancel', $leaveRequest));

        $response->assertRedirect();
        $this->assertDatabaseHas('leave_requests', [
            'id' => $leaveRequest->id,
            'status' => 'cancelled',
        ]);
    }

    public function test_employee_cannot_cancel_denied_leave_request(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
            'status' => 'denied',
        ]);

        $this->actingAs($this->employee);

        $response = $this->patch(route('leave-requests.cancel', $leaveRequest));

        $response->assertForbidden();
        $this->assertDatabaseHas('leave_requests', [
            'id' => $leaveRequest->id,
            'status' => 'denied', // Status unchanged
        ]);
    }

    public function test_employee_cannot_cancel_already_cancelled_leave_request(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
            'status' => 'cancelled',
        ]);

        $this->actingAs($this->employee);

        $response = $this->patch(route('leave-requests.cancel', $leaveRequest));

        $response->assertForbidden();
    }

    public function test_manager_can_view_team_member_leave_request(): void
    {
        $leaveRequest = LeaveRequest::factory()->create([
            'user_id' => $this->employee->id,
            'manager_id' => $this->manager->id,
        ]);

        $this->actingAs($this->manager);

        $response = $this->get(route('leave-requests.show', $leaveRequest));

        $response->assertOk();
        $response->assertViewIs('leave-requests.show');
    }

    public function test_guest_cannot_access_leave_requests(): void
    {
        $response = $this->get(route('leave-requests.index'));
        $response->assertRedirect(route('login'));

        $response = $this->get(route('leave-requests.create'));
        $response->assertRedirect(route('login'));
    }
}
