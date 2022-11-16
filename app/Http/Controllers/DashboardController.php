<?php

namespace App\Http\Controllers;

use App\Models\Sale;
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


        return view('dashboard.index',[
            'title' => 'Dashboard',
            'total_bulanan' => $total_harga->total_harga,
            'total_beli' => $total_beli->total_beli,
            'total_sawit' => $total_sawit->total_sawit,
            'penjualan' => $penjualan,
            'nama_bulan' => $nama_bulan
        ]);
    }

}
