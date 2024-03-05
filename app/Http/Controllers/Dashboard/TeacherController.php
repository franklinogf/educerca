<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\GuardsEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = auth(GuardsEnum::Teacher->value)->user();
        $grade = $teacher->grade->name ?? null;

        return view('dashboard.teacher.index', ['grade' => $grade]);
    }

    public function logout()
    {
        auth(GuardsEnum::Teacher->value)->logout();
        return redirect()->route('home');
    }

    public function courses()
    {
        return view('dashboard.teacher.courses');
    }
}
