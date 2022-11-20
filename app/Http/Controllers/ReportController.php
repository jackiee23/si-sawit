<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\Worker;
use Illuminate\Http\Request;

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
}
