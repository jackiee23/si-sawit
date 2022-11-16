<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Repair;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repair = Repair::all();
        
        return view('dashboard.repair.index', [
            'title' => 'Perbaikan',
            'repair' => $repair
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $car = Car::all();

        return view('dashboard.repair.create', [
            'title' => 'Perbaikan',
            'car' => $car
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_perbaikan' => 'required',
            'car_id' => 'required',
            'jenis_kerusakan' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required'
        ]);

        Repair::create($request->all());
        return redirect('/dashboard/repair')->with('status', 'New data has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function show(Repair $repair)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function edit(Repair $repair)
    {
        $car = Car::all();
        return view('dashboard.repair.edit', [
            'title' => 'Perbaikan',
            'car' => $car,
            'repair' => $repair
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repair $repair)
    {
        $request->validate([
            'tgl_perbaikan' => 'required',
            'car_id' => 'required',
            'jenis_kerusakan' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required'
        ]);

        Repair::where('id', $repair->id)
                ->update([
                    'tgl_perbaikan' =>$request->tgl_perbaikan,
                    'car_id' => $request->car_id,
                    'jenis_kerusakan' => $request->jenis_kerusakan,
                    'jumlah' => $request->jumlah,
                    'keterangan' => $request->keterangan
                ]);

                return redirect('/dashboard/repair')->with('status', 'Data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repair $repair)
    {
        Repair::destroy($repair->id);
        return redirect('/dashboard/repair')->with('status', 'Data has been deleted.');
    }
}
