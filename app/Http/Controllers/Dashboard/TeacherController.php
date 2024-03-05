<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = auth('teacher')->user();
        $grade = $teacher->grade->name ?? null;

        return view('dashboard.teacher.index', ['grade' => $grade]);
    }

    public function logout()
    {
        auth('teacher')->logout();
        return redirect()->route('home');
    }

    public function courses()
    {
        return view('dashboard.teacher.courses');
    }
}
