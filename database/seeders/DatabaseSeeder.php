<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Parents;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 0; $i < 3; $i++) {
            $random = fake()->numberBetween(1, 3);
            $parent = Parents::factory()->create();
            Student::factory($random)->recycle($parent)->create([
                'last_name' => $parent->last_name
            ]);
        }

        $this->call(TeacherSeeder::class);
    }
}
