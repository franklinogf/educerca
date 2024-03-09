<?php

namespace App\Livewire\Dashboard\Parent;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.parent-dashboard')]
class Students extends Component
{
    public $showNotes = [];

    public function mount()
    {

        for ($i = 0; $i < count($this->students); $i++) {
            $this->showNotes[] = false;
        }
    }

    #[Computed]
    public function students()
    {
        return Auth::user()->children;
    }

    public function toggle($index)
    {
        $this->showNotes[$index] = !$this->showNotes[$index];
    }

    public function resetEnrollment()
    {
        foreach ($this->students as $student) {
            $student->update(['is_enrolled' => false]);
        }
    }

    public function render()
    {

        return view('livewire.dashboard.parent.students');
    }
}
