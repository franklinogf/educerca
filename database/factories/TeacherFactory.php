<?php

namespace Database\Factories;

use App\Enums\GenderEnum;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
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
            "name" => fake()->firstName($gender),
            "last_name" => fake()->lastName(),
            "gender" => $gender,
            "email" => fake()->unique()->safeEmail(),
            "password" => Hash::make('123456'),
            "phone" => fake()->unique()->numerify("{$phone3FirstDigits}-###-####"),
            "dob" => fake()->dateTimeBetween('-50 years', '-30 years')->format('Y-m-d'),

        ];
    }
}
