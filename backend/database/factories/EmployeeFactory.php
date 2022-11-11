<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->firstName($gender = 'male'|'female');
        $surname = fake()->lastName();

        return [
            'name' => $name,
            'surname' => $surname, 
            'position' => fake()->jobTitle(),
            'salary' => fake()->numberBetween($min = 1000, $max = 9000),
            'email' => strtolower($name[0]).".".strtolower($surname)."@gmail.com",
            'password' => bcrypt(strtolower($name[0])."".ucfirst($surname)."12?3"),
            'is_admin' => 0,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
