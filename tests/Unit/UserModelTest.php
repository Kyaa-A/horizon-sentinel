<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_be_manager(): void
    {
        $manager = User::factory()->create(['role' => 'manager']);

        $this->assertTrue($manager->isManager());
        $this->assertFalse($manager->isEmployee());
    }

    public function test_user_can_be_employee(): void
    {
        $employee = User::factory()->create(['role' => 'employee']);

        $this->assertTrue($employee->isEmployee());
        $this->assertFalse($employee->isManager());
    }

    public function test_user_has_manager_relationship(): void
    {
        $manager = User::factory()->create(['role' => 'manager']);
        $employee = User::factory()->create([
            'role' => 'employee',
            'manager_id' => $manager->id,
        ]);

        $this->assertInstanceOf(User::class, $employee->manager);
        $this->assertEquals($manager->id, $employee->manager->id);
    }

    public function test_user_has_direct_reports_relationship(): void
    {
        $manager = User::factory()->create(['role' => 'manager']);
        $employees = User::factory()->count(5)->create([
            'role' => 'employee',
            'manager_id' => $manager->id,
        ]);

        $this->assertCount(5, $manager->directReports);

        foreach ($manager->directReports as $employee) {
            $this->assertEquals($manager->id, $employee->manager_id);
        }
    }

    public function test_user_has_leave_requests_relationship(): void
    {
        $employee = User::factory()->create(['role' => 'employee']);

        // We'll test this exists without creating actual leave requests
        // since that would require manager setup
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $employee->leaveRequests());
    }

    public function test_user_can_check_if_has_manager(): void
    {
        $manager = User::factory()->create(['role' => 'manager']);
        $employeeWithManager = User::factory()->create([
            'role' => 'employee',
            'manager_id' => $manager->id,
        ]);
        $employeeWithoutManager = User::factory()->create([
            'role' => 'employee',
            'manager_id' => null,
        ]);

        $this->assertTrue($employeeWithManager->hasManager());
        $this->assertFalse($employeeWithoutManager->hasManager());
    }

    public function test_manager_can_have_no_direct_reports(): void
    {
        $manager = User::factory()->create(['role' => 'manager']);

        $this->assertCount(0, $manager->directReports);
    }

    public function test_user_default_role_is_employee(): void
    {
        $user = User::factory()->create();

        $this->assertEquals('employee', $user->role);
        $this->assertTrue($user->isEmployee());
    }
}
