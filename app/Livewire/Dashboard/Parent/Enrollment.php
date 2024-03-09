<?php

namespace App\Livewire\Dashboard\Parent;

use App\Models\Student;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.parent-dashboard')]
class Enrollment extends Component
{
    public $selectedStudents = [];

    #[Validate('required|min:5')]
    public $name;

    #[Validate('required|min:16')]
    public $cardNumber;

    #[Validate('required')]
    public $month;

    #[Validate('required')]
    public $year;

    #[Validate('required|min:3')]
    public $cvv;

    #[Validate('required|gt:0')]
    public $total = 0;

    public function pay()
    {
        $this->validate();
        foreach ($this->selectedStudents as $stundentId) {
            Student::find($stundentId)->update(['is_enrolled' => true]);
        }

        return $this->redirect(route('dashboard.parent.students'), true);
    }

    public function updatedSelectedStudents()
    {

        $this->total = 15000 * count($this->selectedStudents);
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

        $years = [];
        for ($i = 0; $i < 10; $i++) {
            $date = Carbon::now()->addYears($i)->year;
            $years[] = ['id' => $date, 'name' => $date];
        }
        $students = auth()->user()->children()->notEnrolled()->get();

        return view('livewire.dashboard.parent.enrollment', [
            'months' => $months,
            'years' => $years,
            'students' => $students,
        ]);
    }
}
