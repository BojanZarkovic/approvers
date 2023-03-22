<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetApproversTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $admin = User::factory()->superAdmin()->create([
            'password' => bcrypt($password = 'password'),
        ]);

        $approver = User::factory()->approver()->create([
            'password' => bcrypt($password = 'password'),
        ]);


        $response = $this->actingAs($admin)
            ->get('/api/approvers/');

        $response->assertStatus(200);
    }
}
