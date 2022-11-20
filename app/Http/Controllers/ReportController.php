<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        $farmer = Farmer::all();

        return view('dashboard.report.index',[
            'title' => 'Laporan Umum',
            'farmer' => $farmer
        ]);
    }
}
