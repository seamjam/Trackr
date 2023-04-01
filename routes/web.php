<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\WebshopController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PickupRequestController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\CustomerController;

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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit.blade.php');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//superadmin
Route::get('/superadmin', [UserController::class, 'index'])->name('superadmin.index');
Route::get('/users', [UserController::class, 'usersShow'])->name('user.show.blade.php');

//superadmin
//webshop
Route::get('/webshops', [WebshopController::class, 'webshopsShow'])->name('webshop.show.blade.php');
Route::get('/webshop/create', [WebshopController::class, 'create'])->name('webshop.create');
Route::get('/webshop/{user}', [WebshopController::class, 'edit'])->name('webshop.edit');
Route::put('/webshop/{user}', [WebshopController::class, 'update'])->name('webshop.update');
Route::post('/webshop/create', [WebshopController::class, 'store'])->name('webshop.store');

//webshop
//user
Route::get('/employees', [UserController::class, 'webshopUserShow'])->name('webshop.user.show.blade.php');
Route::get('/user/create', [UserController::class, 'create'])->name('webshop.user.create');
Route::post('/user/create', [UserController::class, 'store'])->name('webshop.user.store');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('webshop.user.destroy');
Route::get('/user/{user}', [UserController::class, 'edit'])->name('webshop.user.edit');
Route::put('/user/{user}', [UserController::class, 'update'])->name('webshop.user.update');

//administrator
//label
Route::get('/labels', [LabelController::class, 'show'])->name('administrator.labels.show');
Route::get('/label/create', [LabelController::class, 'create'])->name('administrator.labels.create');
Route::post('/label/create', [LabelController::class,'store'])->name('administrator.labels.store');
Route::delete('/label/{label}', [LabelController::class, 'destroy'])->name('administrator.labels.destroy');
Route::get('/label/{label}', [LabelController::class, 'edit'])->name('administrator.labels.edit');
Route::put('/label/{label}', [LabelController::class, 'update'])->name('administrator.labels.update');
Route::post('/pdf', [LabelController::class, 'generatePDF'])->name('administrator.labels.PDF');
Route::post('/csv', [LabelController::class,'importCSV'])->name('administrator.labels.importCSV');

//pickups
Route::middleware(['auth', 'role:administrator'])->group(function () {
    Route::get('/pickups', [PickupRequestController::class, 'show'])->name('administrator.pickups.show');
    Route::post('/pickups', [PickupRequestController::class, 'store'])->name('administrator.pickups.store');
    Route::get('/pickups/create', [PickupRequestController::class, 'create'])->name('administrator.pickups.create');
});

Route::middleware(['auth', 'role:courier'])->group(function () {
    Route::get('/registered/packages', [CourierController::class, 'show'])->name('courier.packages.show');;
});

//customer receiver

Route::middleware(['auth', 'role:receiver_customer'])->group(function () {
    Route::get('/orders', [CustomerController::class, 'show'])->name('customer.show');
    Route::post('/review', [CustomerController::class, 'review'])->name('customer.review');
    Route::get('/details/{package}', [CustomerController::class, 'details'])->name('customer.details');
});


//authentication
Route::get('/generate-api-token', [ApiController::class, 'generateApiToken'])->name('generate-api-token')->middleware(['auth', 'role:administrator']);
Route::get('/generate-api-token/courier', [ApiController::class, 'generateApiTokenCourier'])->name('generate-api-token-courier')->middleware(['auth', 'role:courier']);

require __DIR__.'/auth.php';
