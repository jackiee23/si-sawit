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
        ->select(DB::raw("CAST(SUM(harga_total)as int) as total_harga"))
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

        //pembelian bulan ini
        $total_beli = DB::table('purchases')
            // ->select(DB::raw("SUM(harga_total) as total_harga"))
            ->select(DB::raw("CAST(SUM(harga)as int) as total_beli"))
            ->whereMonth('tgl_beli', now())
            ->whereYear('tgl_beli', now())
            ->first();

            // dd($total_beli);

        return view('dashboard.index',[
            'title' => 'Dashboard',
            'total_bulanan' => $total_harga->total_harga,
            'total_beli' => $total_beli->total_beli
        ]);
    }

}
