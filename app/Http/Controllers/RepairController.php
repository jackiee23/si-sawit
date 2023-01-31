<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Repair;
use App\Models\Type;
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
        $type = Type::all();

        return view('dashboard.repair.create', [
            'title' => 'Perbaikan',
            'car' => $car,
            'type' => $type
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
            'type_id' => 'required',
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
        $type = Type::all();
        return view('dashboard.repair.edit', [
            'title' => 'Perbaikan',
            'car' => $car,
            'type' => $type,
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
            'type_id' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required'
        ]);

        Repair::where('id', $repair->id)
                ->update([
                    'tgl_perbaikan' =>$request->tgl_perbaikan,
                    'car_id' => $request->car_id,
                    'type_id' => $request->type_id,
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
        $post = Repair::destroy($repair->id);
        return response()->json($post);
    }
}
