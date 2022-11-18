<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Sale;
use App\Models\Worker;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale = Sale::all();

        return view('dashboard.sale.index', [
            'title' => 'Penjualan',
            'sale' => $sale,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $worker = Worker::all();
        $car = Car::all();

        return view('dashboard.sale.create', [
            'title' => 'Penjualan',
            'worker' => $worker,
            'car' => $car,
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
            'tgl_jual' => 'required',
            'jumlah' => 'required',
            'harga_pabrik' => 'required',
            'worker_id' => 'required',
            'car_id' => 'required',
            'pabrik' => 'required',
            'keterangan' => 'required'
        ]);

        Sale::create([
                    'tgl_jual' => $request->tgl_jual,
                    'jumlah' => $request->jumlah,
                    'harga_pabrik' => $request->harga_pabrik,
                    'harga_total' => $request->harga_pabrik*$request->jumlah,
                    'worker_id' => $request->worker_id,
                    'car_id' => $request->car_id,
                    'pabrik' => $request->pabrik,
                    'keterangan' => $request->keterangan
        ]);
        return redirect('/dashboard/sale')->with('status', 'New data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $worker = Worker::all();
        $car = Car::all();

        return view('dashboard.sale.edit', [
            'title' => 'Penjualan',
            'sale' => $sale,
            'worker' => $worker,
            'car' => $car
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'tgl_jual' => 'required',
            'jumlah' => 'required',
            'harga_pabrik' => 'required',
            'worker_id' => 'required',
            'car_id' => 'required',
            'pabrik' => 'required',
            'keterangan' => 'required'
        ]);

        Sale::where('id', $sale->id)
                ->update([
                    'tgl_jual' => $request->tgl_jual,
                    'jumlah' => $request->jumlah,
                    'harga_pabrik' => $request->harga_pabrik,
                    'harga_total' => $request->harga_pabrik*$request->jumlah,
                    'worker_id' => $request->worker_id,
                    'car_id' => $request->car_id,
                    'pabrik' => $request->pabrik,
                    'keterangan' => $request->keterangan
                ]);

        return redirect('/dashboard/sale')->with('status', 'Data has been updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $post = Sale::destroy($sale->id);
        return response()->json($post);
    }
}
