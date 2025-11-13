<?php

namespace Tests\Unit;

use App\Models\LeaveRequest;
use App\Models\User;
use App\Services\ConflictDetectionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConflictDetectionServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ConflictDetectionService $service;

    protected User $manager;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new ConflictDetectionService;

        $this->manager = User::factory()->create([
            'role' => 'manager',
            'manager_id' => null,
        ]);
    }

    public function test_detects_no_conflicts_for_first_leave_request(): void
    {
        $employee = User::factory()->create([
            'role' => 'employee',
            'manager_id' => $this->manager->id,
        ]);

        $leaveRequest = LeaveRequest::factory()->make([
            'user_id' => $employee->id,
            'manager_id' => $this->manager->id,
            'start_date' => now()->addDays(7),
            'end_date' => now()->addDays(10),
            'status' => 'pending',
        ]);

        $conflicts = $this->service->checkConflicts($leaveRequest, $this->manager->id);

        $this->assertEmpty($conflicts);
    }

    public function test_detects_overlap_conflict_with_one_team_member(): void
    {
        $employee1 = User::factory()->create([
            'role' => 'employee',
            'manager_id' => $this->manager->id,
        ]);

        $employee2 = User::factory()->create([
            'role' => 'employee',
            'manager_id' => $this->manager->id,
        ]);

        // Create existing approved leave
        LeaveRequest::factory()->create([
            'user_id' => $employee1->id,
            'manager_id' => $this->manager->id,
            'start_date' => now()->addDays(7),
            'end_date' => now()->addDays(10),
            'status' => 'approved',
        ]);

        // New overlapping request
        $newRequest = LeaveRequest::factory()->make([
            'user_id' => $employee2->id,
            'manager_id' => $this->manager->id,
            'start_date' => now()->addDays(8),
            'end_date' => now()->addDays(12),
            'status' => 'pending',
        ]);

        $conflicts = $this->service->checkConflicts($newRequest, $this->manager->id);

        $this->assertNotEmpty($conflicts);

        $overlapConflict = collect($conflicts)->firstWhere('type', 'overlap');
        $this->assertNotNull($overlapConflict);
        $this->assertEquals('medium', $overlapConflict['severity']);
        $this->assertCount(1, $overlapConflict['details']);
    }

    public function test_detects_high_severity_with_two_overlapping_leaves(): void
    {
        $employees = User::factory()->count(3)->create([
            'role' => 'employee',
            'manager_id' => $this->manager->id,
        ]);

        // Create two existing approved leaves
        LeaveRequest::factory()->create([
            'user_id' => $employees[0]->id,
            'manager_id' => $this->manager->id,
            'start_date' => now()->addDays(7),
            'end_date' => now()->addDays(10),
            'status' => 'approved',
        ]);

        LeaveRequest::factory()->create([
            'user_id' => $employees[1]->id,
            'manager_id' => $this->manager->id,
            'start_date' => now()->addDays(8),
            'end_date' => now()->addDays(11),
            'status' => 'approved',
        ]);

        // New overlapping request
        $newRequest = LeaveRequest::factory()->make([
            'user_id' => $employees[2]->id,
            'manager_id' => $this->manager->id,
            'start_date' => now()->addDays(9),
            'end_date' => now()->addDays(12),
            'status' => 'pending',
        ]);

        $conflicts = $this->service->checkConflicts($newRequest, $this->manager->id);

        $overlapConflict = collect($conflicts)->firstWhere('type', 'overlap');
        $this->assertNotNull($overlapConflict);
        $this->assertEquals('high', $overlapConflict['severity']);
        $this->assertCount(2, $overlapConflict['details']);
    }

    public function test_detects_critical_severity_with_three_or_more_overlapping_leaves(): void
    {
        $employees = User::factory()->count(4)->create([
            'role' => 'employee',
            'manager_id' => $this->manager->id,
        ]);

        // Create three existing approved leaves
        for ($i = 0; $i < 3; $i++) {
            LeaveRequest::factory()->create([
                'user_id' => $employees[$i]->id,
                'manager_id' => $this->manager->id,
                'start_date' => now()->addDays(7),
                'end_date' => now()->addDays(10),
                'status' => 'approved',
            ]);
        }

        // New overlapping request
        $newRequest = LeaveRequest::factory()->make([
            'user_id' => $employees[3]->id,
            'manager_id' => $this->manager->id,
            'start_date' => now()->addDays(8),
            'end_date' => now()->addDays(9),
            'status' => 'pending',
        ]);

        $conflicts = $this->service->checkConflicts($newRequest, $this->manager->id);

        $overlapConflict = collect($conflicts)->firstWhere('type', 'overlap');
        $this->assertNotNull($overlapConflict);
        $this->assertEquals('critical', $overlapConflict['severity']);
        $this->assertCount(3, $overlapConflict['details']);
    }

    public function test_calculates_team_availability_correctly(): void
    {
        // Create team of 10 employees
        $employees = User::factory()->count(10)->create([
            'role' => 'employee',
            'manager_id' => $this->manager->id,
        ]);

        // 3 employees on approved leave
        for ($i = 0; $i < 3; $i++) {
            LeaveRequest::factory()->create([
                'user_id' => $employees[$i]->id,
                'manager_id' => $this->manager->id,
                'start_date' => now()->addDays(7),
                'end_date' => now()->addDays(10),
                'status' => 'approved',
            ]);
        }

        $availability = $this->service->calculateTeamAvailability(
            $this->manager->id,
            now()->addDays(7),
            now()->addDays(10)
        );

        $this->assertEquals(10, $availability['team_size']);
        $this->assertEquals(7, $availability['available']);
        $this->assertEquals(3, $availability['on_leave']);
        $this->assertEquals(70.0, $availability['percentage']);
    }

    public function test_detects_availability_threshold_conflict(): void
    {
        // Create team of 5 employees
        $employees = User::factory()->count(5)->create([
            'role' => 'employee',
            'manager_id' => $this->manager->id,
        ]);

        // 4 employees already on leave (80% of team)
        for ($i = 0; $i < 4; $i++) {
            LeaveRequest::factory()->create([
                'user_id' => $employees[$i]->id,
                'manager_id' => $this->manager->id,
                'start_date' => now()->addDays(7),
                'end_date' => now()->addDays(10),
                'status' => 'approved',
            ]);
        }

        // 5th employee requests leave
        $newRequest = LeaveRequest::factory()->make([
            'user_id' => $employees[4]->id,
            'manager_id' => $this->manager->id,
            'start_date' => now()->addDays(8),
            'end_date' => now()->addDays(9),
            'status' => 'pending',
        ]);

        $conflicts = $this->service->checkConflicts($newRequest, $this->manager->id);

        $availabilityConflict = collect($conflicts)->firstWhere('type', 'availability');
        $this->assertNotNull($availabilityConflict);
        $this->assertEquals('high', $availabilityConflict['severity']);
    }

    public function test_ignores_denied_and_cancelled_requests_in_conflict_detection(): void
    {
        $employees = User::factory()->count(3)->create([
            'role' => 'employee',
            'manager_id' => $this->manager->id,
        ]);

        // Create denied request
        LeaveRequest::factory()->create([
            'user_id' => $employees[0]->id,
            'manager_id' => $this->manager->id,
            'start_date' => now()->addDays(7),
            'end_date' => now()->addDays(10),
            'status' => 'denied',
        ]);

        // Create cancelled request
        LeaveRequest::factory()->create([
            'user_id' => $employees[1]->id,
            'manager_id' => $this->manager->id,
            'start_date' => now()->addDays(7),
            'end_date' => now()->addDays(10),
            'status' => 'cancelled',
        ]);

        // New request should have no conflicts
        $newRequest = LeaveRequest::factory()->make([
            'user_id' => $employees[2]->id,
            'manager_id' => $this->manager->id,
            'start_date' => now()->addDays(8),
            'end_date' => now()->addDays(9),
            'status' => 'pending',
        ]);

        $conflicts = $this->service->checkConflicts($newRequest, $this->manager->id);

        $this->assertEmpty($conflicts);
    }

    public function test_conflict_summary_counts_by_severity(): void
    {
        $employees = User::factory()->count(6)->create([
            'role' => 'employee',
            'manager_id' => $this->manager->id,
        ]);

        // Create critical conflict scenario (3 overlapping)
        for ($i = 0; $i < 3; $i++) {
            LeaveRequest::factory()->create([
                'user_id' => $employees[$i]->id,
                'manager_id' => $this->manager->id,
                'start_date' => now()->addDays(7),
                'end_date' => now()->addDays(10),
                'status' => 'approved',
            ]);
        }

        // Pending request that will have critical conflict
        LeaveRequest::factory()->create([
            'user_id' => $employees[3]->id,
            'manager_id' => $this->manager->id,
            'start_date' => now()->addDays(8),
            'end_date' => now()->addDays(9),
            'status' => 'pending',
        ]);

        // Create high conflict scenario (2 overlapping, different dates)
        for ($i = 4; $i < 6; $i++) {
            LeaveRequest::factory()->create([
                'user_id' => $employees[$i]->id,
                'manager_id' => $this->manager->id,
                'start_date' => now()->addDays(15),
                'end_date' => now()->addDays(18),
                'status' => 'approved',
            ]);
        }

        // Another pending request with high conflict
        $anotherEmployee = User::factory()->create([
            'role' => 'employee',
            'manager_id' => $this->manager->id,
        ]);

        LeaveRequest::factory()->create([
            'user_id' => $anotherEmployee->id,
            'manager_id' => $this->manager->id,
            'start_date' => now()->addDays(16),
            'end_date' => now()->addDays(17),
            'status' => 'pending',
        ]);

        $summary = $this->service->getConflictSummary($this->manager->id);

        $this->assertEquals(2, $summary['pending_requests']);
        $this->assertGreaterThanOrEqual(1, $summary['critical_conflicts']);
        $this->assertGreaterThanOrEqual(0, $summary['high_conflicts']);
    }

    public function test_handles_empty_team_availability(): void
    {
        // Manager with no employees
        $availability = $this->service->calculateTeamAvailability(
            $this->manager->id,
            now(),
            now()->addDays(30)
        );

        $this->assertEquals(0, $availability['team_size']);
        $this->assertEquals(0, $availability['available']);
        $this->assertEquals(0, $availability['on_leave']);
        $this->assertEquals(0, $availability['percentage']);
    }
}
