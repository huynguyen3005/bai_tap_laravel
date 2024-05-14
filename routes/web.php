<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\CheckRole;
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
})->name('home');

Route::match(['GET', 'POST'],'/login', [LoginController::class, 'login'] )->name('login');
Route::match(['GET', 'POST'],'/register', [LoginController::class, 'register'] )->name('register');

Route::prefix('admin')->middleware(CheckRole::class)->group(function(){
    Route::get('/', function () {
        return view('welcome');
    })->name('admin.home');
});

