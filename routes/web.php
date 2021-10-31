<?php


use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Admin\AdminPayment;
use App\Http\Livewire\Admin\AdminStudent;
use App\Http\Livewire\Admin\AdminTeacher;
use App\Http\Livewire\Home\Homepage;
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

Route::middleware(['checkRoles'])->group(function () {

    Route::get('/', Homepage::class)->name('index');
    Route::get('/Admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/Admin/student', AdminStudent::class)->name('admin.student');
    Route::get('/Admin/teacher', AdminTeacher::class)->name('admin.teacher');
    Route::get('/Admin/payment', AdminPayment::class)->name('admin.payment');

});
