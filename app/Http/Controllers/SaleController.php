<?php

namespace App\Http\Controllers;

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

        return view('sale.index', [
            'title' => 'Penjualan',
            'sale' => $sale
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

        return view('sale.create', [
            'title' => 'Penjualan',
            'worker' => $worker
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
            'keterangan' => 'required'
        ]);

        Sale::create($request->all());
        return redirect('/sale')->with('status', 'New data has been added');
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

        return view('sale.edit', [
            'title' => 'Penjualan',
            'sale' => $sale,
            'worker' => $worker
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
            'keterangan' => 'required'
        ]);

        Sale::where('id', $sale->id)
                ->update([
                    'tgl_jual' => $request->tgl_jual,
                    'jumlah' => $request->jumlah,
                    'harga_pabrik' => $request->harga_pabrik,
                    'worker_id' => $request->worker_id,
                    'keterangan' => $request->keterangan
                ]);

        return redirect('/sale')->with('status', 'Data has been updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        Sale::destroy($sale->id);
        return redirect('/sale')->with('status', 'Data has been deleted.');
    }
}
