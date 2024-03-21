<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Parents;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function index()
    {
        $studentCount = auth()->user()->children()->count();
        $studentsNotEnrolled = auth()->user()->children()->notEnrolled()->count();
        return view('dashboard.parent.index', ['studentsCount' => $studentCount, 'studentsNotEnrolled' => $studentsNotEnrolled]);
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }
    public function foro()
    {
        $students = auth()->user()->children;
        return view('dashboard.parent.foro', ['students' => $students]);
    }
    public function posts(Grade $grade)
    {
        $posts = $grade->posts;
        return view('dashboard.parent.foro-post', ['posts' => $posts]);
    }

}
