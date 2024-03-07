<?php

namespace App\Livewire\Dashboard\Teacher;

use App\Models\Teacher;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;
use App\Models\Student;
use Livewire\Component;
use App\Enums\GuardsEnum;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;
use Illuminate\Support\Carbon;
use App\Models\AttendanceOption;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.teacher-dashboard')]

class Attendance extends Component
{
    use Toast;
    #[Url( as: 'month', keep: true)]
    public $selectedMonth;
    public $attendances = [];

    public function mount()
    {
        $this->selectedMonth = $this->selectedMonth ?? date('m');
        $this->setAttendances();
    }

    #[Computed]
    public function students()
    {
        return $this->teacher->students()->get();
    }
    #[Computed]
    public function teacher()
    {
        return Teacher::with('students')->find(auth()->id());
    }

    public function updatedSelectedMonth()
    {
        $this->setAttendances();
    }

    public function updatedAttendances($value, $name)
    {
        [$studentId, $date] = explode('.', $name);
        $student = Student::find($studentId);
        $student->attendances()->updateOrCreate(['date' => $date], ['attendance_option_id' => $value]);
        $this->success('Asistencia guardada!');
    }

    private function setAttendances()
    {
        foreach ($this->students as $student) {
            $this->attendances[$student->id] = $student->attendances()
                ->whereMonth('date', $this->selectedMonth)
                ->pluck('attendance_option_id', 'date')->toArray();
        }
    }


    public function render()
    {
        $months = [
            ['id' => '01', 'name' => '01 - Enero'],
            ['id' => '02', 'name' => '02 - Febrero'],
            ['id' => '03', 'name' => '03 - Marzo'],
            ['id' => '04', 'name' => '04 - Abril'],
            ['id' => '05', 'name' => '05 - Mayo'],
            ['id' => '06', 'name' => '06 - Junio'],
            ['id' => '07', 'name' => '07 - Julio'],
            ['id' => '08', 'name' => '08 - Agosto'],
            ['id' => '09', 'name' => '09 - Septiembre'],
            ['id' => '10', 'name' => '10 - Octubre'],
            ['id' => '11', 'name' => '11 - Noviembre'],
            ['id' => '12', 'name' => '12 - Diciembre'],
        ];

        $days = now()->createFromDate(month: $this->selectedMonth, day: 1)->daysInMonth;
        $weekDays = [];
        for ($i = 1; $i <= $days; $i++) {
            $day = now()->createFromDate(month: $this->selectedMonth, day: $i);
            if ($day->isWeekday()) {
                $weekDays[] = $day;
            }
        }

        $attendanceOptions = AttendanceOption::all();
        return view(
            'livewire.dashboard.teacher.attendance',
            [
                'months' => $months,
                'weekDays' => $weekDays,
                'attendanceOptions' => $attendanceOptions,
            ]
        );
    }
}
