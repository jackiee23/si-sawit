<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $farmer = Farmer::all();
        return view('dashboard.farmer.index', [
            "petani" => $farmer,
            "title" => "Petani"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.farmer.create', [
            "title" => "Petani"
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
            "nama" => "required",
            "alamat" => "required",
            "no_wa" => "required",
            "luas" => "required",
            "jarak" => "required",
            "umur" => "required",
            "jenis_tanah" => "required"
        ]);

        Farmer::create($request->all());
        return redirect('/dashboard/farmer')->with('status', 'New farmer has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function show(Farmer $farmer)
    {
        return $farmer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function edit(Farmer $farmer)
    {
        // return $farmer;
            return view('dashboard.farmer.edit',compact('farmer'), [
            "title" => "Petani",
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Farmer $farmer)
    {
        $request->validate([
            "nama" => "required",
            "alamat" => "required",
            "no_wa" => "required",
            "luas" => "required",
            "jarak" => "required",
            "umur" => "required",
            "jenis_tanah" => "required"
        ]);

        Farmer::where('id', $farmer->id)
                ->update([
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'no_wa' => $request->no_wa,
                    'luas' => $request->luas,
                    'jarak' => $request->jarak,
                    'umur' => $request->umur,
                    'jenis_tanah' => $request->jenis_tanah
                ]);
        return redirect('/dashboard/farmer')->with('status', 'Farmer data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Farmer $farmer)
    {
        $cek = DB::table('purchases')
        ->where('farmer_id', $farmer->id)
        ->first();
        if ($cek == null) {
            $post = Farmer::destroy($farmer->id);
            return response()->json($post);
        }
    }
}
