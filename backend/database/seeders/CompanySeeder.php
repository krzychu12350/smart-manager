<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            [
                'name' => 'Google',
                'city' => 'London',
                'industry' => 'IT',
                'description' => 'IT company',
            ],
            [
                'name' => 'Facebook',
                'city' => 'New York',
                'industry' => 'IT',
                'description' => 'Social Media Company',
            ],
        ];

        foreach ($companies as $company)
            Company::create($company);

    }
}
