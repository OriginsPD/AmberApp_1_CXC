<?php


use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Admin\AdminPayment;
use App\Http\Livewire\Admin\AdminReport;
use App\Http\Livewire\Admin\AdminStudent;
use App\Http\Livewire\Admin\AdminTeacher;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\TeacherPortal;
use App\Http\Livewire\Home\Homepage;
use App\Http\Livewire\Teacher\TeacherIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    Route::get('/', Homepage::class)->name('index');

    Route::get('/teacher/portal', TeacherPortal::class)->name('register');

    Route::get('/Admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/Admin/student', AdminStudent::class)->name('admin.student');
    Route::get('/Admin/teacher', AdminTeacher::class)->name('admin.teacher');
    Route::get('/Admin/payment', AdminPayment::class)->name('admin.payment');
    Route::get('/Admin/report', AdminReport::class)->name('admin.report');

    Route::get('/Teacher/dashboard', TeacherIndex::class)
        ->name('teacher.dashboard');


