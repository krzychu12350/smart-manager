<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = [
            [
                'name' => "Tom",
                'surname' => "Cruise",
                "email" => "t.cruise@gmail.com",
                "password" => bcrypt("tCruise12?3"),
                'position' => "Manager",
                'salary' => "20000",
                'is_admin' => true,
            ],
            [
                'name' => "Mark",
                'surname' => "Black",
                "email" => "m.black@gmail.com",
                "password" => bcrypt("mBlack12?3"),
                'position' => "Junior Python Developer",
                'salary' => "5000",
                'is_admin' => false,
            ],

        ];

        foreach ($employees as $employee)
            Employee::create($employee);
    }
}
