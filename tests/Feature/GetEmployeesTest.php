<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetEmployeesTest extends TestCase
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

        $response = $this->actingAs($user)
            ->get('/api/employees');

        $response->assertStatus(200);
    }
}