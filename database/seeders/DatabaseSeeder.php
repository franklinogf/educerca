<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Grade;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\ParentsSeeder;
use Database\Seeders\SubjectSeeder;
use Database\Seeders\TeacherSeeder;
use Database\Seeders\AttendanceOptionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GradeSeeder::class,
            TeacherSeeder::class,
            ParentsSeeder::class,
            AttendanceOptionSeeder::class,
            SubjectSeeder::class,
            ClassroomSeeder::class
        ]);

        $teacher = Teacher::factory()->create([
            'email' => 'teacher@demo.com',
        ]);
        $grade = Grade::factory()->for($teacher)->create([
            'name' => "1-A"
        ]);
        Classroom::factory(2)->for($teacher)->for($grade)->create();
        Student::factory(10)->for($grade)->create();

        $parent = Parents::factory()->create([
            'email' => 'parent@demo.com',
        ]);
        Student::factory()->for($grade)->for($parent, 'parent')->create();
        Student::factory(2)->for($parent, 'parent')->create();


        //crear usuario para la administracion
        User::factory()->create([
            'name' => 'Alam',
            'last_name' => 'Perez',
            'email' => 'alam@demo.com'
        ]);


    }
}
