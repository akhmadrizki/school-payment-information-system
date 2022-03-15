<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\DataSiswaController;
use App\Http\Controllers\Admin\MultimediaController;
use App\Http\Controllers\Admin\PerhotelanController;
use App\Http\Controllers\Admin\TataBogaController;
use App\Http\Controllers\Admin\TataNiagaController;
use App\Http\Controllers\Auth\LoginController;
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
    });
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
