<?php

namespace Database\Seeders;

use App\Models\AttendanceOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttendanceOption::upsert([
            ['option' => 'P', 'description' => 'Presente'],
            ['option' => 'A', 'description' => 'Ausente'],
            ['option' => 'T', 'description' => 'Tarde'],
            ['option' => 'E', 'description' => 'Excusa']
        ], 'option');
    }
}
