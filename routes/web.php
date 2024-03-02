<?php

use App\Http\Controllers\Dashboard\TeacherController;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

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
    Route::name('teacher.')->prefix('teacher')->group(function () {
        Route::get('/home', [TeacherController::class, 'index'])->name('home');
    });

});

