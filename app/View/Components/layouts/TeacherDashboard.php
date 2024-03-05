<?php

namespace App\View\Components\layouts;

use App\Enums\GuardsEnum;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TeacherDashboard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $fullName = auth(GuardsEnum::Teacher->value)->user()->full_name;
        return view('components.layouts.teacher-dashboard', ['fullName' => $fullName]);
    }
}
