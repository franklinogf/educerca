<?php

namespace App\Livewire\Dashboard\Teacher;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Note;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Courses extends Component
{
    public $students = [];

    // public Course $course;

    public function setCourse($id)
    {
        // $this->course = Course::find($id);

    }

    public function showStudents(string $grade, string $course_id)
    {
        // $this->setCourse($course_id);
        // $grade = Grade::with('students')->where('name', $grade)->first();

        // foreach ($grade->students as $index => $student) {

        //     Arr::set($this->students, $index, $student->toArray());
        //     Arr::set($this->students[$index], 'note', $student->notes()->where('course_id', $course_id)->first()?->toArray() ?? []);
        // }
    }

    public function updated($name, $value)
    {
        // $noteToUpdate = Str::afterLast($name, '.');
        // $studentIndex = Str::betweenFirst($name, 's.', '.n');

        // $student = Arr::get($this->students, $studentIndex);

        // $count = 0;
        // $sum = 0;
        // for ($i = 1; $i <= 4; $i++) {
        //     if (isset($student['note']["nota$i"])) {
        //         $sum += $student['note']["nota$i"];
        //         $count++;
        //     }
        // }
        // $student['note']['promedio'] = $count === 0 ? null : round($sum / $count);
        // $this->students[$studentIndex]['note']['promedio'] = $student['note']['promedio'];
        // if (isset($student['note']['id'])) {
        //     Note::find($student['note']['id'])->update([
        //         $noteToUpdate => $value,
        //         'promedio' => $student['note']['promedio'],
        //     ]);

        // } else {
        //     $newNote = Note::create([
        //         'student_id' => $student['id'],
        //         'course_id' => $this->course->id,
        //         $noteToUpdate => $value,
        //         'promedio' => $student['note']['promedio'],
        //     ]);
        //     $this->students[$studentIndex]['note']['id'] = $newNote->id;
        // }

    }

    public function render()
    {
        // $courses = Auth::user()->courses;
        $courses = [];

        return view('livewire.dashboard.teacher.courses', ['courses' => $courses]);
    }
}
