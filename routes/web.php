<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\PurchaseController;

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
    return view('dashboard',[
        "title" => "Dashboard"
    ]);
});

//farmers
// Route::get('/petani', [FarmerController::class, 'index']);
// Route::get('/petani/create', [FarmerController::class, 'create']);
// Route::post('/petani', [FarmerController::class, 'store']);
Route::resource('/farmer', FarmerController::class);


//admin
Route::resource('/admin', AdminController::class);

//car
Route::resource('/car', CarController::class);

//worker
Route::resource('/worker', WorkerController::class);

//loan
Route::resource('/loan', LoanController::class);

//pruchase
Route::resource('/purchase', PurchaseController::class);

//sale
Route::resource('/sale', SaleController::class);

//fuel
Route::resource('/fuel', FuelController::class);

//repair
Route::resource('/repair', RepairController::class);

