<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Employee;
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
        $employees = \App\Models\Employee::factory(10)->create();
        $companies = \App\Models\Company::factory(10)->create();

        foreach($employees as $employee){
            $employee->companies()->attach($employees->random()->id);
            $company->employees()->attach($companies->random()->id);
        }
        
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
