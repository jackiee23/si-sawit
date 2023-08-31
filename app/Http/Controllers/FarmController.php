<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAllFields(Request $request)
    {
        try {
            $getFields = Farmer::where('id', $request->id)->first();
            // here you could check for data and throw an exception if not found e.g.
            // if(!$getFields) {
            //     throw new \Exception('Data not found');
            // }
            return response()->json($getFields, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    public function index()
    {
        $farm = Farm::all();
        return view('dashboard.farm.index', [
            "kebun" => $farm,
            "title" => "Kebun"
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
        return view('dashboard.farm.create', [
            "title" => "Kebun",
            "farmer" => $farmer
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
            "nama_kebun" => "required",
            "farmer_id" => "required",
            "luas" => "required",
            "jarak" => "required",
            "umur" => "required",
            "jenis_tanah" => "required"
        ]);

        Farm::create($request->all());
        return redirect('/dashboard/farm')->with('status', 'New farm has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function show(Farm $farm)
    {
        return $farm;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function edit(Farm $farm)
    {
        $farmer = Farmer::all();
        return view('dashboard.farm.edit', compact('farm'), [
            "title" => "Kebun",
            "farmer" => $farmer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Farm $farm)
    {
        $request->validate([
            "nama_kebun" => "required",
            "farmer_id" => "required",
            "luas" => "required",
            "jarak" => "required",
            "umur" => "required",
            "jenis_tanah" => "required"
        ]);

        Farm::where('id', $farm->id)
            ->update([
                'nama_kebun' => $request->nama_kebun,
                "farmer_id" => $request->farmer_id,
                'luas' => $request->luas,
                'jarak' => $request->jarak,
                'umur' => $request->umur,
                'jenis_tanah' => $request->jenis_tanah
            ]);
        return redirect('/dashboard/farm')->with('status', 'Farm data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Farm  $farm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Farm $farm)
    {
        // $post = Farm::destroy($farm->id);
        // return response()->json($post);

        $cek = DB::table('purchases')
        ->where('farm_id', $farm->id)
        ->first();
        // dd($cek);
        if ($cek == null) {
            $post = Farm::destroy($farm->id);
            return response()->json($post);
        }
    }
}
