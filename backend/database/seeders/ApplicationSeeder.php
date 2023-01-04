<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $applications = [
            [
                'status' => 'accepted',
                'user_id' => 1,
                'company_id' => 1,
            ],
            [
                'status' => 'rejected',
                'user_id' => 2,
                'company_id' => 1,
            ],
        ];

        foreach ($applications as $application)
            Application::create($application);

    }
}
