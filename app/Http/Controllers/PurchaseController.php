<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\Purchase;
use App\Models\Worker;
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

        return view('purchase.index', [
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

        return view('purchase.create', [
            'title'=>'Pembelian',
            'farmers'=>$farmer,
            'workers'=>$worker
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
            'keterangan' => 'required'
        ]);

        Purchase::create($request->all());
        return redirect('purchase')->with('status', 'New purchase has been added.');
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

        return view('purchase.edit', [
            'title' => 'Pembelian',
            'purchase' => $purchase,
            'farmers' => $farmer,
            'workers'=> $worker
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
            'keterangan' => 'required'
        ]);

        Purchase::where('id', $purchase->id)
                ->update([
            'farmer_id' => $request->farmer_id,
            'tgl_beli' => $request->tgl_beli,
            'jumlah_sawit' => $request->jumlah_sawit,
            'harga' => $request->harga,
            'worker_id' => $request->worker_id,
            'keterangan' => $request->keterangan
                ]);

        return redirect('/purchase')->with('status', 'Purchased data has been updated.');
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
        return redirect('/purchase')->with('status', 'Purchase has been deleted.');
    }
}
