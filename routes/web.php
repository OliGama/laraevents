<?php
use App\Http\Controllers\Auth\{
    RegisterController,
    LoginController
};
use App\Http\Controllers\Participant\Dashboard\DashboardController;
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

Route::get('register', [RegisterController::class, 'create'])->name('auth.register.create');
Route::post('register', [RegisterController::class, 'store'])->name('auth.register.store');
Route::get('login', [LoginController::class, 'create'])->name('auth.login.create');
Route::post('login', [LoginController::class, 'store'])->name('auth.login.store');
Route::get('participant/dashboard', [DashboardController::class, 'index'])
    ->name('participant.dashboard.index')
    ->middleware('auth');
