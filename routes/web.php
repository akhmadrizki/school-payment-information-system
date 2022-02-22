<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PerhotelanController;
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
        // Akomodasi Perhotelan Routes
        Route::get('/akomodasi-perhotelan', [PerhotelanController::class, 'index'])->name('admin.perhotelan');
        Route::get('/akomodasi-perhotelan/kelas/X', [PerhotelanController::class, 'kelasX'])->name('admin.xap');

        Route::get('/multimedia', [AdminController::class, 'multimedia'])->name('admin.multimedia');
        Route::get('/tata-boga', [AdminController::class, 'tataBoga'])->name('admin.tata-boga');
        Route::get('/tata-niaga', [AdminController::class, 'tataNiaga'])->name('admin.tata-niaga');
    });
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
