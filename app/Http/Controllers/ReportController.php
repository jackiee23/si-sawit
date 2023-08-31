<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Farm;
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
        $farm = Farm::all();
        $worker = Worker::all();
        $car = Car::all();

        return view('dashboard.report.index',[
            'title' => 'Laporan Umum',
            'farmer' => $farmer,
            'farm' => $farm,
            'worker' => $worker,
            'car' =>$car
        ]);
    }

    public function particular()
    {
        $farm = Farm::all();
        $worker = Worker::all();
        $car = Car::all();

        //report kendaraan
        $cars = DB::table('cars')
        ->join('purchases', 'cars.id', '=', 'purchases.car_id')
        ->join('farms', 'farm_id', '=', 'farms.id')
        // ->join('fuels', 'tgl_pengisian', '=', 'purchases.tgl_beli')
        ->select(  DB::raw('sum(farms.jarak*purchases.trip*2)as jarak_total'), 'purchases.tgl_beli')
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
        ->join('farms', 'farm_id', '=', 'farms.id')
        ->select('farms.umur', DB::Raw("SUM(ton)as total_ton"), DB::Raw("COUNT(farms.umur)as jumlah_data"))
        // ->addSelect([
        //     'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
        //     ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
        //     ->groupBy('purchases.tgl_beli')
        //     ->limit(1),
        // ])
        ->groupBy('farms.umur')
        ->where('farms.jenis_tanah', 'Gambut')
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

        $purchases2 = DB::table('purchases')
        ->join('farms', 'farm_id', '=', 'farms.id')
        ->select('farms.umur', DB::Raw("SUM(ton)as total_ton"), DB::Raw("COUNT(farms.umur)as jumlah_data"))
        // ->addSelect([
        //     'perbaikan' => Repair::selectRaw('cast(sum(jumlah)as int)')
        //     ->whereColumn('tgl_perbaikan', 'purchases.tgl_beli')
        //     ->groupBy('purchases.tgl_beli')
        //     ->limit(1),
        // ])
        ->groupBy('farms.umur')
        ->where('farms.jenis_tanah', 'Tanah Keras')
            // ->avg('ton')
            ->get();

        $data2 = $purchases2->map(function ($purchase) {
            return [
                'umur' => $purchase->umur,
                'jumlah_ton' => $purchase->total_ton,
                'total_data' => $purchase->jumlah_data,
                'ton_hektar' => $purchase->total_ton / $purchase->jumlah_data,
            ];
        });

        $sort3 = $data2->sortBy('umur');
        $ton_hektar2 = Arr::pluck($sort3, 'ton_hektar');

        //nama bulan
        $umur = DB::table('purchases')
        ->join('farms', 'farm_id', '=', 'farms.id')
        ->selectRaw("farms.umur as umur")
        ->where('farms.jenis_tanah', 'Gambut')
        ->groupByRaw('farms.umur')
        ->orderByRaw('farms.umur ASC')
        ->get();
        $sort2 = $umur->sortBy('umur');
        $umur2 = $sort2->pluck('umur');
        // dd($sort2);

        $umurT = DB::table('purchases')
        ->join('farms', 'farm_id', '=', 'farms.id')
        ->selectRaw("farms.umur as umur")
        ->where('farms.jenis_tanah', 'Tanah Keras')
        ->groupByRaw('farms.umur')
        ->orderByRaw('farms.umur ASC')
        ->get();
        $sortT = $umurT->sortBy('umur');
        $umur4 = $sortT->pluck('umur');

        return view('dashboard.particular.index', [
            'title' => 'Laporan Khusus',
            'ton_hektar' => $ton_hektar,
            'ton' => $ton_hektar2,
            'umur' => $umur2,
            'umur2' => $umur4,
            'nama_b' => $nama_hari,
            'farm' => $farm,
            'worker' => $worker,
            'car' => $car,
            'meter' => $meter
        ]);
    }
}
