<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RepaymentController;

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

Route::middleware('auth')->group(function(){

    Route::get('/logout', [PageController::class, 'logout']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    Route::get('dashboard/ganti-password', [PageController::class, 'change']);

    //server-side
    Route::get('/dashboard/fueldata', [DashboardController::class, 'fueldata'])->name('fueldata');
    Route::get('/dashboard/fuelday', [DashboardController::class, 'fuelday'])->name('fuelday');
    Route::get('/dashboard/farmerdata', [DashboardController::class, 'farmerdata'])->name('farmerdata');
    Route::get('/dashboard/farmdata', [DashboardController::class, 'farmdata'])->name('farmdata');
    Route::get('/dashboard/loandata', [DashboardController::class, 'loandata'])->name('loandata');
    Route::get('/dashboard/purchasedata', [DashboardController::class, 'purchasedata'])->name('purchasedata');
    Route::get('/dashboard/saledata', [DashboardController::class, 'saledata'])->name('saledata');
    Route::get('/dashboard/admindata', [DashboardController::class, 'admindata'])->name('admindata');
    Route::get('/dashboard/repairdata', [DashboardController::class, 'repairdata'])->name('repairdata');
    Route::get('/dashboard/workerdata', [DashboardController::class, 'workerdata'])->name('workerdata');
    Route::get('/dashboard/cardata', [DashboardController::class, 'cardata'])->name('cardata');
    Route::get('/dashboard/carday', [DashboardController::class, 'carday'])->name('carday');
    Route::get('/dashboard/sawitday', [DashboardController::class, 'sawitday'])->name('sawitday');
    Route::get('/dashboard/spend', [DashboardController::class, 'spend'])->name('spend');
    Route::get('/dashboard/profit', [DashboardController::class, 'profit'])->name('profit');
    Route::get('/dashboard/kategoridata', [DashboardController::class, 'kategoridata'])->name('kategoridata');
    Route::get('/dashboard/repaymentdata', [DashboardController::class, 'repaymentdata'])->name('repaymentdata');
    Route::get('/dashboard/petrolday', [DashboardController::class, 'petrolday'])->name('petrolday');
    Route::get('/dashboard/gambutdata', [DashboardController::class, 'gambutdata'])->name('gambutdata');
    Route::get('/dashboard/tanahdata', [DashboardController::class, 'tanahdata'])->name('tanahdata');
    Route::get('/dashboard/dataloaner', [DashboardController::class, 'dataloaner'])->name('dataloaner');


    //farmers
    // Route::get('/petani', [FarmerController::class, 'index']);
    // Route::get('/petani/create', [FarmerController::class, 'create']);
    // Route::post('/petani', [FarmerController::class, 'store']);
    Route::resource('/dashboard/farmer', FarmerController::class);

    Route::resource('/dashboard/farm', FarmController::class);
    Route::post('/dashboard/farm/create', [FarmController::class, 'getAllFields'])->name('getfarmer');

    //pruchase
    Route::resource('/dashboard/purchase', PurchaseController::class);

    //sale
    Route::resource('/dashboard/sale', SaleController::class);

    //fuel
    Route::resource('/dashboard/fuel', FuelController::class);

    //repair
    Route::resource('/dashboard/repair', RepairController::class);

    //pemeliharaan
    Route::resource('/dashboard/type', TypeController::class);

});

Route::middleware('admin')->group(function(){

    //admin
    Route::resource('/dashboard/admin', AdminController::class);

    //user
    Route::resource('/dashboard/user', UserController::class);

    //car
    Route::resource('/dashboard/car', CarController::class)->except(['show']);

    //worker
    Route::resource('/dashboard/worker', WorkerController::class);

    //loan
    Route::resource('/dashboard/loan', LoanController::class);
    Route::post('/dashboard/loan/create', [LoanController::class, 'getAllFields'])->name('getdata');

    //pengembalian
    Route::resource('/dashboard/repayment', RepaymentController::class);
    Route::get('selectNik', [RepaymentController::class, 'nik'])->name('getnik');
    Route::get('selectJenis/{id}', [RepaymentController::class, 'jenis'])->name('getjenis');

    //report
    Route::get('/dashboard/laporan-umum', [ReportController::class, 'index']);
    Route::get('/dashboard/laporan-khusus', [ReportController::class, 'particular']);

});

