<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', function() {
    return view('test.test_form');
})->name('home');

Route::match(['GET', 'POST'],'/login', [LoginController::class, 'login'] )->name('login');
Route::match(['GET', 'POST'],'/register', [LoginController::class, 'register'] )->name('register');
Route::get('/logout', [LoginController::class, 'logout'] )->name('logout');

Route::prefix('admin')->middleware(CheckRole::class)->group(function(){
    Route::get('/', function () {
        return view('welcome');
    })->name('admin.home');

    Route::middleware(['checkAdminRole:Editor'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', function(){
            return '1';
        })->name('users.destroy');
    });

    Route::middleware(['checkAdminRole:Viewer'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    });
});

