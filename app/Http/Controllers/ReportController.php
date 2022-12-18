<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Farmer;
use App\Models\Worker;
use Illuminate\Http\Request;
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
}
