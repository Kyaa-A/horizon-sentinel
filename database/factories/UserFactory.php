<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'employee',
            'manager_id' => null,
            'department' => fake()->randomElement(['Engineering', 'Marketing', 'Sales', 'HR', 'Finance', null]),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the user is an employee.
     */
    public function employee(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'employee',
        ]);
    }

    /**
     * Indicate that the user is a manager.
     */
    public function manager(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'manager',
            'manager_id' => null,
        ]);
    }

    /**
     * Indicate that the user is an HR admin.
     */
    public function hrAdmin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'hr_admin',
            'manager_id' => null,
        ]);
    }

    /**
     * Set the manager for this user.
     */
    public function withManager(User $manager): static
    {
        return $this->state(fn (array $attributes) => [
            'manager_id' => $manager->id,
        ]);
    }

    /**
     * Set a specific department.
     */
    public function inDepartment(string $department): static
    {
        return $this->state(fn (array $attributes) => [
            'department' => $department,
        ]);
    }
}
