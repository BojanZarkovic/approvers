<?php

namespace Tests\Feature;

use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetOneJobTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->nonApprover()->create();

        $job = Job::factory()->trader()->create();

        $response = $this->actingAs($user)
            ->get('/api/jobs/' . $job->id);

        $response->assertStatus(200);

        $notFoundResponse = $this->actingAs($user)
            ->get('/api/jobs/fakeId');

        $notFoundResponse->assertStatus(404);
    }
}
