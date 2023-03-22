<?php

namespace Tests\Feature;

use App\Models\Trader;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateEmployeeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->superAdmin()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/employees', [
                'email' => 'test@test.com',
                'employee_type' => 'professor',
                'password' => bcrypt('password'),
                'first_name' => 'John',
                'last_name' => 'Doe',
                'hours' => 6,
                'payroll_per_hour' => 20,
            ]);

        $response->assertStatus(201);
    }
}
