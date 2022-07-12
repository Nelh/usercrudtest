<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

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

Route::middleware(['auth', 'verified', ])->group(function () {
    Route::prefix('dashboard')->group(function () {   
        Route::get('users', [UsersController::class, 'index'])->name('users');
        Route::get('users/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('users/store', [UsersController::class, 'store'])->name('users.store');
        Route::get('users/edit/{user}', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('users/update/{user}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('users/destroy/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });
});

Route::get('/', function () {
    return Redirect::route('login');
});


require __DIR__.'/auth.php';
