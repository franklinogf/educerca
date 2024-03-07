<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\GuardsEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = auth()->user();
        $grade = $teacher->grade->name ?? null;
        $amountOfStudents = $teacher->students()->count();
        $amountOfCourses = $teacher->classrooms()->count();
        $amountOfPosts = $teacher->posts()->count();

        return view('dashboard.teacher.index', [
            'grade' => $grade,
            'amountOfStudents' => $amountOfStudents,
            'amountOfCourses' => $amountOfCourses,
            'amountOfPosts' => $amountOfPosts,
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }

}
