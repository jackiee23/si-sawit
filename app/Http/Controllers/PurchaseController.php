<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\Purchase;
use App\Models\Worker;
use App\Models\Car;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase = Purchase::all();

        return view('dashboard.purchase.index', [
            'title'=>'Pembelian',
            'purchase'=>$purchase,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $farmer = Farmer::all();
        $worker = Worker::all();
        $car = Car::all();

        return view('dashboard.purchase.create', [
            'title'=>'Pembelian',
            'farmers'=>$farmer,
            'workers'=>$worker,
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
            'farmer_id' => 'required',
            'tgl_beli' => 'required',
            'jumlah_sawit' => 'required',
            'harga' => 'required',
            'worker_id' => 'required',
            'car_id' => 'required',
            'trip' => 'required',
            'keterangan' => 'required'
        ]);

        Purchase::create($request->all());
        return redirect('/dashboard/purchase')->with('status', 'New purchase has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $farmer = Farmer::all();
        $worker = Worker::all();
        $car = Car::all();

        return view('dashboard.purchase.edit', [
            'title' => 'Pembelian',
            'purchase' => $purchase,
            'farmers' => $farmer,
            'workers'=> $worker,
            'car' => $car

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'farmer_id' => 'required',
            'tgl_beli' => 'required',
            'jumlah_sawit' => 'required',
            'harga' => 'required',
            'worker_id' => 'required',
            'car_id' => 'required',
            'trip' => 'required',
            'keterangan' => 'required'
        ]);

        Purchase::where('id', $purchase->id)
                ->update([
            'farmer_id' => $request->farmer_id,
            'tgl_beli' => $request->tgl_beli,
            'jumlah_sawit' => $request->jumlah_sawit,
            'harga' => $request->harga,
            'worker_id' => $request->worker_id,
            'car_id' => $request->car_id,
            'trip' => $request->trip,
            'keterangan' => $request->keterangan
                ]);

        return redirect('/dashboard/purchase')->with('status', 'Purchased data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        Purchase::destroy($purchase->id);
        return redirect('/dashboard/purchase')->with('status', 'Purchase has been deleted.');
    }
}
