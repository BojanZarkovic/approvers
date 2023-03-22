<?php

namespace Tests\Feature;

use App\Models\Approval;
use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetOneApproverTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $admin = User::factory()->superAdmin()->create();

        $approver = User::factory()->approver()->create([
            'password' => bcrypt($password = 'password'),
        ]);


        $response = $this->actingAs($admin)
            ->get('/api/approvers/' . $approver->id);

        $response->assertStatus(200);
    }
}
