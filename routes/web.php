<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\WebshopController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PickupRequestController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DeliveryCompanyController;
use App\Http\Controllers\LangController;

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

Route::middleware(['auth', 'role:superadmin'])->group(function () {

    Route::get('/users', [UserController::class, 'superAdminUsersShow'])->name('superadmin.user.show');

    Route::get('/webshops', [WebshopController::class, 'webshopsShow'])->name('superadmin.webshop.show');
    Route::get('/webshop/create', [WebshopController::class, 'create'])->name('superadmin.webshop.create');
    Route::get('/webshop/{user}', [WebshopController::class, 'edit'])->name('superadmin.webshop.edit');
    Route::put('/webshop/{user}', [WebshopController::class, 'update'])->name('superadmin.webshop.update');
    Route::post('/webshop/create', [WebshopController::class, 'store'])->name('superadmin.webshop.store');

    Route::get('/deliveryCompany/create', [UserController::class, 'deliveryCompanyUserCreate'])->name('superadmin.delivery.create');
    Route::post('/deliveryCompany/create', [UserController::class, 'deliveryCompanyUserStore'])->name('superadmin.delivery.store');
});

Route::middleware(['auth', 'role:webshop'])->group(function () {
    Route::get('/employees', [UserController::class, 'employeesShow'])->name('webshop.user.show');
    Route::get('/user/create', [UserController::class, 'create'])->name('webshop.user.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('webshop.user.store');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('webshop.user.destroy');
    Route::get('/user/{user}', [UserController::class, 'edit'])->name('webshop.user.edit');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('webshop.user.update');

    //reviews
    Route::get('/reviews', [ReviewController::class, 'show'])->name('webshop.reviews.show');
});

Route::middleware(['auth', 'role:administrator'])->group(function () {
    //packaging
    Route::get('/labels', [PackageController::class, 'show'])->name('administrator.labels.show');
    Route::get('/label/create', [PackageController::class, 'create'])->name('administrator.labels.create');
    Route::post('/label/create', [PackageController::class, 'store'])->name('administrator.labels.store');
    Route::delete('/label/{label}', [PackageController::class, 'destroy'])->name('administrator.labels.destroy');
    Route::get('/label/{label}', [PackageController::class, 'edit'])->name('administrator.labels.edit');
    Route::put('/label/{label}', [PackageController::class, 'update'])->name('administrator.labels.update');
    Route::post('/pdf', [PackageController::class, 'generatePDF'])->name('administrator.labels.PDF');
    Route::post('/csv', [PackageController::class, 'importCSV'])->name('administrator.labels.importCSV');

    //pickups
    Route::get('/pickups', [PickupRequestController::class, 'show'])->name('administrator.pickups.show');
    Route::post('/pickups', [PickupRequestController::class, 'store'])->name('administrator.pickups.store');
    Route::get('/pickups/create', [PickupRequestController::class, 'create'])->name('administrator.pickups.create');

});

Route::middleware(['auth', 'role:packer'])->group(function () {
    Route::get('/packages/read', [PackageController::class, 'read'])->name('packer.packages.read');;
});


Route::middleware(['auth', 'role:courier'])->group(function () {
    Route::get('/registered/packages', [CourierController::class, 'show'])->name('courier.packages.show');;
});


Route::middleware(['auth', 'role:receiver_customer'])->group(function () {
    Route::get('/orders', [CustomerController::class, 'show'])->name('customer.show');
    Route::post('/review', [CustomerController::class, 'review'])->name('customer.review');
    Route::get('/details/{package}', [CustomerController::class, 'details'])->name('customer.details');
});

//authentication
Route::get('/generate-api-token', [ApiController::class, 'generateApiToken'])->name('generate-api-token')->middleware(['auth', 'role:administrator']);
Route::get('/generate-api-token/courier', [ApiController::class, 'generateApiToken'])->name('generate-api-token-courier')->middleware(['auth', 'role:courier']);



//languauge switcher
Route::post('/language/switch', function (Illuminate\Http\Request $request) {
    $locale = $request->input('locale');
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language.switch');



Route::get('lang/change', [LangController::class, 'index'])->name('lang.index');

require __DIR__ . '/auth.php';
