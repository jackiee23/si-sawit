<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\Loan;
use App\Models\Worker;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAllFields(Request $request)
    {
        if($request->bagian == 1){
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
        } else if ($request->bagian == 2){
            try {
                $getFields = Worker::where('id', $request->id)->first();
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

    }

    public function index()
    {
        $loan = Loan::all();

        return view('dashboard.loan.index', [
            'loan' => $loan,
            'title' => 'Pinjaman'
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
        return view('dashboard.loan.create', [
            'title' => 'Pinjaman',
            'workers' => $worker,
            'farmers' => $farmer
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
            'nama' => 'required',
            'bagian' => 'required',
            'tgl' => 'required',
            'nik' => 'required',
            'jenis_pinjaman' => 'required',
            'nilai' => 'required',
            // 'keterangan' => 'required'
        ]);

        Loan::create($request->all());
        return redirect('/dashboard/loan')->with('status', 'New loan has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        $farmer = Farmer::all();
        $worker = Worker::all();
        return view('dashboard.loan.edit', [
            'loan' => $loan,
            'title' => 'Pinjaman',
            'farmers' => $farmer,
            'workers' => $worker
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        $request->validate([
            'nama' => 'required',
            'bagian' => 'required',
            'nik' => 'required',
            'tgl' => 'required',
            'jenis_pinjaman' => 'required',
            'nilai' => 'required',
            // 'keterangan' => 'required'
        ]);

        Loan::where('id', $loan->id)
            ->update([
                'nama' => $request->nama,
                'bagian' => $request->bagian,
                'nik' => $request->nik,
                'tgl' => $request->tgl,
                'jenis_pinjaman' => $request->jenis_pinjaman,
                'nilai' => $request->nilai,
                'keterangan' => $request->keterangan
            ]);
        return redirect('/dashboard/loan')->with('status', 'Loan data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        $post = Loan::destroy($loan->id);
        return response()->json($post);
    }
}
