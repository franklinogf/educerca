<?php

namespace App\Livewire\Dashboard\Teacher;

use App\Enums\GuardsEnum;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Note;
use App\Models\Student;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Courses extends Component
{
    public $students = [];
    public $notes = [];

    public $course;

    private function setCourse($id)
    {
        $this->course = Classroom::find($id);

    }

    public function showStudents(string $course_id)
    {
        $this->setCourse($course_id);
        $students = Student::where('grade_id', $this->course->grade_id)->get();
        foreach ($students as $index => $student) {

            $this->students[$index] = $student->toArray();
            $this->notes[$student->id] = $student->notes()->select(['note1', 'note2', 'note3', 'note4', 'average'])->where('classroom_id', $course_id)->first()?->toArray() ?? [];
        }
    }

    public function updatedNotes($value, $name)
    {

        [$studentId, $noteToUpdate] = explode('.', $name);

        $student = Student::find($studentId);

        $count = 0;
        $sum = 0;
        for ($i = 1; $i <= 4; $i++) {
            if (isset($this->notes[$studentId]["note$i"])) {
                $sum += $this->notes[$studentId]["note$i"];
                $count++;
            }
        }
        $average = $count > 0 ? $sum / $count : 0;
        $this->notes[$studentId]['average'] = round($average);

        $student->notes()->updateOrCreate(['classroom_id' => $this->course->id], [$noteToUpdate => $value, 'average' => $average]);


    }

    public function render()
    {
        $courses = auth(GuardsEnum::Teacher->value)->user()->classrooms;

        return view('livewire.dashboard.teacher.courses', ['courses' => $courses]);
    }
}
