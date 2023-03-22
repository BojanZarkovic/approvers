<?php

namespace Tests\Feature;

use App\Models\Approval;
use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetApprovalsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->nonApprover()->create();


        $response = $this->actingAs($user)
            ->get('/api/approval/');

        $response->assertStatus(200);
    }
}
