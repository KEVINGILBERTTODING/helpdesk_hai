<?php

use App\Http\Controllers\user\auth\AuthController;
use App\Http\Controllers\user\main\MainController;
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

Route::get('/', function () {
    return view('landing_page/index');
});

Route::get('login', function () {
    return view('user.auth.login');
})->name('login');

Route::get('register', function () {
    return view('user.auth.login');
})->name('login');


// user

Route::post('login_user', [AuthController::class, 'login'])->name('login_user');
Route::post('register_user', [AuthController::class, 'register'])->name('register_user');
Route::get('dashboard', [MainController::class, 'index'])->name('dashboard');
