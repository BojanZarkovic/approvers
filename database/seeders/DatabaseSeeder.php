<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Approval;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Approval::factory()
            ->count(10)
            ->hasJob()
            ->hasUser()
            ->approved()
            ->create();

        Approval::factory()
            ->count(10)
            ->hasJob()
            ->hasUser()
            ->nonApproved()
            ->create();

    }
}
