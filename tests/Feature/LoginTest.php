<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
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

        $successResponse = $this->post('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $successResponse->assertStatus(200);

        $failedResponse = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'Wrong password',
        ]);

        $failedResponse->assertStatus(401);

    }
}
