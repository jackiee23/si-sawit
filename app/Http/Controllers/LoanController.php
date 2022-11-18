<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('dashboard.loan.create', [
            'title' => 'Pinjaman'
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
            'nama'=>'required',
            'tgl'=>'required',
            'jenis_pinjaman'=>'required',
            'nilai'=>'required',
            'keterangan'=>'required'
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
        return view('dashboard.loan.edit',[
            'loan'=>$loan,
            'title' => 'Pinjaman'
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
            'tgl' => 'required',
            'jenis_pinjaman' => 'required',
            'nilai' => 'required',
            'keterangan' => 'required'
        ]);

        Loan::where('id', $loan->id)
                ->update([
                    'nama'=>$request->nama,
                    'tgl'=>$request->tgl,
                    'jenis_pinjaman'=>$request->jenis_pinjaman,
                    'nilai'=>$request->nilai,
                    'keterangan'=>$request->keterangan
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
