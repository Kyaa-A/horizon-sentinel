<?php

namespace Database\Factories;

use App\Models\CompanyHoliday;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyHoliday>
 */
class CompanyHolidayFactory extends Factory
{
    protected $model = CompanyHoliday::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'New Year\'s Day',
                'Independence Day',
                'Christmas Day',
                'Thanksgiving',
                'Labor Day',
                'Memorial Day',
            ]),
            'date' => fake()->dateTimeBetween('now', '+1 year'),
            'is_recurring' => fake()->boolean(70),
            'region' => null,
        ];
    }

    /**
     * Indicate that the holiday is recurring.
     */
    public function recurring(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_recurring' => true,
        ]);
    }

    /**
     * Indicate that the holiday is not recurring.
     */
    public function notRecurring(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_recurring' => false,
        ]);
    }

    /**
     * Set the holiday for a specific region.
     */
    public function forRegion(string $region): static
    {
        return $this->state(fn (array $attributes) => [
            'region' => $region,
        ]);
    }

    /**
     * Set the holiday as global (no specific region).
     */
    public function global(): static
    {
        return $this->state(fn (array $attributes) => [
            'region' => null,
        ]);
    }
}
