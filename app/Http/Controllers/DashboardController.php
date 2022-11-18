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
            'total_beli' => $total_beli->total_beli,
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
        $cars = DB::table('cars')
            ->select(['id', 'nama_kendaraan', 'merek', 'tgl_beli', 'keadaan_beli', 'umur_kendaraan']);

        return Datatables::of($cars)
            ->addColumn('action', function ($car) {
                return '<a href="/dashboard/car/'.$car->id.'/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form>';
            })
            // ->editColumn('id', 'ID: {{$id}}')
            // ->setRowId('id')
            ->addIndexColumn()
            ->make(true);
    }

    public function workerdata()
    {
        return Datatables::of(Worker::query())->make(true);
    }

    public function admindata()
    {
        $admins = DB::table('admins')
        ->select(['id', 'nama', 'no_wa', 'jenis']);

        return Datatables::of($admins)
            ->addColumn('action', function ($admin) {
                return '<a href="/dashboard/admin/' . $admin->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form>';
            })
            // ->editColumn('id', 'ID: {{$id}}')
            // ->setRowId('id')
            ->addIndexColumn()
            ->make(true);
    }

    public function farmerdata()
    {
        return Datatables::of(Farmer::query())->make(true);
    }

    public function loandata()
    {
        return Datatables::of(Loan::query())->make(true);
    }

        public function purchasedata()
    {
        return Datatables::of(Purchase::query())->make(true);
    }

    public function saledata()
    {
        return Datatables::of(Sale::query())->make(true);
    }

    public function fueldata()
    {
        return Datatables::of(Fuel::query())->make(true);
    }

    public function repairdata()
    {
        return Datatables::of(Repair::query())->make(true);
    }

}
