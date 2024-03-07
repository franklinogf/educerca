<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 2; $i <= 12; $i++) {
            Grade::factory()->create([
                'name' => "{$i}-A"
            ]);
        }
    }
}
