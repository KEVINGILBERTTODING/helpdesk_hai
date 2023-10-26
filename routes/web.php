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
    if (session('login') == true) {
        return redirect('dashboard');
    } else {
        return view('landing_page/index');
    }
});

Route::get('login', function () {

    if (session('login') == true) {
        return redirect('dashboard');
    } else {
        return view('user.auth.login');
    }
})->name('login');



// user

Route::post('login_user', [AuthController::class, 'login'])->name('login_user');
Route::post('register_user', [AuthController::class, 'register'])->name('register_user');
Route::get('dashboard', [MainController::class, 'index'])->name('dashboard');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('createPermohonan', [MainController::class, 'createPermohonan'])->name('createPermohonan');
Route::get('allPermohonan', [MainController::class, 'allPermohonan'])->name('allPermohonan');
Route::get('processPermohonan', [MainController::class, 'processPermohonan'])->name('processPermohonan');
Route::get('successPermohonan', [MainController::class, 'successPermohonan'])->name('successPermohonan');
Route::get('failedPermohonan', [MainController::class, 'failedPermohonan'])->name('failedPermohonan');
Route::get('detailPermohonan/{id}', [MainController::class, 'detailPermohonan'])->name('detailPermohonan');
Route::get('updatePermohonan/{id}', [MainController::class, 'updatePermohonan'])->name('updatePermohonan');
Route::post('updateData', [MainController::class, 'updateData'])->name('updateData');
Route::get('deletePermohonan/{id}', [MainController::class, 'deletePermohonan'])->name('deletePermohonan');
Route::get('downloadFilePermohonan/{fileName}', [MainController::class, 'downloadFilePermohonan'])->name('downloadFilePermohonan');
Route::post('insertPermohonan', [MainController::class, 'insertPermohonan'])->name('insertPermohonan');
