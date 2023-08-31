<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Yajra\Datatables\Datatables;
use App\Models\Car;
use App\Models\Farm;
use App\Models\Farmer;
use App\Models\Fuel;
use App\Models\Loan;
use App\Models\Purchase;
use App\Models\Repair;
use App\Models\Repayment;
use App\Models\Sale;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\Pure;
use PhpParser\Node\Stmt\Else_;

class DashboardController extends Controller
{
    public function index()
    {
        //pemasukan bulan ini
        $total_harga = DB::table('sales')
            // ->select(DB::raw("SUM(harga_total) as total_harga"))
            ->selectRaw("CAST(SUM(harga_total)as int) as total_harga")
            ->whereMonth('tgl_jual', now())
            ->whereYear('tgl_jual', now())
            ->first();

        //pemasukan bulan ini
        $total_harga2 = DB::table('sales')
            // ->select(DB::raw("SUM(harga_total) as total_harga"))
            ->selectRaw("CAST(SUM(harga_total)as int) as total_harga")
            ->whereDate('tgl_jual', now())
            // ->whereMonth('tgl_jual', now())
            ->first();

        //date pembelian
        $date_beli = DB::table('purchases')
        ->selectRaw("tgl_beli as tgl_bulan")
        ->groupByRaw('tgl_beli')
        ->orderByRaw('tgl_beli ASC')
        ->pluck('tgl_bulan');

        //nama bulan
        $nama_bulan = DB::table('sales')
            ->selectRaw("MONTHNAME(tgl_jual) as nama_bulan")
            ->whereYear('tgl_jual', now())
            ->groupByRaw('MONTHNAME(tgl_jual)')
            ->orderByRaw('tgl_jual ASC')
            ->pluck('nama_bulan');

        //penjualan tahun ini
        $penjualan = DB::table('sales')
            ->selectRaw("CAST(SUM(harga_total)as int) as penjualan")
            ->whereYear('tgl_jual', now())
            ->groupByRaw('Month(tgl_jual)')
            ->orderByRaw('tgl_jual ASC')
            ->pluck('penjualan');

        //penjualan tahun ini
        $pengeluaran = DB::table('purchases')
        ->selectRaw("CAST(SUM(harga_total)as int) as pengeluaran")
        ->whereYear('tgl_beli', now())
        ->groupByRaw('Month(tgl_beli)')
        ->orderByRaw('tgl_beli ASC')
        ->pluck('pengeluaran');


        //perbaikan bulan ini
        $perbaikan = DB::table('repairs')
            ->selectRaw("CAST(SUM(jumlah)as int) as perbaikan")
            ->whereYear('tgl_perbaikan', now())
            ->whereMonth('tgl_perbaikan', now())
            ->first();

        //perbaikan bulan ini
        $perbaikan2 = DB::table('repairs')
        ->selectRaw("CAST(SUM(jumlah)as int) as perbaikan")
        ->whereDate('tgl_perbaikan', now())
        ->first();

        //pbahan bakar bulan ini
        $bensin = DB::table('fuels')
        ->selectRaw("CAST(SUM(harga_total)as int) as bensin")
        ->whereYear('tgl_pengisian', now())
        ->whereMonth('tgl_pengisian', now())
        ->first();

        //pbahan bakar hari ini
        $bensin2 = DB::table('fuels')
            ->selectRaw("CAST(SUM(harga_total)as int) as bensin")
            ->whereDate('tgl_pengisian', now())
            ->first();

        //pembelian bulan ini
        $total_beli = DB::table('purchases')
            // ->select(DB::raw("SUM(harga_total) as total_harga"))
            ->selectRaw("CAST(SUM(harga_total)as int) as total_beli")
            ->whereMonth('tgl_beli', now())
            ->whereYear('tgl_beli', now())
            ->first();

        //pembelian bulan ini
        $total_beli2 = DB::table('purchases')
            // ->select(DB::raw("SUM(harga_total) as total_harga"))
            ->selectRaw("CAST(SUM(harga_total)as int) as total_beli")
            ->whereDate('tgl_beli', now())
            ->first();

        //total sawit bulan ini
        // $total_sawit = DB::table('purchases')
        //     ->selectRaw("CAST(SUM(jumlah_sawit)as int) as total_sawit")
        //     ->whereMonth('tgl_beli', now())
        //     ->whereYear('tgl_beli', now())
        //     ->first();

        //total admin
        $total_admin = DB::table('admins')
            ->selectRaw("COUNT(id) as total_admin")
            ->first();

        //total pekerja
        $total_pekerja = DB::table('workers')
            ->selectRaw("COUNT(id) as total_pekerja")
            ->first();

        //total admin
        $total_petani = DB::table('farmers')
            ->selectRaw("COUNT(id) as total_petani")
            ->first();

        $outcome = $total_beli->total_beli + $perbaikan->perbaikan + $bensin->bensin;
        $outcome2 = $total_beli2->total_beli + $perbaikan2->perbaikan + $bensin2->bensin;

        $total_selis = DB::table('purchases')
            // ->select(DB::raw("SUM(harga_total) as total_harga"))
            ->selectRaw("CAST(SUM(jumlah_sawit)as int) as sawit")
            ->whereMonth('tgl_beli', now())
            ->whereYear('tgl_beli', now())
            ->first();

        $total_selis2 = DB::table('purchases')
            // ->select(DB::raw("SUM(harga_total) as total_harga"))
            ->selectRaw("CAST(SUM(jumlah_sawit)as int) as sawit")
            ->whereDate('tgl_beli', now())
            ->first();

        $total_sawit = DB::table('sales')
            // ->select(DB::raw("SUM(harga_total) as total_harga"))
            ->selectRaw("CAST(SUM(jumlah)as int) as sawit")
            ->whereMonth('tgl_jual', now())
            ->whereYear('tgl_jual', now())
            ->first();

        $total_sawit2 = DB::table('sales')
            // ->select(DB::raw("SUM(harga_total) as total_harga"))
            ->selectRaw("CAST(SUM(jumlah)as int) as sawit")
            ->whereDate('tgl_jual', now())
            // ->whereMonth('tgl_jual', now())
            ->first();

            // if (is_null($total_sawit2->sawit)){
            //     $total_sawit = 7;
            // };

            $total_selisih = $total_sawit->sawit - $total_selis->sawit;
            $total_selisih2 = $total_sawit2->sawit - $total_selis2->sawit;



        return view('dashboard.index', [
            'title' => 'Dashboard',
            'pabrik' => $total_harga->total_harga,
            'pabrik2' => $total_harga2->total_harga,
            'beli_petani' => $total_beli->total_beli,
            'beli_petani2' => $total_beli2->total_beli,
            'operasional' => $outcome,
            'operasional2' => $outcome2,
            'total_omset' => $total_harga->total_harga - $outcome,
            'total_omset2' => $total_harga2->total_harga - $outcome2,
            'penjualan' => $penjualan,
            'pengeluaran' => $pengeluaran,
            'nama_bulan' => $nama_bulan,
            'total_pekerja' => $total_pekerja->total_pekerja,
            'total_selisih2' => $total_selisih2,
            'total_selisih' => $total_selisih
        ]);
    }

    public function carday(Request $request)
    {
        // return Datatables::of(Car::query())->make(true);
        if ($request->start_date && $request->end_date) {
            //report kendaraan
            $cars = Purchase::with('car')
                ->join('farms', 'farm_id', '=', 'farms.id')
                ->select(DB::raw('count(car_id) as jumlah_kebun'), DB::raw('DATE(tgl_beli) as tanggal'), 'car_id', DB::raw('sum(farms.jarak*purchases.trip*2)as jarak_total'))
                // ->whereColumn('car_id', 'cars.id')
                ->addSelect([
                    'harga_total' => Fuel::selectRaw('sum(harga_total)')
                        ->whereColumn('car_id', 'purchases.car_id')
                        ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                        ->groupBy('purchases.tgl_beli')
                        ->limit(1),
                    'jumlah_liter' => Fuel::selectRaw('sum(jumlah_liter)')
                        ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                        ->whereColumn('car_id', 'purchases.car_id')
                        ->groupBy('purchases.tgl_beli')
                        ->limit(1),
                    'perbaikan' => Repair::selectRaw('sum(jumlah)')
                        ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
                        ->whereColumn('car_id', 'purchases.car_id')
                        ->groupBy('purchases.tgl_beli')
                        ->limit(1),
                    // 'konsumsi' => Fuel::selectRaw('sum(jumlah_liter/(farms.jarak*purchases.trip*2))')
                    // ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                    // ->whereColumn('car_id', 'purchases.car_id')
                    // ->groupBy('purchases.tgl_beli')
                    // ->limit(1),
                    // 'konsumsi_bahan' =>
                    // 'bahan_bakar' => Fuel::selectRaw("CAST(SUM(harga_total)as int) as total_harga")->whereColumn('car_id', 'cars.id')->groupByRaw('tgl_pengisian')
                    // ->limit(1)
                ])
                // ->groupBy('tgl_pengisian')
                // ->whereColumn(['fuels.car_id', 'purchase.car_id'], ['fuels.tgl_pengisian', 'purchases.tgl_beli'])
                ->groupBy('car_id')
                ->groupBy('tgl_beli')
                ->orderBy('tgl_beli')
                ->whereBetween('purchases.tgl_beli', [$request->start_date, $request->end_date])
                ->get();
            // dd($cars);

        } else if ($request->start_date && $request->end_date && $request->car_id) {
            //report kendaraan
            $cars = Purchase::with('car')
                ->join('farms', 'farm_id', '=', 'farms.id')
                ->select(DB::raw('count(car_id) as jumlah_kebun'), DB::raw('DATE(tgl_beli) as tanggal'), 'car_id', DB::raw('sum(farms.jarak*purchases.trip*2)as jarak_total'))
                // ->whereColumn('car_id', 'cars.id')
                ->addSelect([
                    'harga_total' => Fuel::selectRaw('sum(harga_total)')
                    ->whereColumn('car_id', 'purchases.car_id')
                    ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                    ->groupBy('purchases.tgl_beli')
                    ->limit(1),
                    'jumlah_liter' => Fuel::selectRaw('sum(jumlah_liter)')
                    ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                    ->whereColumn('car_id', 'purchases.car_id')
                    ->groupBy('purchases.tgl_beli')
                    ->limit(1),
                    'perbaikan' => Repair::selectRaw('sum(jumlah)')
                    ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
                    ->whereColumn('car_id', 'purchases.car_id')
                    ->groupBy('purchases.tgl_beli')
                    ->limit(1),
                    // 'konsumsi' => Fuel::selectRaw('sum(jumlah_liter/(farms.jarak*purchases.trip*2))')
                    // ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                    // ->whereColumn('car_id', 'purchases.car_id')
                    // ->groupBy('purchases.tgl_beli')
                    // ->limit(1),
                    // 'konsumsi_bahan' =>
                    // 'bahan_bakar' => Fuel::selectRaw("CAST(SUM(harga_total)as int) as total_harga")->whereColumn('car_id', 'cars.id')->groupByRaw('tgl_pengisian')
                    // ->limit(1)
                ])
                // ->groupBy('tgl_pengisian')
                // ->whereColumn(['fuels.car_id', 'purchase.car_id'], ['fuels.tgl_pengisian', 'purchases.tgl_beli'])
                ->groupBy('car_id')
                ->groupBy('tgl_beli')
                ->orderBy('tgl_beli')
                ->whereBetween('purchases.tgl_beli', [$request->start_date, $request->end_date])
                ->where('purchases.car_id', $request->car_id)
                ->get();
        } else if ($request->car_id) {
            //report kendaraan
            $cars = Purchase::with('car')
                ->join('farms', 'farm_id', '=', 'farms.id')
                ->select(DB::raw('count(car_id) as jumlah_kebun'), DB::raw('DATE(tgl_beli) as tanggal'), 'car_id', DB::raw('sum(farms.jarak*purchases.trip*2)as jarak_total'))
                // ->whereColumn('car_id', 'cars.id')
                ->addSelect([
                    'harga_total' => Fuel::selectRaw('sum(harga_total)')
                    ->whereColumn('car_id',
                        'purchases.car_id'
                    )
                    ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                    ->groupBy('purchases.tgl_beli')
                    ->limit(1),
                    'jumlah_liter' => Fuel::selectRaw('sum(jumlah_liter)')
                    ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                    ->whereColumn('car_id',
                        'purchases.car_id'
                    )
                    ->groupBy('purchases.tgl_beli')
                    ->limit(1),
                    'perbaikan' => Repair::selectRaw('sum(jumlah)')
                    ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
                    ->whereColumn('car_id',
                        'purchases.car_id'
                    )
                    ->groupBy('purchases.tgl_beli')
                    ->limit(1),
                    // 'konsumsi' => Fuel::selectRaw('sum(jumlah_liter/(farms.jarak*purchases.trip*2))')
                    // ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                    // ->whereColumn('car_id', 'purchases.car_id')
                    // ->groupBy('purchases.tgl_beli')
                    // ->limit(1),
                    // 'konsumsi_bahan' =>
                    // 'bahan_bakar' => Fuel::selectRaw("CAST(SUM(harga_total)as int) as total_harga")->whereColumn('car_id', 'cars.id')->groupByRaw('tgl_pengisian')
                    // ->limit(1)
                ])
                // ->groupBy('tgl_pengisian')
                // ->whereColumn(['fuels.car_id', 'purchase.car_id'], ['fuels.tgl_pengisian', 'purchases.tgl_beli'])
                ->groupBy('car_id')
                ->groupBy('tgl_beli')
                ->orderBy('tgl_beli')
                ->where('purchases.car_id', $request->car_id)
                ->get();
        } else {
            //report kendaraan
            $cars = Purchase::with('car')
                ->join('farms', 'farm_id', '=', 'farms.id')
                ->select(DB::raw('count(car_id) as jumlah_kebun'), DB::raw('DATE(tgl_beli) as tanggal'), 'car_id', DB::raw('sum(farms.jarak*purchases.trip*2)as jarak_total'))
                // ->whereColumn('car_id', 'cars.id')
                ->addSelect([
                    'harga_total' => Fuel::selectRaw('sum(harga_total)')
                    ->whereColumn('car_id',
                        'purchases.car_id'
                    )
                    ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                    ->groupBy('purchases.tgl_beli')
                    ->limit(1),
                    'jumlah_liter' => Fuel::selectRaw('sum(jumlah_liter)')
                    ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                    ->whereColumn('car_id',
                        'purchases.car_id'
                    )
                    ->groupBy('purchases.tgl_beli')
                    ->limit(1),
                    'perbaikan' => Repair::selectRaw('sum(jumlah)')
                    ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
                    ->whereColumn('car_id',
                        'purchases.car_id'
                    )
                    ->groupBy('purchases.tgl_beli')
                    ->limit(1),
                    // 'konsumsi' => Fuel::selectRaw('sum(jumlah_liter/(farms.jarak*purchases.trip*2))')
                    // ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                    // ->whereColumn('car_id', 'purchases.car_id')
                    // ->groupBy('purchases.tgl_beli')
                    // ->limit(1),
                    // 'konsumsi_bahan' =>
                    // 'bahan_bakar' => Fuel::selectRaw("CAST(SUM(harga_total)as int) as total_harga")->whereColumn('car_id', 'cars.id')->groupByRaw('tgl_pengisian')
                    // ->limit(1)
                ])
                // ->groupBy('tgl_pengisian')
                // ->whereColumn(['fuels.car_id', 'purchase.car_id'], ['fuels.tgl_pengisian', 'purchases.tgl_beli'])
                ->groupBy('car_id')
                ->groupBy('tgl_beli')
                ->orderBy('tgl_beli')
                ->get();
        }

        // dd($cars);

        return Datatables::of($cars)
            // ->addColumn('konsumsi', function ($car) {
            //     if($car->jumlah_liter == 0 ){
            //         return number_format($car->jumlah_liter / $car->jarak_total, 2);
            //     } else {
            //         return number_format($car->jarak_total/ $car->jumlah_liter, 2);
            //     }
            // })
            ->addColumn('car_id', function (Purchase $purchase) {
                return $purchase->car->nama_kendaraan;
            })
            ->editColumn('perbaikan', 'Rp.{{number_format($perbaikan,2,",",".")}}')
            ->addIndexColumn()
            ->make(true);
    }

    public function petrolday(Request $request)
    {
        //date pembelian
        $date_beli = DB::table('purchases')
        ->selectRaw("tgl_beli as tgl_bulan")
        ->groupByRaw('tgl_beli')
        ->orderByRaw('tgl_beli ASC')
        ->pluck('tgl_bulan');

        // return Datatables::of(Car::query())->make(true);
        if ($request->start_date && $request->end_date) {
            //report kendaraan
            $cars = Purchase::with('car')
            ->join('farms', 'farm_id', '=', 'farms.id')
            ->select(DB::raw('count(car_id) as jumlah_kebun'), DB::raw('DATE(tgl_beli) as tanggal'), 'car_id', DB::raw('sum(farms.jarak*purchases.trip*2)as jarak_total'))
            // ->whereColumn('car_id', 'cars.id')
            ->addSelect([
                'harga_total' => Fuel::selectRaw('sum(harga_total)')
                ->whereColumn('car_id', 'purchases.car_id')
                ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                ->groupBy('purchases.tgl_beli')
                ->limit(1),
                'jumlah_liter' => Fuel::selectRaw('sum(jumlah_liter)')
                ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                ->whereColumn('car_id', 'purchases.car_id')
                ->groupBy('purchases.tgl_beli')
                ->limit(1),
                'perbaikan' => Repair::selectRaw('sum(jumlah)')
                ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
                ->whereColumn('car_id', 'purchases.car_id')
                ->groupBy('purchases.tgl_beli')
                ->limit(1),
                // 'konsumsi' => Fuel::selectRaw('sum(jumlah_liter/(farms.jarak*purchases.trip*2))')
                // ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                // ->whereColumn('car_id', 'purchases.car_id')
                // ->groupBy('purchases.tgl_beli')
                // ->limit(1),
                // 'konsumsi_bahan' =>
                // 'bahan_bakar' => Fuel::selectRaw("CAST(SUM(harga_total)as int) as total_harga")->whereColumn('car_id', 'cars.id')->groupByRaw('tgl_pengisian')
                // ->limit(1)
            ])
                // ->groupBy('tgl_pengisian')
                // ->whereColumn(['fuels.car_id', 'purchase.car_id'], ['fuels.tgl_pengisian', 'purchases.tgl_beli'])
                ->groupBy('car_id')
                ->groupBy('tgl_beli')
                ->orderBy('tgl_beli')
                ->whereBetween('purchases.tgl_beli', [$request->start_date, $request->end_date])
                ->get();
            // dd($cars);

            // $fuel = Fuel::with('car')
            //     ->select(DB::raw('DATE(tgl_pengisian) as tanggal'), 'car_id', 'jumlah_liter')
            //     ->addSelect([
            //         'jarak_total' => 0,
            //     ])
            //     ->groupBy('car_id')
            //     ->groupBy('tgl_pengisian')
            //     ->whereNotIn('tgl_pengisian', $date_beli)
            //     ->orderBy('tgl_pengisian')
            //     ->whereBetween('tgl_pengisian', [$request->start_date, $request->end_date])
            //     ->get();

        } else if ($request->start_date && $request->end_date && $request->car_id) {
            //report kendaraan
            $cars = Purchase::with('car')
            ->join('farms', 'farm_id', '=', 'farms.id')
            ->select(DB::raw('count(car_id) as jumlah_kebun'), DB::raw('DATE(tgl_beli) as tanggal'), 'car_id', DB::raw('sum(farms.jarak*purchases.trip*2)as jarak_total'))
            // ->whereColumn('car_id', 'cars.id')
            ->addSelect([
                'harga_total' => Fuel::selectRaw('sum(harga_total)')
                ->whereColumn('car_id', 'purchases.car_id')
                ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                ->groupBy('purchases.tgl_beli')
                ->limit(1),
                'jumlah_liter' => Fuel::selectRaw('sum(jumlah_liter)')
                ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                ->whereColumn('car_id', 'purchases.car_id')
                ->groupBy('purchases.tgl_beli')
                ->limit(1),
                'perbaikan' => Repair::selectRaw('sum(jumlah)')
                ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
                ->whereColumn('car_id', 'purchases.car_id')
                ->groupBy('purchases.tgl_beli')
                ->limit(1),
                // 'konsumsi' => Fuel::selectRaw('sum(jumlah_liter/(farms.jarak*purchases.trip*2))')
                // ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                // ->whereColumn('car_id', 'purchases.car_id')
                // ->groupBy('purchases.tgl_beli')
                // ->limit(1),
                // 'konsumsi_bahan' =>
                // 'bahan_bakar' => Fuel::selectRaw("CAST(SUM(harga_total)as int) as total_harga")->whereColumn('car_id', 'cars.id')->groupByRaw('tgl_pengisian')
                // ->limit(1)
            ])
                // ->groupBy('tgl_pengisian')
                // ->whereColumn(['fuels.car_id', 'purchase.car_id'], ['fuels.tgl_pengisian', 'purchases.tgl_beli'])
                ->groupBy('car_id')
                ->groupBy('tgl_beli')
                ->orderBy('tgl_beli')
                ->whereBetween('purchases.tgl_beli', [$request->start_date, $request->end_date])
                ->where('purchases.car_id', $request->car_id)
                ->get();
        } else if ($request->car_id) {
            //report kendaraan
            $cars = Purchase::with('car')
            ->join('farms', 'farm_id', '=', 'farms.id')
            ->select(DB::raw('count(car_id) as jumlah_kebun'), DB::raw('DATE(tgl_beli) as tanggal'), 'car_id', DB::raw('sum(farms.jarak*purchases.trip*2)as jarak_total'))
            // ->whereColumn('car_id', 'cars.id')
            ->addSelect([
                'harga_total' => Fuel::selectRaw('sum(harga_total)')
                ->whereColumn(
                    'car_id',
                    'purchases.car_id'
                )
                    ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                    ->groupBy('purchases.tgl_beli')
                    ->limit(1),
                'jumlah_liter' => Fuel::selectRaw('sum(jumlah_liter)')
                ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                ->whereColumn(
                    'car_id',
                    'purchases.car_id'
                )
                    ->groupBy('purchases.tgl_beli')
                    ->limit(1),
                'perbaikan' => Repair::selectRaw('sum(jumlah)')
                ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
                ->whereColumn(
                    'car_id',
                    'purchases.car_id'
                )
                    ->groupBy('purchases.tgl_beli')
                    ->limit(1),
                // 'konsumsi' => Fuel::selectRaw('sum(jumlah_liter/(farms.jarak*purchases.trip*2))')
                // ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                // ->whereColumn('car_id', 'purchases.car_id')
                // ->groupBy('purchases.tgl_beli')
                // ->limit(1),
                // 'konsumsi_bahan' =>
                // 'bahan_bakar' => Fuel::selectRaw("CAST(SUM(harga_total)as int) as total_harga")->whereColumn('car_id', 'cars.id')->groupByRaw('tgl_pengisian')
                // ->limit(1)
            ])
                // ->groupBy('tgl_pengisian')
                // ->whereColumn(['fuels.car_id', 'purchase.car_id'], ['fuels.tgl_pengisian', 'purchases.tgl_beli'])
                ->groupBy('car_id')
                ->groupBy('tgl_beli')
                ->orderBy('tgl_beli')
                ->where('purchases.car_id', $request->car_id)
                ->get();
        } else {
            //report kendaraan
            $cars = Purchase::with('car')
            ->join('farms', 'farm_id', '=', 'farms.id')
            ->select(DB::raw('count(car_id) as jumlah_kebun'), DB::raw('DATE(tgl_beli) as tanggal'), 'car_id', DB::raw('sum(farms.jarak*purchases.trip*2)as jarak_total'))
            // ->whereColumn('car_id', 'cars.id')
            ->addSelect([
                'harga_total' => Fuel::selectRaw('sum(harga_total)')
                ->whereColumn(
                    'car_id',
                    'purchases.car_id'
                )
                    ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                    ->groupBy('purchases.tgl_beli')
                    ->limit(1),
                'jumlah_liter' => Fuel::selectRaw('sum(jumlah_liter)')
                ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                ->whereColumn(
                    'car_id',
                    'purchases.car_id'
                )
                    ->groupBy('purchases.tgl_beli')
                    ->limit(1),
                'perbaikan' => Repair::selectRaw('sum(jumlah)')
                ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
                ->whereColumn(
                    'car_id',
                    'purchases.car_id'
                )
                    ->groupBy('purchases.tgl_beli')
                    ->limit(1),
                // 'konsumsi' => Fuel::selectRaw('sum(jumlah_liter/(farms.jarak*purchases.trip*2))')
                // ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                // ->whereColumn('car_id', 'purchases.car_id')
                // ->groupBy('purchases.tgl_beli')
                // ->limit(1),
                // 'konsumsi_bahan' =>
                // 'bahan_bakar' => Fuel::selectRaw("CAST(SUM(harga_total)as int) as total_harga")->whereColumn('car_id', 'cars.id')->groupByRaw('tgl_pengisian')
                // ->limit(1)
            ])
                // ->groupBy('tgl_pengisian')
                // ->whereColumn(['fuels.car_id', 'purchase.car_id'], ['fuels.tgl_pengisian', 'purchases.tgl_beli'])
                ->groupBy('car_id')
                ->groupBy('tgl_beli')
                ->orderBy('tgl_beli')
                ->get();

                // $fuel = Fuel::with('car')
                // ->select(DB::raw('DATE(tgl_pengisian) as tanggal'), 'car_id', 'jumlah_liter')
                // ->addSelect([
                //     'jarak_total' => Fuel::selectRaw('sum(harga_total)')
                // ->whereColumn(
                //     'car_id',
                //     'harga_total'
                // )
                // ->limit(1),
                // ])
                // ->groupBy('car_id')
                // ->groupBy('tgl_pengisian')
                // ->whereNotIn('tgl_pengisian', $date_beli)
                // ->orderBy('tgl_pengisian')
                // ->get();
        }

        // $petrol = $cars->concat($fuel);

        return Datatables::of($cars)
            ->addColumn('car_id', function (Purchase $purchase) {
                return $purchase->car->nama_kendaraan;
            })
            ->addColumn('konsumsi', function ($car) {
            if ($car->jumlah_liter == 0) {
                return $car->jumlah_liter / $car->jarak_total;
            } else {
                return $car->jarak_total / $car->jumlah_liter;
            }
            })
            // ->editColumn('perbaikan', 'Rp.{{number_format($perbaikan,2,",",".")}}')
            ->addIndexColumn()
            ->make(true);
    }

    public function sawitday(Request $request)
    {
        //date pembelian
        $date_beli = DB::table('purchases')
        ->selectRaw("tgl_beli as tgl_bulan")
        ->groupByRaw('tgl_beli')
        ->orderByRaw('tgl_beli ASC')
        ->pluck('tgl_bulan');

        if($request->start_date && $request->end_date){
            //date penjualan
            $total_hjual = DB::table('sales')
                ->select('tgl_jual as tgl_beli', DB::Raw("CAST(SUM(jumlah)as int) as penjualan_sawit"))
                ->addSelect([
                    'pembelian_sawit' => Purchase::selectRaw('cast(sum(jumlah_sawit)as int)')
                        ->whereColumn('tgl_beli', 'sales.tgl_jual')
                        ->groupBy('sales.tgl_jual')
                        ->limit(1),
                ])
                ->whereNotIn('tgl_jual', $date_beli)
                ->whereBetween('tgl_jual', [$request->start_date, $request->end_date])
                ->groupByRaw('tgl_jual')
                ->orderByRaw('tgl_jual ASC')
                ->get();

            //pembelian hari ini
            $total_hbeli = DB::table('purchases')
                ->select('tgl_beli', DB::Raw("CAST(SUM(jumlah_sawit)as int) as pembelian_sawit",))
                ->addSelect([
                    'penjualan_sawit' => Sale::selectRaw('cast(sum(jumlah)as int)')
                        ->whereColumn('tgl_jual', 'purchases.tgl_beli')
                        ->groupBy('purchases.tgl_beli')
                        ->limit(1),
                ])
                ->whereBetween('tgl_beli', [$request->start_date, $request->end_date])
                ->groupBy('tgl_beli')
                ->get();
        } else{
            //date penjualan
            $total_hjual = DB::table('sales')
                ->select('tgl_jual as tgl_beli', DB::Raw("CAST(SUM(jumlah)as int) as penjualan_sawit"))
                ->addSelect([
                    'pembelian_sawit' => Purchase::selectRaw('cast(sum(jumlah_sawit)as int)')
                        ->whereColumn('tgl_beli', 'sales.tgl_jual')
                        ->groupBy('sales.tgl_jual')
                        ->limit(1),
                ])
                ->whereNotIn('tgl_jual', $date_beli)
                ->groupByRaw('tgl_jual')
                ->orderByRaw('tgl_jual ASC')
                ->get();

            //pembelian hari ini
            $total_hbeli = DB::table('purchases')
                ->select('tgl_beli', DB::Raw("CAST(SUM(jumlah_sawit)as int) as pembelian_sawit",))
                ->addSelect([
                    'penjualan_sawit' => Sale::selectRaw('cast(sum(jumlah)as int)')
                        ->whereColumn('tgl_jual', 'purchases.tgl_beli')
                        ->groupBy('purchases.tgl_beli')
                        ->limit(1),
                ])
                ->groupBy('tgl_beli')
                ->get();
        }

        $dates = $total_hjual->concat($total_hbeli);

        return Datatables::of($dates)
            ->addIndexColumn()
            ->addColumn('selisih', function ($date) {
                return $date->penjualan_sawit - $date->pembelian_sawit;
            })
            ->make(true);
    }

    public function cardata()
    {

        $cars = DB::table('cars');

        return Datatables::of($cars)
            ->addColumn('action', function ($car) {
                return '<div class="text-center"><a href="/dashboard/car/' . $car->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function workerdata()
    {
        $workers = DB::table('workers');

        return Datatables::of($workers)
            ->addColumn('action', function ($worker) {
                return '<div class="text-center"><a href="/dashboard/worker/' . $worker->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function admindata()
    {
        $email = auth()->user()->email;

        $admins = DB::table('users')
            ->where('email', '!=', $email)
            ->get();

        return Datatables::of($admins)
            ->addColumn('action', function ($admin) {
                return '<div class="text-center"><a href="/dashboard/user/' . $admin->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            ->addIndexColumn()
            ->make(true);
    }
    public function kategoridata()
    {
        $types = DB::table('types');

        return Datatables::of($types)
            ->addColumn('action', function ($type) {
                return '<div class="text-center"><a href="/dashboard/type/' . $type->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            ->addIndexColumn()
            ->make(true);
    }
    public function farmerdata()
    {
        $farmers = DB::table('farmers');

        return Datatables::of($farmers)
            ->addColumn('action', function ($farmer) {
                return '<div class="text-center"><a href="/dashboard/farmer/' . $farmer->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function farmdata()
    {
        $farm = Farm::with('farmer');

        return Datatables::of($farm)
            ->addColumn('action', function ($farm) {
                return '<div class="text-center"><a href="/dashboard/farm/' . $farm->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            ->addColumn('nama_petani', function (Farm $farm) {
                return $farm->farmer->nama;
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function loandata()
    {
        $loans = DB::table('loans');

        return Datatables::of($loans)
            ->addColumn('action', function ($loan) {
                return '<div class="text-center"><a href="/dashboard/loan/' . $loan->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            // ->editColumn('nilai', 'Rp.{{number_format($nilai,2,",",".")}}')
            ->addIndexColumn()
            ->make(true);
    }

    public function repaymentdata()
    {
        $repayments = Repayment::with('loan');

        return Datatables::of($repayments)
            ->addColumn('action', function ($repayment) {
                return '<div class="text-center"><a href="/dashboard/repayment/' . $repayment->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            // ->editColumn('nilai', 'Rp.{{number_format($nilai,2,",",".")}}')
            // ->editColumn('hutang', 'Rp.{{number_format($hutang,2,",",".")}}')
            ->addColumn('loan', function (Repayment $repayment) {
                return $repayment->loan->nama;
            })
            ->addColumn('hutang', function (Repayment $repayment) {
                return $repayment->loan->nilai;
            })
            ->addColumn('jenis', function (Repayment $repayment) {
                return $repayment->loan->jenis_pinjaman;
            })
            ->addColumn('status', function (Repayment $repayment) {
                if($repayment->loan->nilai <= $repayment->nilai) {
                    return 'LUNAS';
                } else {
                    return 'BELUM LUNAS';
                }
            })
            ->addIndexColumn()
            ->make(true);
    }

    public function purchasedata(Request $request)
    {
        if ($request->start_date && $request->end_date && $request->farm_id) {
            $purchases = Purchase::with('car', 'worker', 'farm')
                ->whereBetween('tgl_beli', [$request->start_date, $request->end_date])
                ->where('farm_id', $request->farm_id);
        // } else if ($request->start_date && $request->end_date && $request->farmer_id) {
        //     $purchases = Purchase::with('car', 'worker', 'farm')
        //         ->whereBetween('tgl_beli', [$request->start_date, $request->end_date])
        //         ->where('farm.farmer_id', $request->farmer_id);
        // } else if ( $request->farmer_id) {
        //     $purchases = Purchase::with('car', 'worker', 'farm')
        //         ->where('farm.farmer_id', $request->farmer_id);
        } else if ($request->start_date && $request->end_date && $request->worker_id) {
            $purchases = Purchase::with('car', 'worker', 'farm')
                ->whereBetween('tgl_beli', [$request->start_date, $request->end_date])
                ->where('worker_id', $request->worker_id);
        } else if ($request->start_date && $request->end_date) {
            $purchases = Purchase::with('car', 'worker', 'farm')
                ->whereBetween('tgl_beli', [$request->start_date, $request->end_date]);
        } else if ($request->farm_id) {
            $purchases = Purchase::with('car', 'worker', 'farm')
                ->where('farm_id', $request->farm_id);
        } else if ($request->worker_id) {
            $purchases = Purchase::with('car', 'worker', 'farm')
                ->where('worker_id', $request->worker_id);

        } else {
            $purchases = Purchase::with('car', 'worker', 'farm');
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
            ->addColumn('nama_pemilik', function (Purchase $purchase) {
                return $purchase->farm->farmer->nama;
            })
            // ->addColumn('farmer', function (Purchase $purchase) {
            //     return $purchase->farmer->nama;
            // })
            // ->addColumn('umur', function (Purchase $purchase) {
            //     return $purchase->farmer->umur;
            // })
            ->editColumn('harga', 'Rp.{{number_format($harga,2,",",".")}}')
            ->editColumn('harga_total', 'Rp.{{number_format($harga_total,2,",",".")}}')
            ->addIndexColumn()
            ->toJson();
    }

    public function gambutdata(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            $purchases = DB::table('purchases')
                ->join('farms', 'farm_id', '=', 'farms.id')
                ->select('farms.umur', DB::Raw("SUM(ton)as total_ton"), DB::Raw("COUNT(farms.umur)as jumlah_data"))
                // ->addSelect([
                //     'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
                //     ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
                //     ->groupBy('purchases.tgl_beli')
                //     ->limit(1),
                // ])
                ->where('farms.jenis_tanah', 'Gambut')
                ->whereBetween('tgl_beli', [$request->start_date, $request->end_date])
                ->groupBy('farms.umur')
                // ->avg('ton')
                ->get();
        } else {
            $purchases = DB::table('purchases')
                ->join('farms', 'farm_id', '=', 'farms.id')
                ->select( 'farms.umur', DB::Raw("SUM(ton)as total_ton"), DB::Raw("COUNT(farms.umur)as jumlah_data") )
                // ->addSelect([
                //     'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
                //     ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
                //     ->groupBy('purchases.tgl_beli')
                //     ->limit(1),
                // ])
                ->where('farms.jenis_tanah', 'Gambut')
                ->groupBy('farms.umur')
                // ->avg('ton')
                ->get();
        }


        $data = $purchases->map(function($purchase) {
            return [
                'umur' => $purchase->umur,
                'jumlah_ton' => $purchase->total_ton,
                'total_data' => $purchase->jumlah_data,
                'ton_hektar' => $purchase->total_ton / $purchase->jumlah_data,
            ];
        });

        $sorted = $data->sortBy('umur');
        // dd($data);

        return Datatables::of($sorted)
            ->editColumn('ton_hektar', '{{number_format($ton_hektar,2)}}')
            ->addIndexColumn()
            ->toJson();
    }

    public function tanahdata(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            $purchases = DB::table('purchases')
            ->join('farms', 'farm_id', '=', 'farms.id')
            ->select('farms.umur', DB::Raw("SUM(ton)as total_ton"), DB::Raw("COUNT(farms.umur)as jumlah_data"))
            // ->addSelect([
            //     'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
            //     ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
            //     ->groupBy('purchases.tgl_beli')
            //     ->limit(1),
            // ])
            ->where('farms.jenis_tanah', 'Tanah Keras')
            ->whereBetween('tgl_beli', [$request->start_date, $request->end_date])
            ->groupBy('farms.umur')
                // ->avg('ton')
                ->get();
        } else {
        $purchases = DB::table('purchases')
        ->join('farms', 'farm_id', '=', 'farms.id')
        ->select('farms.umur', DB::Raw("SUM(ton)as total_ton"), DB::Raw("COUNT(farms.umur)as jumlah_data"))
        // ->addSelect([
        //     'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
        //     ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
        //     ->groupBy('purchases.tgl_beli')
        //     ->limit(1),
        // ])
        ->where('farms.jenis_tanah', 'Tanah Keras')
        ->groupBy('farms.umur')
        // ->avg('ton')
        ->get();
        }


        $data = $purchases->map(function ($purchase) {
            return [
                'umur' => $purchase->umur,
                'jumlah_ton' => $purchase->total_ton,
                'total_data' => $purchase->jumlah_data,
                'ton_hektar' => $purchase->total_ton / $purchase->jumlah_data,
            ];
        });

        $sorted = $data->sortBy('umur');
        // dd($data);

        return Datatables::of($sorted)
            ->editColumn('ton_hektar', '{{number_format($ton_hektar,2,)}}')
            ->addIndexColumn()
            ->toJson();
    }

    public function saledata(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            $sales = Sale::with('car', 'worker')
                ->whereBetween('tgl_jual', [$request->start_date, $request->end_date]);
        } else {
            $sales = Sale::with('car', 'worker');
        }

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
            ->addIndexColumn()
            ->editColumn('harga_pabrik', 'Rp.{{number_format($harga_pabrik,2,",",".")}}')
            ->editColumn('harga_total', 'Rp.{{number_format($harga_total,2,",",".")}}')
            ->toJson();
    }

    public function fuelday(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            $fuels = Fuel::with('car')
                ->select("id", DB::raw("harga as harga"), DB::raw("(sum(jumlah_liter))as total_liter"), DB::raw("(sum(harga_total))as total_harga"), DB::raw("(DATE_FORMAT(tgl_pengisian, '%d-%m-%Y')) as my_date"), DB::raw("car_id as car_id"))
                ->whereBetween('tgl_pengisian', [$request->start_date, $request->end_date])
                ->orderBy('tgl_pengisian', 'desc')
                ->groupBy('tgl_pengisian')
                ->groupBy('car_id');
        } else {
            $fuels = Fuel::with('car')
                ->select("id", DB::raw("harga as harga"), DB::raw("(sum(jumlah_liter))as total_liter"), DB::raw("(sum(harga_total))as total_harga"), DB::raw("(DATE_FORMAT(tgl_pengisian, '%d-%m-%Y')) as my_date"), DB::raw("car_id as car_id"))
                ->orderBy('tgl_pengisian', 'desc')
                ->groupBy('tgl_pengisian')
                ->groupBy('car_id');
        }

        return Datatables::of($fuels)
            ->addColumn('car', function (Fuel $fuel) {
                return $fuel->car->nama_kendaraan;
            })
            ->editColumn('harga', 'Rp.{{number_format($harga,2,",",".")}}')
            ->editColumn('total_harga', 'Rp.{{number_format($total_harga,2,",",".")}}')
            ->addIndexColumn()
            ->toJson();
    }

    public function fueldata()
    {
        $fuels = Fuel::with('car');

        return Datatables::of($fuels)
            ->addColumn('action', function ($fuel) {
                return '<div class="text-center"><a href="/dashboard/fuel/' . $fuel->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            ->addColumn('car', function (Fuel $fuel) {
                return $fuel->car->nama_kendaraan;
            })
            ->editColumn('harga', 'Rp.{{number_format($harga,2,",",".")}}')
            ->editColumn('harga_total', 'Rp.{{number_format($harga_total,2,",",".")}}')
            ->addIndexColumn()
            ->toJson();
    }

    public function repairdata()
    {
        $repairs = Repair::with('car');

        return Datatables::of($repairs)
            ->addColumn('action', function ($repair) {
                return '<div class="text-center"><a href="/dashboard/repair/' . $repair->id . '/edit/"><i class="fas fa-edit text-success"></i></a> <form class="d-inline" ><button type="button" class="fas fa-trash text-danger border-0 tombol-delete"></button></form></div>';
            })
            ->addColumn('car', function (Repair $repair) {
                return $repair->car->nama_kendaraan;
            })
            ->addColumn('jenis_kerusakan', function (Repair $repair) {
                return $repair->type->jenis_pemeliharaan;
            })
            ->editColumn('jumlah', 'Rp.{{number_format($jumlah,2,",",".")}}')
            ->addIndexColumn()
            ->toJson();
    }

    public function spend(Request $request){

        //date pembelian
        $date_beli = DB::table('purchases')
            ->selectRaw("tgl_beli as tgl_bulan")
            ->groupByRaw('tgl_beli')
            ->orderByRaw('tgl_beli ASC')
            ->pluck('tgl_bulan');

        //date pembelian
        $date_perbaikan = DB::table('repairs')
            ->selectRaw("tgl_perbaikan as tgl_bulan")
            ->groupByRaw('tgl_perbaikan')
            ->orderByRaw('tgl_perbaikan ASC')
            ->pluck('tgl_bulan');

        if ($request->start_date && $request->end_date) {
            //date bahan bakar
            $total_bensin = DB::table('fuels')
                ->select('tgl_pengisian as tgl', DB::Raw("CAST(SUM(harga_total)as int) as bahan_bakar"))
                ->addSelect([
                    'pembelian_sawit' => Purchase::selectRaw('cast(sum(jumlah_sawit)as int)')
                        ->whereColumn(
                            'tgl_beli',
                            'fuels.tgl_pengisian'
                        )
                        ->groupBy('fuels.tgl_pengisian')
                        ->limit(1),
                    'harga_pembelian' => Purchase::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_beli', 'fuels.tgl_pengisian')
                        ->groupBy('fuels.tgl_pengisian')
                        ->limit(1),
                    'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
                        ->whereColumn('tgl_perbaikan', 'fuels.tgl_pengisian')
                        ->groupBy('fuels.tgl_pengisian')
                        ->limit(1),
                ])
                ->whereBetween('tgl_pengisian', [$request->start_date, $request->end_date])
                ->whereNotIn('tgl_pengisian', $date_beli)
                ->whereNotIn('tgl_pengisian', $date_perbaikan)
                ->groupByRaw('tgl_pengisian')
                ->orderByRaw('tgl_pengisian ASC')
                ->get();

            //date perbaikan
            $total_perbaikan = DB::table('repairs')
                ->select('tgl_perbaikan as tgl', DB::Raw("CAST(SUM(jumlah)as int) as perbaikan"))
                ->addSelect([
                    'pembelian_sawit' => Purchase::selectRaw('cast(sum(jumlah_sawit)as int)')
                        ->whereColumn('tgl_beli', 'repairs.tgl_perbaikan')
                        ->groupBy('repairs.tgl_perbaikan')
                        ->limit(1),
                    'harga_pembelian' => Purchase::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_beli', 'repairs.tgl_perbaikan')
                        ->groupBy('repairs.tgl_perbaikan')
                        ->limit(1),
                    'bahan_bakar' => Fuel::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_pengisian', 'repairs.tgl_perbaikan')
                        ->groupBy('repairs.tgl_perbaikan')
                        ->limit(1),
                ])
                ->whereNotIn('tgl_perbaikan', $date_beli)
                ->whereBetween('tgl_perbaikan', [$request->start_date, $request->end_date])
                ->groupByRaw('tgl_perbaikan')
                ->orderByRaw('tgl_perbaikan ASC')
                ->get();

            //pembelian hari ini
            $total_hbeli = DB::table('purchases')
                ->select('tgl_beli as tgl', DB::Raw("CAST(SUM(jumlah_sawit)as int) as pembelian_sawit"), DB::Raw('cast(sum(purchases.harga_total)as int) as harga_pembelian'))
                ->addSelect([
                    'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
                        ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
                        ->groupBy('purchases.tgl_beli')
                        ->limit(1),
                    'bahan_bakar' => Fuel::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                        ->groupBy('purchases.tgl_beli')
                        ->limit(1),
                ])
                ->whereBetween('tgl_beli', [$request->start_date, $request->end_date])
                ->groupBy('tgl_beli')
                ->get();

        } else {
            //date bahan bakar
            $total_bensin = DB::table('fuels')
                ->select('tgl_pengisian as tgl', DB::Raw("CAST(SUM(harga_total)as int) as bahan_bakar"))
                ->addSelect([
                    'pembelian_sawit' => Purchase::selectRaw('cast(sum(jumlah_sawit)as int)')
                        ->whereColumn(
                            'tgl_beli',
                            'fuels.tgl_pengisian'
                        )
                        ->groupBy('fuels.tgl_pengisian')
                        ->limit(1),
                    'harga_pembelian' => Purchase::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_beli', 'fuels.tgl_pengisian')
                        ->groupBy('fuels.tgl_pengisian')
                        ->limit(1),
                    'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
                        ->whereColumn('tgl_perbaikan', 'fuels.tgl_pengisian')
                        ->groupBy('fuels.tgl_pengisian')
                        ->limit(1),
                ])
                ->whereNotIn('tgl_pengisian', $date_beli)
                ->whereNotIn('tgl_pengisian', $date_perbaikan)
                ->groupByRaw('tgl_pengisian')
                ->orderByRaw('tgl_pengisian ASC')
                ->get();

            //date perbaikan
            $total_perbaikan = DB::table('repairs')
                ->select('tgl_perbaikan as tgl', DB::Raw("CAST(SUM(jumlah)as int) as perbaikan"))
                ->addSelect([
                    'pembelian_sawit' => Purchase::selectRaw('cast(sum(jumlah_sawit)as int)')
                        ->whereColumn('tgl_beli', 'repairs.tgl_perbaikan')
                        ->groupBy('repairs.tgl_perbaikan')
                        ->limit(1),
                    'harga_pembelian' => Purchase::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_beli', 'repairs.tgl_perbaikan')
                        ->groupBy('repairs.tgl_perbaikan')
                        ->limit(1),
                    'bahan_bakar' => Fuel::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_pengisian', 'repairs.tgl_perbaikan')
                        ->groupBy('repairs.tgl_perbaikan')
                        ->limit(1),
                ])
                ->whereNotIn('tgl_perbaikan', $date_beli)
                ->groupByRaw('tgl_perbaikan')
                ->orderByRaw('tgl_perbaikan ASC')
                ->get();

            //pembelian hari ini
            $total_hbeli = DB::table('purchases')
                ->select('tgl_beli as tgl', DB::Raw("CAST(SUM(jumlah_sawit)as int) as pembelian_sawit"), DB::Raw('cast(sum(purchases.harga_total)as int) as harga_pembelian'))
                ->addSelect([
                    'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
                        ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
                        ->groupBy('purchases.tgl_beli')
                        ->limit(1),
                    'bahan_bakar' => Fuel::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                        ->groupBy('purchases.tgl_beli')
                        ->limit(1),
                ])
                ->groupBy('tgl_beli')
                ->get();

        }

        $data = $total_perbaikan->concat($total_hbeli)->concat($total_bensin);

        return Datatables::of($data)
        ->addIndexColumn()
            ->addColumn('total_pengeluaran',
                function ($data) {
                    return 'Rp'.number_format(($data->harga_pembelian + $data->perbaikan + $data->bahan_bakar),2,",",".");
                }
            )
            ->editColumn('bahan_bakar', 'Rp.{{number_format($bahan_bakar,2,",",".")}}')
            ->editColumn('perbaikan', 'Rp.{{number_format($perbaikan,2,",",".")}}')
            ->editColumn('harga_pembelian', 'Rp.{{number_format($harga_pembelian,2,",",".")}}')

            ->make(true);
    }

    public function profit(Request $request){
        //date pembelian
        $date_beli = DB::table('purchases')
            ->selectRaw("tgl_beli as tgl_bulan")
            ->groupByRaw('tgl_beli')
            ->orderByRaw('tgl_beli ASC')
            ->pluck('tgl_bulan');

        $date_bensin = DB:: table('fuels')
            ->selectRaw("tgl_pengisian as tgl_bulan")
            ->groupByRaw('tgl_pengisian')
            ->orderByRaw('tgl_pengisian asc')
            ->pluck('tgl_bulan');

        //date pembelian
        $date_perbaikan = DB::table('repairs')
            ->selectRaw("tgl_perbaikan as tgl_bulan")
            ->groupByRaw('tgl_perbaikan')
            ->orderByRaw('tgl_perbaikan ASC')
            ->pluck('tgl_bulan');

        if ($request->start_date && $request->end_date) {

            //date omset
            $total_omset = DB::table('sales')
                ->select('tgl_jual as tgl', DB::Raw("CAST(SUM(harga_total)as int) as omset"))
                ->addSelect([
                    'pembelian_sawit' => Purchase::selectRaw('cast(sum(jumlah_sawit)as int)')
                        ->whereColumn(
                            'tgl_beli',
                            'sales.tgl_jual'
                        )
                        ->groupBy('sales.tgl_jual')
                        ->limit(1),
                    'harga_pembelian' => Purchase::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_beli', 'sales.tgl_jual')
                        ->groupBy('sales.tgl_jual')
                        ->limit(1),
                    'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
                        ->whereColumn('tgl_perbaikan', 'sales.tgl_jual')
                        ->groupBy('sales.tgl_jual')
                        ->limit(1),
                    'bahan_bakar' => Fuel::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_pengisian', 'sales.tgl_jual')
                        ->groupBy('sales.tgl_jual')
                        ->limit(1),
                ])
                ->whereBetween('tgl_jual', [$request->start_date, $request->end_date])
                ->whereNotIn('tgl_jual', $date_beli)
                ->whereNotIn('tgl_jual', $date_perbaikan)
                ->whereNotIn('tgl_jual', $date_bensin)
                ->groupByRaw('tgl_jual')
                ->orderByRaw('tgl_jual ASC')
                ->get();

            //date bahan bakar
            $total_bensin = DB::table('fuels')
                ->select('tgl_pengisian as tgl', DB::Raw("CAST(SUM(harga_total)as int) as bahan_bakar"))
                ->addSelect([
                    'pembelian_sawit' => Purchase::selectRaw('cast(sum(jumlah_sawit)as int)')
                        ->whereColumn(
                            'tgl_beli',
                            'fuels.tgl_pengisian'
                        )
                        ->groupBy('fuels.tgl_pengisian')
                        ->limit(1),
                    'harga_pembelian' => Purchase::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_beli', 'fuels.tgl_pengisian')
                        ->groupBy('fuels.tgl_pengisian')
                        ->limit(1),
                    'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
                        ->whereColumn('tgl_perbaikan', 'fuels.tgl_pengisian')
                        ->groupBy('fuels.tgl_pengisian')
                        ->limit(1),
                    'omset' => Sale::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_jual', 'fuels.tgl_pengisian')
                        ->groupBy('fuels.tgl_pengisian')
                        ->limit(1),
                ])
                ->whereBetween('tgl_pengisian', [$request->start_date, $request->end_date])
                ->whereNotIn('tgl_pengisian', $date_beli)
                ->whereNotIn('tgl_pengisian', $date_perbaikan)
                ->groupByRaw('tgl_pengisian')
                ->orderByRaw('tgl_pengisian ASC')
                ->get();

            //date perbaikan
            $total_perbaikan = DB::table('repairs')
                ->select('tgl_perbaikan as tgl', DB::Raw("CAST(SUM(jumlah)as int) as perbaikan"))
                ->addSelect([
                    'pembelian_sawit' => Purchase::selectRaw('cast(sum(jumlah_sawit)as int)')
                        ->whereColumn('tgl_beli', 'repairs.tgl_perbaikan')
                        ->groupBy('repairs.tgl_perbaikan')
                        ->limit(1),
                    'harga_pembelian' => Purchase::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_beli', 'repairs.tgl_perbaikan')
                        ->groupBy('repairs.tgl_perbaikan')
                        ->limit(1),
                    'bahan_bakar' => Fuel::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_pengisian', 'repairs.tgl_perbaikan')
                        ->groupBy('repairs.tgl_perbaikan')
                        ->limit(1),
                    'omset' => Sale::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_jual', 'repairs.tgl_perbaikan')
                        ->groupBy('repairs.tgl_perbaikan')
                        ->limit(1),
                ])
                ->whereNotIn('tgl_perbaikan', $date_beli)
                ->whereBetween('tgl_perbaikan', [$request->start_date, $request->end_date])
                ->groupByRaw('tgl_perbaikan')
                ->orderByRaw('tgl_perbaikan ASC')
                ->get();

            //pembelian hari ini
            $total_hbeli = DB::table('purchases')
                ->select('tgl_beli as tgl', DB::Raw("CAST(SUM(jumlah_sawit)as int) as pembelian_sawit"), DB::Raw('cast(sum(purchases.harga_total)as int) as harga_pembelian'))
                ->addSelect([
                    'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
                        ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
                        ->groupBy('purchases.tgl_beli')
                        ->limit(1),
                    'bahan_bakar' => Fuel::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                        ->groupBy('purchases.tgl_beli')
                        ->limit(1),
                    'omset' => Sale::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_jual', 'purchases.tgl_beli')
                        ->groupBy('purchases.tgl_beli')
                        ->limit(1),
                ])
                ->whereBetween('tgl_beli', [$request->start_date, $request->end_date])
                ->groupBy('tgl_beli')
                ->get();
        } else {
            //date omset
            $total_omset = DB::table('sales')
                ->select('tgl_jual as tgl', DB::Raw("CAST(SUM(harga_total)as int) as omset"))
                ->addSelect([
                    'pembelian_sawit' => Purchase::selectRaw('cast(sum(jumlah_sawit)as int)')
                        ->whereColumn(
                            'tgl_beli',
                            'sales.tgl_jual'
                        )
                        ->groupBy('sales.tgl_jual')
                        ->limit(1),
                    'harga_pembelian' => Purchase::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_beli', 'sales.tgl_jual')
                        ->groupBy('sales.tgl_jual')
                        ->limit(1),
                    'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
                        ->whereColumn('tgl_perbaikan', 'sales.tgl_jual')
                        ->groupBy('sales.tgl_jual')
                        ->limit(1),
                    'bahan_bakar' => Fuel::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_pengisian', 'sales.tgl_jual')
                        ->groupBy('sales.tgl_jual')
                        ->limit(1),
                ])
                ->whereNotIn('tgl_jual', $date_beli)
                ->whereNotIn('tgl_jual', $date_perbaikan)
                ->whereNotIn('tgl_jual', $date_bensin)
                ->groupByRaw('tgl_jual')
                ->orderByRaw('tgl_jual ASC')
                ->get();

            //date bahan bakar
            $total_bensin = DB::table('fuels')
                ->select('tgl_pengisian as tgl', DB::Raw("CAST(SUM(harga_total)as int) as bahan_bakar"))
                ->addSelect([
                    'pembelian_sawit' => Purchase::selectRaw('cast(sum(jumlah_sawit)as int)')
                        ->whereColumn(
                            'tgl_beli',
                            'fuels.tgl_pengisian'
                        )
                        ->groupBy('fuels.tgl_pengisian')
                        ->limit(1),
                    'harga_pembelian' => Purchase::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_beli', 'fuels.tgl_pengisian')
                        ->groupBy('fuels.tgl_pengisian')
                        ->limit(1),
                    'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
                        ->whereColumn('tgl_perbaikan', 'fuels.tgl_pengisian')
                        ->groupBy('fuels.tgl_pengisian')
                        ->limit(1),
                    'omset' => Sale::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_jual', 'fuels.tgl_pengisian')
                        ->groupBy('fuels.tgl_pengisian')
                        ->limit(1),
                ])
                ->whereNotIn('tgl_pengisian', $date_beli)
                ->whereNotIn('tgl_pengisian', $date_perbaikan)
                ->groupByRaw('tgl_pengisian')
                ->orderByRaw('tgl_pengisian ASC')
                ->get();

            //date perbaikan
            $total_perbaikan = DB::table('repairs')
                ->select('tgl_perbaikan as tgl', DB::Raw("CAST(SUM(jumlah)as int) as perbaikan"))
                ->addSelect([
                    'pembelian_sawit' => Purchase::selectRaw('cast(sum(jumlah_sawit)as int)')
                        ->whereColumn('tgl_beli', 'repairs.tgl_perbaikan')
                        ->groupBy('repairs.tgl_perbaikan')
                        ->limit(1),
                    'harga_pembelian' => Purchase::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_beli', 'repairs.tgl_perbaikan')
                        ->groupBy('repairs.tgl_perbaikan')
                        ->limit(1),
                    'bahan_bakar' => Fuel::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_pengisian', 'repairs.tgl_perbaikan')
                        ->groupBy('repairs.tgl_perbaikan')
                        ->limit(1),
                    'omset' => Sale::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_jual', 'repairs.tgl_perbaikan')
                        ->groupBy('repairs.tgl_perbaikan')
                        ->limit(1),
                ])
                ->whereNotIn('tgl_perbaikan', $date_beli)
                ->groupByRaw('tgl_perbaikan')
                ->orderByRaw('tgl_perbaikan ASC')
                ->get();

            //pembelian hari ini
            $total_hbeli = DB::table('purchases')
                ->select('tgl_beli as tgl', DB::Raw("CAST(SUM(jumlah_sawit)as int) as pembelian_sawit"), DB::Raw('cast(sum(purchases.harga_total)as int) as harga_pembelian'))
                ->addSelect([
                    'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
                        ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
                        ->groupBy('purchases.tgl_beli')
                        ->limit(1),
                    'bahan_bakar' => Fuel::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
                        ->groupBy('purchases.tgl_beli')
                        ->limit(1),
                    'omset' => Sale::selectRaw('cast(sum(harga_total)as int)')
                        ->whereColumn('tgl_jual', 'purchases.tgl_beli')
                        ->groupBy('purchases.tgl_beli')
                        ->limit(1),
                ])
                ->groupBy('tgl_beli')
                ->get();
        }

        $data = $total_perbaikan->concat($total_hbeli)->concat($total_bensin)->concat($total_omset);

        return Datatables::of($data)
        ->addIndexColumn()
            ->addColumn(
                'total_pengeluaran',
                function ($data) {
                    return 'Rp' . number_format(($data->harga_pembelian + $data->perbaikan + $data->bahan_bakar), 2, ",", ".");
                }
            )
            ->addColumn(
                'profit',
                function ($data) {
                    $pengeluaran = $data->harga_pembelian + $data->perbaikan + $data->bahan_bakar;
                    return 'Rp' . number_format(($data->omset - $pengeluaran), 2, ",", ".");
                }
            )
            ->editColumn('omset', 'Rp.{{number_format($omset,2,",",".")}}')
            ->make(true);

    }
}
