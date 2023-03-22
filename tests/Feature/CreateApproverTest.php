<?php

namespace Tests\Feature;

use App\Models\Trader;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateApproverTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->superAdmin()->create([
            'password' => bcrypt($password = 'password'),
        ]);

        $response = $this->actingAs($user)
            ->postJson('/api/approvers', [
                'email' => 'test@test.com',
                'password' => bcrypt('password'),
                'first_name' => 'John',
                'last_name' => 'Doe',
            ]);

        $response->assertStatus(201);
    }
}
