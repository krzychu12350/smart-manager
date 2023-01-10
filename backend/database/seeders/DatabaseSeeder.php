<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $employees = \App\Models\User::factory(100)->create();
        $companies = \App\Models\Company::factory(100)->create();
        /*
        foreach ($employees as $employee) {
            $employee->companies()->attach($employees->random()->id);
            //$company->employees()->attach($companies->random()->id);
        }
        */
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            //CompanySeeder::class,
            IncomeSeeder::class,
            UserSeeder::class,
            ApplicationSeeder::class,
            PositionSeeder::class,
        ]);
    }
}
