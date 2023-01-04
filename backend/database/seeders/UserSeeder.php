<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => "Tom",
                'surname' => "Cruise",
                "email" => "t.cruise@gmail.com",
                "password" => bcrypt("tCruise12?3"),
                'position' => "Manager",
                'salary' => "20000",
                'is_owner' => true,
            ],
            [
                'name' => "Mark",
                'surname' => "Black",
                "email" => "m.black@gmail.com",
                "password" => bcrypt("mBlack12?3"),
                'position' => "Junior Python Developer",
                'salary' => "5000",
                'is_owner' => false,
            ],

        ];

        foreach ($users as $user)
            User::create($user);
    }
}
