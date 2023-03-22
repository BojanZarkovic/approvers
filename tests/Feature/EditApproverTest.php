<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditApproverTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $admin = User::factory()->superAdmin()->create();

        $approver = User::factory()->approver()->create();

        $response = $this->actingAs($admin)
            ->putJson('/api/approvers/' . $approver->id, [
                'email' => 'test2@test.com',
                'password' => bcrypt('newPassword'),
                'first_name' => 'Billy',
                'last_name' => 'Jean',
            ]);

        $response->assertStatus(200);
    }
}
