<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Fuel;
use App\Models\Purchase;
use App\Models\Repair;
use App\Models\Sale;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $car = Car::all();

        return view('dashboard.car.index',[
            'car' => $car,
            'title' => 'Kendaraan'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.car.create', [
            'title' => 'Kendaraan'
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
            'nama_kendaraan' => 'required',
            'merek' => 'required',
            'tgl_beli' => 'required',
            'keadaan_beli' => 'required'
        ]);

        Car::create($request->all());
        return redirect('/dashboard/car')->with('status', 'New car has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        return view('dashboard.car.edit', [
            'car' => $car,
            'title' => 'Kendaraan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'nama_kendaraan' => 'required',
            'merek' => 'required',
            'tgl_beli' => 'required',
            'keadaan_beli' => 'required'
        ]);

        Car::where('id', $car->id)
        ->update([
            'nama_kendaraan' => $request->nama_kendaraan,
            'merek' => $request->merek,
            'tgl_beli' => $request->tgl_beli,
            'keadaan_beli' => $request->keadaan_beli,
            'umur_kendaraan' => $request->umur_kendaraan
        ]);

        return redirect('/dashboard/car')->with('status', 'Car data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $cek = Fuel::where('car_id', $car->id);
        $cek2 = Purchase::where('car_id', $car->id);
        $cek3 = Repair::where('car_id', $car->id);
        $cek4 = Sale::where('car_id', $car->id);

        if($cek || $cek2 || $cek3 || $cek4){
            return redirect('/dashboard/car')->with('failed', 'Car data cannot be delete!');
        } else{
            Car::destroy($car->id);
            return redirect('/dashboard/car')->with('status', 'Car data has been deleted!');
        }
    }
}
