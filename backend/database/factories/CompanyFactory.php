<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $industries = [
            'Fishing',
            'Energy',
            'Chemicals',
            'Banking',
            'Airlines',
            'Education',
            'Fashion',
            'Food Manufacturing',
            'Hotels',
            'IT',
            'Space',
            'Tourism',
            'Marketing Services',
            'Agriculture'
        ];

        $company = fake()->company();

        $industry = $industries[fake()->numberBetween($min = 0, $max = 13)];

        $description = [
            'We are the new company in which works employees with experience.
            Our company is from industry '.$industry.'. We want ensure that we 
            are very creative and we have a lot of motivation to meet expectations for market and clients.',

            'The company '.$company.' is long time on market of '.$industry.'. This compny puts on the newest solutions.
            In there employed large staff with special skills and talents.',

            ''.$company.' is company which is placed on the top worlds ranking in businesses from '.$industry.' industry.
            Shes employees always help you and really good advice you in every problem. In that company works people whos knows 
            what is appropriate approach to client and facing hard challenges.'
        ];
        
        return [
            'name' => $company,
            'city' => fake()->city(), 
            'industry' => $industry,
            'description' => $description[fake()->numberBetween($min = 0, $max = 2)],
        ];
    }
}
