<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        return view('dashboard.report.index',[
            'title' => 'Laporan Umum'
        ]);
    }
}
