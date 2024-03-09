<?php

use App\Enums\GuardsEnum;
use App\Http\Controllers\Dashboard\ParentController;
use App\Livewire\Dashboard\Parent\Enrollment;
use App\Livewire\Dashboard\Parent\Students;
use App\Livewire\Dashboard\Teacher\Attendance;
use App\Livewire\Dashboard\Teacher\Foro;
use App\Livewire\Dashboard\ViewPost;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard\Teacher\Courses;
use App\Http\Controllers\Dashboard\TeacherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Welcome::class)->name('home');

Route::name('dashboard.')->prefix('dashboard')->group(function () {

    Route::middleware('auth:' . GuardsEnum::Teacher->value)->name('teacher.')->prefix('teacher')->group(function () {
        Route::get('/home', [TeacherController::class, 'index'])->name('home');
        Route::get('/logout', [TeacherController::class, 'logout'])->name('logout');
        Route::get('/courses', Courses::class)->name('courses');
        Route::get('/attendance', Attendance::class)->name('attendance');
        Route::get('/foro', Foro::class)->name('foro');
    });

    Route::middleware('auth:' . GuardsEnum::Parent->value)->name('parent.')->prefix('parent')->group(function () {
        Route::get('/home', [ParentController::class, 'index'])->name('home');
        Route::get('/logout', [ParentController::class, 'logout'])->name('logout');
        Route::get('/foro', [ParentController::class, 'foro'])->name('foro');
        Route::get('/foro/{grade}', [ParentController::class, 'posts'])->name('foro.posts');
        Route::get('/enrollment', Enrollment::class)->name('enrollment');
        Route::get('/students', Students::class)->name('students');
    });

    Route::get('/foro/posts/{post}', ViewPost::class)->name('foro.post')->middleware(['auth:' . GuardsEnum::Teacher->value . ',' . GuardsEnum::Parent->value]);
});

