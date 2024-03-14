<?php

namespace Database\Factories;

use App\Enums\GenderEnum;
use App\Models\Grade;
use App\Models\Parents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(GenderEnum::class);
        $phone3FirstDigits = fake()->randomElement(['809', '829', '849']);
        return [
            "parents_id" => Parents::factory(),
            "grade_id" => Grade::all()->random(),
            "name" => fake()->firstName($gender),
            "last_name" => fake()->lastName(),
            "gender" => $gender,
            "email" => fake()->unique()->safeEmail(),
            "password" => Hash::make('123456'),
            "phone" => fake()->unique()->numerify("{$phone3FirstDigits}-###-####"),
            "dob" => fake()->dateTimeBetween('-18 years', '-5 years')->format('Y-m-d'),
            "is_enrolled" => fake()->boolean(40)
        ];
    }
}
