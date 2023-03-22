<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteApproverTest extends TestCase
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

        $approver = User::factory()->approver()->create();

        $response = $this->actingAs($admin)->delete('/api/approvers/' . $approver->id);

        $response->assertStatus(200);
    }
}
