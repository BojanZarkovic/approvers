<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\Trader;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditApprovalTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->approver()->create();

        $trader = Trader::factory()->create([
            'user_id' => $user->id,
        ]);

        $job = Job::factory()->trader()->create([
            'employee_id' => $trader->id
        ]);

        $responseCreate = $this->actingAs($user)
            ->postJson('/api/approval', [
                'job_id' => $job->id,
                'status' => 'APPROVED',
            ]);

        $responseEdit = $this->actingAs($user)
            ->putJson('/api/approval/' . $responseCreate['data']['id'], [
                'status' => 'DISSAPROVED',
            ]);

        $responseEdit->assertStatus(200);
    }
}
