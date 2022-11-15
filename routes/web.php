<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [PageController::class, 'index'])->middleware('guest')->name('login');
Route::post('/', [PageController::class, 'authenticate']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

//farmers
// Route::get('/petani', [FarmerController::class, 'index']);
// Route::get('/petani/create', [FarmerController::class, 'create']);
// Route::post('/petani', [FarmerController::class, 'store']);
Route::resource('/dashboard/farmer', FarmerController::class)->middleware('auth');


//admin
Route::resource('/dashboard/admin', AdminController::class)->middleware('auth');

//car
Route::resource('/dashboard/car', CarController::class)->middleware('auth');

//worker
Route::resource('/dashboard/worker', WorkerController::class)->middleware('auth');

//loan
Route::resource('/dashboard/loan', LoanController::class)->middleware('auth');

//pruchase
Route::resource('/dashboard/purchase', PurchaseController::class)->middleware('auth');

//sale
Route::resource('/dashboard/sale', SaleController::class)->middleware('auth');

//fuel
Route::resource('/dashboard/fuel', FuelController::class)->middleware('auth');

//repair
Route::resource('/dashboard/repair', RepairController::class)->middleware('auth');

