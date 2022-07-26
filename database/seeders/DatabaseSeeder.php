<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Team;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Responsibility;
use Database\Factories\UserCompanyFactory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(20)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Company::factory(10)->create();
        // Team::factory(5)->create();
        // Role::factory(40)->create();
        // Responsibility::factory(100)->create();
        // Employee::factory(1000)->create();
    }
}
