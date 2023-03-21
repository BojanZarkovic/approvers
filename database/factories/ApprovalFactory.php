<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Approval>
 */
class ApprovalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1,80),
            'job_id' => fake()->numberBetween(1,20),
        ];
    }

    public function approved(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'APPROVED',
            ];
        });
    }

    public function nonApproved(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'DISSAPROVED',
            ];
        });
    }
}
