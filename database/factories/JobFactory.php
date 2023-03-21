<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => fake()->date(),
            'employee_id' => fake()->numberBetween(1,80),
            'total_hours' => fake()->numberBetween(2,4)
        ];
    }

    public function professor(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'employee_type' => 'PROFESSOR',
            ];
        });
    }

    public function trader(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'employee_type' => 'TRADER',
            ];
        });
    }
}
