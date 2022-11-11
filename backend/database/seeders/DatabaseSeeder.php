<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Employee::factory(10)->create();
        \App\Models\Company::factory(10)->create();

        // \App\Models\Employee::factory()->create([
        //     'name' => 'Test Employee',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            CompanySeeder::class,
            EmployeeSeeder::class,
        ]);
    }
}
