<?php

namespace Tests\Feature;

use App\Models\Trader;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateJobTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->nonApprover()->create([
            'password' => bcrypt($password = 'password'),
        ]);

        $trader = Trader::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)
            ->postJson('/api/jobs', [
                'employee_id' => $user->id,
                'employee_type' => 'trader',
                'date' => '2023-05-11',
                'hours' => 3,
            ]);

        $response->assertStatus(201);
    }
}
