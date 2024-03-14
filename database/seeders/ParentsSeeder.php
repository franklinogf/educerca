<?php

namespace Database\Seeders;

use App\Models\Parents;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ParentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $random = fake()->numberBetween(1, 3);
            Parents::factory()->has(
                Student::factory()->count($random)
                    ->state(function (array $attributes, Parents $parent) {
                        return ['last_name' => $parent->last_name];
                    })
                ,
                'children'
            )->create();
        }

    }
}
