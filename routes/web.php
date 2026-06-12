<?php

use App\Http\Controllers\InstructorController;
use App\Http\Controllers\KeyController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserRoleController;
use App\Models\Instructor;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('latihan',[LatihanController::class, 'index']);
Route::get('tambah',[LatihanController::class, 'tambah'])->name('tambah');
Route::get('kurang',[LatihanController::class, 'kurang'])->name('kurang');
Route::get('bagi',[LatihanController::class, 'bagi'])->name('bagi');
Route::get('kali',[LatihanController::class, 'kali'])->name('kali');

Route::post('action-tambah', [LatihanController::class, 'actionTambah'])->name('action-tambah');
Route::post('action-kurang', [LatihanController::class, 'actionKurang'])->name('action-kurang');
Route::post('action-kali', [LatihanController::class, 'actionKali'])->name('action-kali');
Route::post('action-bagi', [LatihanController::class, 'actionBagi'])->name('action-bagi');

//kalo di views nya pake url, di web gausah pake ->name
//kalo di views nya pake royute, di web pake ->name

Route::get('profile', [ProfileController::class, 'index']);

//log in
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('dashboard', function () {
    return view('dashboard.index');
});

Route::post('action-login', [LoginController::class, 'actionLogin'])->name('action-login');
Route::post('action-logout', [LoginController::class, 'actionLogout'])->name('action-logout');

// Route::middleware(['auth', 'prevent-back'])->group(function () {
//     Route::get('dashboard', function () {
//         return view('dashboard.index');
//     });
//     Route::resource('user', \App\Http\Controllers\UserController::class); //resource bisa menggantikan post, get, put etc
// });

Route::get('dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');
Route::resource('user', \App\Http\Controllers\UserController::class);
Route::resource('role', \App\Http\Controllers\RoleController::class);
Route::resource('menu', MenuController::class);
Route::resource('locker', LockerController::class);
Route::resource('key', KeyController::class);
Route::resource('major', MajorController::class);
Route::resource('student', StudentController::class);
Route::resource('instructor', InstructorController::class);
Route::resource('user-role', UserRoleController::class);
