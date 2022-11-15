<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Fuel;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fuel = Fuel::all();

        return view('fuel.index', [
            'title' => 'Bahan Bakar',
            'fuel' => $fuel
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
        return view('fuel.create', [
            'title' => 'Bahan Bakar',
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
            'tgl_pengisian' => 'required',
            'car_id' => 'required',
            'jumlah_liter' => 'required',
            'harga' => 'required',
            'keterangan' => 'required'
        ]);

        Fuel::create([
            'tgl_pengisian' => $request->tgl_pengisian,
            'car_id' => $request->car_id,
            'jumlah_liter' => $request->jumlah_liter,
            'harga' => $request->harga,
            'harga_total' => $request->harga * $request->jumlah_liter,
            'keterangan' => $request->keterangan
        ]);
        return redirect('/dashboard/fuel')->with('status', 'New data has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function show(Fuel $fuel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function edit(Fuel $fuel)
    {
        $car = Car::all();
        return view('fuel.edit', [
            'title' => 'Bahan Bakar',
            'fuel' => $fuel,
            'car' => $car
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fuel $fuel)
    {
        $request->validate([
            'tgl_pengisian' => 'required',
            'car_id' => 'required',
            'jumlah_liter' => 'required',
            'harga' => 'required',
            'keterangan' => 'required'
        ]);

        Fuel::where('id', $fuel->id)
                ->update([
            'tgl_pengisian' => $request->tgl_pengisian,
            'car_id' => $request->car_id,
            'jumlah_liter' => $request->jumlah_liter,
            'harga' => $request->harga,
            'harga_total' => $request->harga * $request->jumlah_liter,
            'keterangan' => $request->keterangan
                ]);

        return redirect('/dashboard/fuel')->with('status', 'Data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fuel $fuel)
    {
        Fuel::destroy($fuel->id);
        return redirect('/dashboard/fuel')->with('status', 'Data has been deleted.');
    }
}
