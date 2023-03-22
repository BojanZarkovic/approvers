<?php

namespace Tests\Feature;

use App\Models\Professor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteEmployeeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $admin = User::factory()->superAdmin()->create();

        $employee = User::factory()->nonApprover()->create();

        $professor = Professor::factory()->create([
            'user_id' => $employee->id
        ]);

        $response = $this->actingAs($admin)->delete('/api/employees/' . $professor->user_id);

        $response->assertStatus(200);
    }
}
