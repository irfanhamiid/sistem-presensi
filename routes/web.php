<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\LaporanKehadiranController;

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
    return view('auth.login');
});
Route::get('lupa-password',[ForgotPasswordController::class,'index'])->name('lupa-password');
Route::post('kirim-data',[ForgotPasswordController::class,'kirim'])->name('kirim-data');
Route::get('reset-password/{token}',[ForgotPasswordController::class,'reset_password'])->name('reset-password');
Route::post('store-reset/{token}',[ForgotPasswordController::class,'store'])->name('store-reset');

Auth::routes();

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin-dashboard',[DashboardController::class,'index'])->name('admin-dashboard');
    // DATA KARYAWAN
    Route::get('karyawan-data',[KaryawanController::class,'data'])->name('karyawan-data');
    Route::get('karyawan-list',[KaryawanController::class,'index'])->name('karyawan-list');
    Route::get('karyawan-create',[KaryawanController::class,'create'])->name('karyawan-create');
    Route::get('karyawan-delete/{id}',[KaryawanController::class,'destroy'])->name('karyawan-delete');
    Route::get('karyawan-edit/{id}',[KaryawanController::class,'edit'])->name('karyawan-edit');
    Route::get('karyawan-show/{id}',[KaryawanController::class,'show'])->name('karyawan-show');
    Route::post('karyawan-store',[KaryawanController::class,'store'])->name('karyawan-store');
    Route::post('karyawan-update/{id}',[KaryawanController::class,'update'])->name('karyawan-update');
    // PROFIL ADMIN
    Route::get('admin-profile',[DashboardController::class,'profile'])->name('admin-profile');
    Route::post('admin-profile-update/{id}',[DashboardController::class,'profile_update'])->name('admin-profile-update');
    // DATA LAPORAN KEHADIRAN
    Route::get('laporan-kehadiran',[LaporanKehadiranController::class,'index'])->name('laporan-kehadiran');
    Route::post('laporan-kehadiran',[LaporanKehadiranController::class,'result'])->name('laporan-kehadiran-filter');
    Route::get('laporan-kehadiran-cetak/{jenis}',[LaporanKehadiranController::class,'cetak'])->name('laporan-kehadiran-cetak');
    Route::post('laporan-kehadiran-cetaks',[LaporanKehadiranController::class,'cetaks'])->name('laporan-kehadiran-cetaks');
    // SETTING JAM KERJA
    Route::get('jam-kerja',[DashboardController::class,'jamkerja'])->name('jam-kerja');
    Route::post('jam-kerja-update/{id}',[DashboardController::class,'update_jamkerja'])->name('jam-kerja-update');
});

Route::middleware(['auth', 'role:karyawan'])->group(function () {
    // DASHBOARD + PRESENSI
    Route::get('karyawan-dashboard',[KehadiranController::class,'index'])->name('karyawan-dashboard');
    Route::get('presensi-form/{status}',[KehadiranController::class,'create'])->name('presensi-form');
    Route::post('presensi-store',[KehadiranController::class,'store'])->name('presensi-store');
    // REKAP PRESENSI
    Route::get('rekap-kehadiran',[KehadiranController::class,'rekap'])->name('rekap-kehadiran');
    Route::post('rekap-kehadiran',[KehadiranController::class,'rekap_result'])->name('rekap-kehadiran-filter');
    // PROFIL KARYAWAN
    Route::get('karyawan-profile',[HomeController::class,'profile'])->name('karyawan-profile');
    Route::post('karyawan-profile-update/{id}',[HomeController::class,'profile_update'])->name('karyawan-profile-update');
});
