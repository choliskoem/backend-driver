<?php

use App\Http\Controllers\BackupController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Models\Pembelian;
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

// Route::get('/', function () {
//     return view('pages.auth.login');
// });

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/php', [LoginController::class, 'php'])->name('php');
// Route::get('/', [LoginController::class, 'show']);
Route::get('/check', [LoginController::class, 'latestData'])->name('latest.data');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/proses_login', [LoginController::class, 'proses_login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/register', [RegisterController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('driver', DriverController::class);
    Route::resource('backup', BackupController::class);
    Route::resource('pembelian', PembelianController::class);
    Route::resource('periode', PeriodeController::class);


});
