<?php

namespace Database\Seeders;

use App\Models\Income;
use App\Models\User;
use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = User::where('is_owner', false)->get();

        foreach ($employees as $employee) {
            Income::create([
                'amount' => fake()->numberBetween($min = 1000, $max = 9000),
                'user_id' => $employee->id,
            ]);
        }

    }
}


