<?php

use App\Http\Controllers\daskrimti\main\DaskrimtiController;
use App\Http\Controllers\daskrimti\auth\AuthController as DaskrimtiAuthController;
use App\Http\Controllers\daskrimti\main\BidangController;
use App\Http\Controllers\daskrimti\main\LayananController;
use App\Http\Controllers\daskrimti\main\TypeController;
use App\Http\Controllers\daskrimti\main\UsersController;
use App\Http\Controllers\daskrimti\permohonan\PermohonanController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\user\auth\AuthController;
use App\Http\Controllers\user\main\MainController;
use App\Http\Controllers\user\UserController;
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
    if (session('login') && session('role') == 'daskrimti') {
        return redirect()->route('daskrimtiDashboard');
    } else  if (session('login') && session('role') == 'staff') {
        return redirect()->route('dashboard');
    } else {
        return view('landing_page.index');
    }
})->name('/');

Route::get('login', function () {
    if (session('login') == true && session('role') == 'staff') {
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
Route::get('profile', [UserController::class, 'profile'])->name('profile');
Route::post('updateProfilPhoto', [UserController::class, 'updateProfilPhoto'])->name('updateProfilPhoto');
Route::post('updateProfile', [UserController::class, 'updateProfile'])->name('updateProfile');
Route::get('markAllRead', [NotificationController::class, 'markAllRead'])->name('markAllRead');
Route::get('deleteNotification', [NotificationController::class, 'delete'])->name('deleteNotification');
Route::get('forgetPassword', [UserController::class, 'forgetPassword'])->name('forgetPassword');
Route::get('reset_password/{userId}', [AuthController::class, 'resetPassword'])->name('reset_password');
Route::post('resetPassword', [UserController::class, 'resetPassword'])->name('resetPassword');
Route::post('updatePassword', [AuthController::class, 'updatePassword'])->name('updatePassword');
Route::get('search', [MainController::class, 'search'])->name('search');

// Daskrimti
Route::get('daskrimti', [DaskrimtiAuthController::class, 'index'])->name('daskrimti')->middleware('daskrimtiAuth');
Route::post('daskrimtiLogin', [DaskrimtiAuthController::class, 'login'])->name('daskrimtiLogin');
Route::get('daskrimtiDashboard', [DaskrimtiController::class, 'index'])->name('daskrimtiDashboard')->middleware('daskrimti');
Route::get('layanan', [LayananController::class, 'index'])->name('layanan')->middleware('daskrimti');
Route::post('insertLayanan', [LayananController::class, 'insertLayanan'])->name('insertLayanan')->middleware('daskrimti');
Route::post('updateLayanan', [LayananController::class, 'updateLayanan'])->name('updateLayanan')->middleware('daskrimti');
Route::get('deleteLayanan/{layananId}', [LayananController::class, 'deleteLayanan'])->name('deleteLayanan')->middleware('daskrimti');
Route::get('bidang', [BidangController::class, 'index'])->name('bidang')->middleware('daskrimti');
Route::get('profileDaskrimti', [LayananController::class, 'index'])->name('profileDaskrimti')->middleware('daskrimti');
Route::post('insertBidang', [BidangController::class, 'insertBidang'])->name('insertBidang')->middleware('daskrimti');
Route::post('updateBidang', [BidangController::class, 'updateBidang'])->name('updateBidang')->middleware('daskrimti');
Route::get('deleteBidang/{bidangId}', [BidangController::class, 'deleteBidang'])->name('deleteBidang')->middleware('daskrimti');
Route::get('type', [TypeController::class, 'index'])->name('type')->middleware('daskrimti');
Route::post('insertType', [TypeController::class, 'insertType'])->name('insertType')->middleware('daskrimti');
Route::post('updateType', [TypeController::class, 'updateType'])->name('updateType')->middleware('daskrimti');
Route::get('deleteType/{typeId}', [TypeController::class, 'deleteType'])->name('deleteType')->middleware('daskrimti');
Route::get('users', [UsersController::class, 'index'])->name('users')->middleware('daskrimti');
Route::post('insertUser', [UsersController::class, 'insertUser'])->name('insertUser')->middleware('daskrimti');
Route::post('updateUsers', [UsersController::class, 'updateUsers'])->name('updateUsers')->middleware('daskrimti');
Route::get('deleteUser/{userId}', [UsersController::class, 'deleteUser'])->name('deleteUser')->middleware('daskrimti');
Route::get('semuaPermohonan', [PermohonanController::class, 'semuaPermohonan'])->name('semuaPermohonan')->middleware('daskrimti');
Route::get('permohonanSelesai', [PermohonanController::class, 'allPermohonan'])->name('permohonanSelesai')->middleware('daskrimti');
Route::get('permohonanProses', [PermohonanController::class, 'allPermohonan'])->name('permohonanProses')->middleware('daskrimti');
Route::get('permohonanDitolak', [PermohonanController::class, 'allPermohonan'])->name('permohonanDitolak')->middleware('daskrimti');
Route::post('acceptPermohonan', [PermohonanController::class, 'acceptPermohonan'])->name('acceptPermohonan')->middleware('daskrimti');
Route::post('rejectPermohonan', [PermohonanController::class, 'rejectPermohonan'])->name('rejectPermohonan')->middleware('daskrimti');
