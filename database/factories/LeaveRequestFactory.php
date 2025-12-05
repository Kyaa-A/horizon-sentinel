<?php

namespace Database\Factories;

use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveRequest>
 */
class LeaveRequestFactory extends Factory
{
    protected $model = LeaveRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('+1 week', '+3 months');
        $endDate = fake()->dateTimeBetween($startDate, $startDate->format('Y-m-d') . ' +2 weeks');

        return [
            'user_id' => User::factory(),
            'manager_id' => User::factory()->state(['role' => 'manager']),
            'leave_type' => fake()->randomElement(['paid_time_off', 'unpaid_leave', 'sick_leave', 'vacation']),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => max(1, (new \DateTime($endDate->format('Y-m-d')))->diff(new \DateTime($startDate->format('Y-m-d')))->days + 1),
            'status' => 'pending',
            'employee_notes' => fake()->optional(0.7)->sentence(),
            'manager_notes' => null,
            'attachment_path' => null,
            'submitted_at' => now(),
            'reviewed_at' => null,
        ];
    }

    /**
     * Indicate that the leave request is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'reviewed_at' => null,
            'manager_notes' => null,
        ]);
    }

    /**
     * Indicate that the leave request is approved.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
            'reviewed_at' => now(),
            'manager_notes' => fake()->optional(0.5)->sentence(),
        ]);
    }

    /**
     * Indicate that the leave request is denied.
     */
    public function denied(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'denied',
            'reviewed_at' => now(),
            'manager_notes' => fake()->sentence(),
        ]);
    }

    /**
     * Indicate that the leave request is cancelled.
     */
    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'cancelled',
            'reviewed_at' => null,
        ]);
    }

    /**
     * Set a specific leave type.
     */
    public function ofType(string $type): static
    {
        return $this->state(fn (array $attributes) => [
            'leave_type' => $type,
        ]);
    }

    /**
     * Set specific date range.
     */
    public function forDates(string $startDate, string $endDate): static
    {
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        $totalDays = max(1, $end->diff($start)->days + 1);

        return $this->state(fn (array $attributes) => [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => $totalDays,
        ]);
    }

    /**
     * Set the employee (user) for this leave request.
     */
    public function forEmployee(User $employee): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $employee->id,
            'manager_id' => $employee->manager_id,
        ]);
    }

    /**
     * Set the manager for this leave request.
     */
    public function forManager(User $manager): static
    {
        return $this->state(fn (array $attributes) => [
            'manager_id' => $manager->id,
        ]);
    }
}
