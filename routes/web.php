<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\DataAdminController;
use App\Http\Controllers\Admin\DataSiswaController;
use App\Http\Controllers\Admin\DebtController;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\MultimediaController;
use App\Http\Controllers\Admin\PerhotelanController;
use App\Http\Controllers\Admin\StaffProfileController;
use App\Http\Controllers\Admin\StudyProgramController;
use App\Http\Controllers\Admin\TataBogaController;
use App\Http\Controllers\Admin\TataNiagaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/login-admin');

Route::get('/login-admin', [LoginController::class, 'index'])->name('admin');

Route::prefix('/')->group(function () {
    Route::redirect('/login', '/login-admin');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::prefix('/dashboard')->group(function () {
        // Bill Routes
        Route::resource('/bill', BillController::class);

        // Route Debt
        Route::resource('/tunggakan', DebtController::class)->only(['index', 'show']);
        Route::get('/kirim-pengingat/{id}', [DebtController::class, 'sendReminder'])->name('debt.sendReminder');

        // Route Income
        Route::get('/pendapatan', [IncomeController::class, 'index'])->name('admin.income.index');
        Route::get('/income-export', [IncomeController::class, 'export'])->name('admin.income.export');

        // Route Detail SPP Siswa
        Route::get('/laporan-spp-siswa/{id}', [StudyProgramController::class, 'detail'])->name('admin.study-program.detail');
        Route::get('/detail-laporan-spp-siswa/{id}', [StudyProgramController::class, 'detailPayment'])->name('admin.study-program.detail-payment');
        Route::get('/kirim-pengingat-pembayaran/{id}', [StudyProgramController::class, 'sendReminder'])->name('admin.study-program.sendReminder');

        // Akomodasi Perhotelan Routes
        Route::get('/akomodasi-perhotelan', [PerhotelanController::class, 'index'])->name('admin.perhotelan');
        Route::get('/akomodasi-perhotelan/kelas/X', [PerhotelanController::class, 'kelasX'])->name('admin.xap');
        Route::get('/akomodasi-perhotelan/kelas/XI', [PerhotelanController::class, 'kelasXI'])->name('admin.xiap');
        Route::get('/akomodasi-perhotelan/kelas/XII', [PerhotelanController::class, 'kelasXII'])->name('admin.xiiap');

        // Multimedia Routes
        Route::get('/multimedia', [MultimediaController::class, 'index'])->name('admin.multimedia');
        Route::get('/multimedia/kelas/X', [MultimediaController::class, 'kelasX'])->name('admin.xmm');
        Route::get('/multimedia/kelas/XI', [MultimediaController::class, 'kelasXI'])->name('admin.ximm');
        Route::get('/multimedia/kelas/XII', [MultimediaController::class, 'kelasXII'])->name('admin.xiimm');

        // Tata Boga Routes
        Route::get('/tata-boga', [TataBogaController::class, 'index'])->name('admin.tata-boga');
        Route::get('/tata-boga/kelas/X', [TataBogaController::class, 'kelasX'])->name('admin.xtb');
        Route::get('/tata-boga/kelas/XI', [TataBogaController::class, 'kelasXI'])->name('admin.xitb');
        Route::get('/tata-boga/kelas/XII', [TataBogaController::class, 'kelasXII'])->name('admin.xiitb');

        // Tata Niaga Routes
        Route::get('/tata-niaga', [TataNiagaController::class, 'index'])->name('admin.tata-niaga');
        Route::get('/tata-niaga/kelas/X', [TataNiagaController::class, 'kelasX'])->name('admin.xtn');
        Route::get('/tata-niaga/kelas/XI', [TataNiagaController::class, 'kelasXI'])->name('admin.xitn');
        Route::get('/tata-niaga/kelas/XII', [TataNiagaController::class, 'kelasXII'])->name('admin.xiitn');

        // Data Siswa Routes
        Route::resource('/siswa', DataSiswaController::class);
        Route::get('/profile', [StudentProfileController::class, 'index'])->name('student.profile');
        Route::get('/profile/{id}/edit', [StudentProfileController::class, 'edit'])->name('student.profile.edit');
        Route::put('/profile/{id}', [StudentProfileController::class, 'update'])->name('student.profile.update');
        Route::get('/profile/{id}/password', [StudentProfileController::class, 'password'])->name('student.profile.password');
        Route::put('/profile/{id}/password', [StudentProfileController::class, 'updatePassword'])->name('student.profile.password.update');

        // Data Admin Routes
        Route::resource('/admin', DataAdminController::class);
        Route::get('/profile-staff', [StaffProfileController::class, 'index'])->name('staff.profile');
        Route::get('/profile-staff/{id}/edit', [StaffProfileController::class, 'edit'])->name('staff.profile.edit');
        Route::put('/profile-staff/{id}', [StaffProfileController::class, 'update'])->name('staff.profile.update');
        Route::get('/profile-staff/{id}/password', [StaffProfileController::class, 'password'])->name('staff.profile.password');
        Route::put('/profile-staff/{id}/password', [StaffProfileController::class, 'updatePassword'])->name('staff.profile.password.update');

        // Student Routes
        Route::get('/info-pembayaran', [StudentController::class, 'paymentInfo'])->name('student.payment-info');
        Route::get('/detail-pembayaran/{id}', [StudentController::class, 'paymentDetail'])->name('student.payment-detail');
    });
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
