<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminUserController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//superadmin
Route::get('/superadmin', [SuperAdminUserController::class, 'index'])->name('superadmin.index');
Route::get('/users', [SuperAdminUserController::class, 'usersShow'])->name('superadmin.users_show');
Route::get('/users/create', [SuperAdminUserController::class, 'create'])->name('users.create');
Route::post('/users/create', [SuperAdminUserController::class, 'store'])->name('users.store');
Route::post('/users/delete', [SuperAdminUserController::class, 'usersDestroy'])->name('users.delete');


require __DIR__.'/auth.php';
