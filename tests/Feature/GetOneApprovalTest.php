<?php

namespace Tests\Feature;

use App\Models\Approval;
use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetOneApprovalTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->nonApprover()->create();

        $job = Job::factory()->trader()->create();

        $approval = Approval::factory()->approved()->create([
            'user_id' => $user->id,
            'job_id' => $job->id
        ]);


        $response = $this->actingAs($user)
            ->get('/api/approval/' . $approval->id);

        $response->assertStatus(200);
    }
}
