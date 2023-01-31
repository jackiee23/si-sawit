<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Repayment;
use Illuminate\Http\Request;

class RepaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.repayment.index', [
            'title' => 'Pengembalian',

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loans = Loan::all();
        return view('dashboard.repayment.create',[
            'title' => 'Pengembalian',
            'loans' => $loans
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
            'loan_id' => 'required',
            'tgl' => 'required',
            'nilai' => 'required',
        ]);

        Repayment::create($request->all());
        return redirect('/dashboard/repayment')->with('status', 'New data has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function show(Repayment $repayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function edit(Repayment $repayment)
    {
        $loans = Loan::all();
        return view('dashboard.repayment.edit', [
            'repayment' => $repayment,
            'title' => 'Pengembalian',
            'loans' => $loans
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repayment $repayment)
    {
        $request->validate([
            'loan_id' => 'required',
            'tgl' => 'required',
            'nilai' => 'required',
        ]);

        Repayment::where('id', $repayment->id)
            ->update([
                'loan_id' => $request->loan_id,
                'tgl' => $request->tgl,
                'nilai' => $request->nilai,
            ]);
        return redirect('/dashboard/repayment')->with('status', 'Data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Repayment  $repayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repayment $repayment)
    {
        $post = Repayment::destroy($repayment->id);
        return response()->json($post);
    }
}
