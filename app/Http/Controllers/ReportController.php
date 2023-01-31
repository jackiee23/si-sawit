<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Farmer;
use App\Models\Fuel;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(){
        $farmer = Farmer::all();
        $worker = Worker::all();
        $car = Car::all();

        return view('dashboard.report.index',[
            'title' => 'Laporan Umum',
            'farmer' => $farmer,
            'worker' => $worker,
            'car' =>$car
        ]);
    }

    public function particular()
    {
        $farmer = Farmer::all();
        $worker = Worker::all();
        $car = Car::all();

        //report kendaraan
        $cars = DB::table('cars')
        ->join('purchases', 'cars.id', '=', 'purchases.car_id')
        ->join('farmers', 'farmer_id', '=', 'farmers.id')
        // ->join('fuels', 'tgl_pengisian', '=', 'purchases.tgl_beli')
        ->select(  DB::raw('sum(farmers.jarak*purchases.trip*2)as jarak_total'), 'purchases.tgl_beli')
        ->addSelect([
            'jumlah_liter' => Fuel::selectRaw('sum(jumlah_liter)')
            ->whereColumn('tgl_pengisian', 'purchases.tgl_beli')
            ->groupBy('purchases.tgl_beli')
            ->limit(1),
        ])
        ->groupBy('purchases.tgl_beli')
        ->orderBy('purchases.tgl_beli', 'desc')
        ->get();

        //nama bulan
        $nama_hari = DB::table('purchases')
            ->selectRaw("tgl_beli as nama_bulan")
            ->whereYear('tgl_beli', now())
            ->groupByRaw('tgl_beli')
            ->orderByRaw('tgl_beli ASC')
            ->pluck('nama_bulan');


        $modified = $cars->map(function ($car) {
            if ($car->jumlah_liter != 0){
                return [
                    // 'liter_kw' => $car->liter,
                    'liter' => $car->jumlah_liter,
                    'jarak' => $car->jarak_total,
                    // 'meter_kw' => $car->meter,
                    'meter' => $car->jarak_total / $car->jumlah_liter,
                    'creation_date' => $car->tgl_beli
                ];
            } else {
                return [
                    // 'liter_kw' => $car->liter,
                    'liter' => $car->jumlah_liter,
                    'jarak' => $car->jarak_total,
                    // 'meter_kw' => $car->meter,
                    'meter' => 0,
                    'creation_date' => $car->tgl_beli
                ];
            }

        });

        // $modif = $modified->toArray();
        $meter = Arr::pluck($modified, 'meter');
        $tgl = Arr::pluck($modified, 'creation_date');


        // dd($modified);
        // dd($jalan);

        $purchases = DB::table('purchases')
        ->join('farmers', 'farmer_id', '=', 'farmers.id')
        ->select('farmers.umur', DB::Raw("SUM(ton)as total_ton"), DB::Raw("COUNT(farmers.umur)as jumlah_data"))
        // ->addSelect([
        //     'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
        //     ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
        //     ->groupBy('purchases.tgl_beli')
        //     ->limit(1),
        // ])
        ->groupBy('farmers.umur')
        // ->avg('ton')
        ->get();

        $data = $purchases->map(function ($purchase) {
            return [
                'umur' => $purchase->umur,
                'jumlah_ton' => $purchase->total_ton,
                'total_data' => $purchase->jumlah_data,
                'ton_hektar' => $purchase->total_ton / $purchase->jumlah_data,
            ];
        });

        $sort = $data->sortBy('umur');
        $ton_hektar = Arr::pluck($sort, 'ton_hektar');

        //nama bulan
        $umur = DB::table('purchases')
        ->join('farmers', 'farmer_id', '=', 'farmers.id')
        ->selectRaw("farmers.umur as umur")
        ->groupByRaw('farmers.umur')
        ->orderByRaw('farmers.umur ASC')
        ->get();
        $sort2 = $umur->sortBy('umur');
        $umur2 = $sort2->pluck('umur');
        // dd($sort2);

        return view('dashboard.particular.index', [
            'title' => 'Laporan Khusus',
            'ton_hektar' => $ton_hektar,
            'umur' => $umur2,
            'nama_bulan' => $nama_hari,
            'farmer' => $farmer,
            'worker' => $worker,
            'car' => $car,
            'meter' => $meter
        ]);
    }
}
