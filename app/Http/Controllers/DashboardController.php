<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Yajra\Datatables\Datatables;
use App\Models\Car;
use App\Models\Farmer;
use App\Models\Fuel;
use App\Models\Loan;
use App\Models\Purchase;
use App\Models\Repair;
use App\Models\Sale;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\Pure;

class DashboardController extends Controller
{
    public function index(){

        // $payment = Sale::find(1);

        // $month = date('F', strtotime($payment->tgl_jual));
        // $month = date('F', strtotime(now()));

        //penjualan bulan ini
        $total_harga = DB::table('sales')
        // ->select(DB::raw("SUM(harga_total) as total_harga"))
        ->selectRaw("CAST(SUM(harga_total)as int) as total_harga")
        ->whereMonth('tgl_jual', now())
        ->whereYear('tgl_jual', now())
        ->first();
        // ->whereMonth('created_at',now())
        // ->pluck('total_harga');
        // dd($month);
        // ->get()->toArray();
        // $type = gettype($total_harga);

        // dd($type);
        // dd($total_harga);

        //nama bulan
        $nama_bulan = DB::table('sales')
            ->selectRaw("MONTHNAME(tgl_jual) as nama_bulan")
            ->whereYear('tgl_jual', now())
            ->groupByRaw('MONTHNAME(tgl_jual)')
            ->orderByRaw('tgl_jual ASC')
            ->pluck('nama_bulan');
            // ->get()->all();
        // dd($nama_bulan);

        //penjualan tahun ini
        $penjualan = DB::table('sales')
        ->selectRaw("CAST(SUM(harga_total)as int) as penjualan")
        ->whereYear('tgl_jual', now())
        ->groupByRaw('Month(tgl_jual)')
        ->orderByRaw('tgl_jual ASC')
        ->pluck('penjualan');
        // dd($penjualan);

        //perbaikan bulan ini
        $perbaikan = DB::table('repairs')
        ->selectRaw("CAST(SUM(jumlah)as int) as perbaikan")
        ->whereYear('tgl_perbaikan', now())
        ->whereMonth('tgl_perbaikan', now())
        ->first();
        // dd($perbaikan);

        //pembelian bulan ini
        $total_beli = DB::table('purchases')
            // ->select(DB::raw("SUM(harga_total) as total_harga"))
            ->selectRaw("CAST(SUM(harga)as int) as total_beli")
            ->whereMonth('tgl_beli', now())
            ->whereYear('tgl_beli', now())
            ->first();

        //total sawit bulan ini
        $total_sawit = DB::table('purchases')
            // ->select(DB::raw("SUM(harga_total) as total_harga"))
            ->selectRaw("CAST(SUM(jumlah_sawit)as int) as total_sawit")
            ->whereMonth('tgl_beli', now())
            ->whereYear('tgl_beli', now())
            ->first();

        //total admin
        $total_admin = DB::table('admins')
            ->selectRaw("COUNT(id) as total_admin")
            // ->pluck('total_admin');
            ->first();
            // dd($total_admin);

        //total pekerja
        $total_pekerja = DB::table('workers')
            ->selectRaw("COUNT(id) as total_pekerja")
            // ->pluck('total_admin');
            ->first();
            // dd($total_pekerja);

        //total admin
        $total_petani = DB::table('farmers')
            ->selectRaw("COUNT(id) as total_petani")
            // ->pluck('total_admin');
            ->first();
            // dd($total_petani);




        return view('dashboard.index',[
            'title' => 'Dashboard',
            'total_bulanan' => $total_harga->total_harga,
            'total_beli' => $total_beli-> total_beli + $perbaikan->perbaikan,
            'total_sawit' => $total_sawit->total_sawit,
            'penjualan' => $penjualan,
            'nama_bulan' => $nama_bulan,
            'total_pekerja' => $total_pekerja->total_pekerja,
            'total_petani' => $total_petani->total_petani,
            'total_admin' => $total_admin->total_admin
        ]);
    }

    public function cardata()
    {
        // return Datatables::of(Car::query())->make(true);
        $cars = DB::table('cars');
            // ->select(['id', 'nama_kendaraan', 'merek', 'tgl_beli', 'keadaan_beli', 'umur_kendaraan']);

        return Datatables::of($cars)
            ->addColumn('action', function ($car) {
                return '<div class="text-center"><a href="/dashboard/car/'.$car->id.'/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            // ->editColumn('id', 'ID: {{$id}}')
            // ->setRowId('id')
            ->addIndexColumn()
            ->make(true);
    }

    public function workerdata()
    {
        $workers = DB::table('workers');
        // ->select(['id', 'nama', 'alamat', 'no_wa', 'jenis']);

        return Datatables::of($workers)
            ->addColumn('action', function ($worker) {
                return '<div class="text-center"><a href="/dashboard/worker/' . $worker->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            // ->editColumn('id', 'ID: {{$id}}')
            // ->setRowId('id')
            ->addIndexColumn()
            ->make(true);
    }

    public function admindata()
    {
        $admins = DB::table('admins');
        // ->select(['id', 'nama', 'no_wa', 'jenis']);

        return Datatables::of($admins)
            ->addColumn('action', function ($admin) {
                return '<div class="text-center"><a href="/dashboard/admin/' . $admin->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            // ->editColumn('id', 'ID: {{$id}}')
            // ->setRowId('id')
            ->addIndexColumn()
            ->make(true);
    }

    public function farmerdata()
    {
        $farmers = DB::table('farmers');
        // ->select(['id', 'nama', 'alamat', 'luas', 'jarak', 'umur', 'no_wa']);

        return Datatables::of($farmers)
            ->addColumn('action', function ($farmer) {
                return '<div class="text-center"><a href="/dashboard/farmer/' . $farmer->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            // ->editColumn('id', 'ID: {{$id}}')
            // ->setRowId('id')
            ->addIndexColumn()
            ->make(true);
    }

    public function loandata()
    {
        $loans = DB::table('loans');
        // ->select(['id', 'nama', 'tgl', 'nilai', 'jenis_pinjaman', 'keterangan']);

        return Datatables::of($loans)
            ->addColumn('action', function ($loan) {
                return '<div class="text-center"><a href="/dashboard/loan/' . $loan->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            ->editColumn('nilai', 'Rp.{{number_format($nilai,2,",",".")}}')
            // ->setRowId('id')
            ->addIndexColumn()
            ->make(true);
    }

        public function purchasedata(Request $request)
    {
        // dd($request->start_date);
        if($request->start_date && $request->end_date){
            $purchases = Purchase::with('car','worker','farmer')
                ->whereBetween('tgl_beli',[$request->start_date, $request->end_date]);
        } else {
            $purchases = Purchase::with('car', 'worker', 'farmer');
            // ->select(['id', 'tgl_panen', 'farmer.nama', 'selish', 'keterangan','tgl_beli','car->nama_kenradaan','trip','worker.nama']);
        }

        return Datatables::of($purchases)
            ->addColumn('action', function ($purchase) {
                return '<div class="text-center"><a href="/dashboard/purchase/' . $purchase->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            ->addColumn('car', function (Purchase $purchase) {
                return $purchase->car->nama_kendaraan;
            })
            ->addColumn('worker', function (Purchase $purchase) {
                return $purchase->worker->nama;
            })
            ->addColumn('farmer', function (Purchase $purchase) {
                return $purchase->farmer->nama;
            })
            // ->editColumn('nilai', 'Rp.{{number_format($nilai,2,",",".")}}')
            // ->setRowId('id')
            ->addIndexColumn()
            ->toJson();
            // ->make(true);
    }

    public function saledata()
    {
        $sales = Sale::with('car', 'worker');
        // ->select(['id', 'tgl_panen', 'farmer.nama', 'selish', 'keterangan','tgl_beli','car->nama_kenradaan','trip','worker.nama']);

        return Datatables::of($sales)
            ->addColumn('action', function ($sale) {
                return '<div class="text-center"><a href="/dashboard/sale/' . $sale->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            ->addColumn('car', function (Sale $sale) {
                return $sale->car->nama_kendaraan;
            })
            ->addColumn('worker', function (Sale $sale) {
                return $sale->worker->nama;
            })
            // ->editColumn('nilai', 'Rp.{{number_format($nilai,2,",",".")}}')
            // ->setRowId('id')
            ->addIndexColumn()
            ->toJson();
            // ->make(true);
    }

    public function fueldata()
    {
        $fuels = Fuel::with('car');
        // ->select(['id', 'tgl_panen', 'farmer.nama', 'selish', 'keterangan','tgl_beli','car->nama_kenradaan','trip','worker.nama']);

        return Datatables::of($fuels)
            ->addColumn('action', function ($fuel) {
                return '<div class="text-center"><a href="/dashboard/fuel/' . $fuel->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            ->addColumn('car', function (Fuel $fuel) {
                return $fuel->car->nama_kendaraan;
            })
            // ->editColumn('nilai', 'Rp.{{number_format($nilai,2,",",".")}}')
            // ->setRowId('id')
            ->addIndexColumn()
            ->toJson();
            // ->make(true);
    }

    public function repairdata()
    {
        $repairs = Repair::with('car');
        // ->select(['id', 'tgl_panen', 'farmer.nama', 'selish', 'keterangan','tgl_beli','car->nama_kenradaan','trip','worker.nama']);

        return Datatables::of($repairs)
            ->addColumn('action', function ($repair) {
                return '<div class="text-center"><a href="/dashboard/repair/' . $repair->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            ->addColumn('car', function (Repair $repair) {
                return $repair->car->nama_kendaraan;
            })
            // ->editColumn('nilai', 'Rp.{{number_format($nilai,2,",",".")}}')
            // ->setRowId('id')
            ->addIndexColumn()
            ->toJson();
            // ->make(true);
    }

}
