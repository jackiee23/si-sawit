<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(){
        $farmer = Farmer::all();
        $worker = Worker::all();

        return view('dashboard.report.index',[
            'title' => 'Laporan Umum',
            'farmer' => $farmer,
            'worker' => $worker
        ]);
    }

    public function reportdata(){
        $total_harga = DB::table('sales')
            // ->select(DB::raw("SUM(harga_total) as total_harga"))
            ->selectRaw("CAST(SUM(harga_total)as int) as total_harga")
            ->whereMonth('tgl_jual', now())
            ->whereYear('tgl_jual', now())
            ->first();

        $penjualan = DB::table('sales')
            ->selectRaw("CAST(SUM(harga_total)as int) as penjualan")
            ->whereYear('tgl_jual', now())
            ->groupByRaw('Month(tgl_jual)')
            ->orderByRaw('tgl_jual ASC')
            ->pluck('penjualan');

        $perbaikan = DB::table('repairs')
            ->selectRaw("CAST(SUM(jumlah)as int) as perbaikan")
            ->whereYear('tgl_perbaikan', now())
            ->whereMonth('tgl_perbaikan', now())
            ->first();

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

    }
}
