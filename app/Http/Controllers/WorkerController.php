<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $worker = Worker::all();

        return view('worker.index', [
            'worker' => $worker,
            'title' => 'Pekerja'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('worker.create', [
            'title' => 'Pekerja'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *             "nama" => $this->faker->name(),
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_wa' => 'required',
            'jenis' => 'required',
        ]);

        Worker::create($request->all());
        return redirect('/worker')->with('status', 'New worker has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        return view('worker.edit', [
            'worker' => $worker,
            'title' => 'Pekerja'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_wa' => 'required',
            'jenis' => 'required',
        ]);

        Worker::where('id', $worker->id)
                ->update([
                    'nama' => $request->nama,
                    'alamat' => $request->alamat,
                    'no_wa' => $request->no_wa,
                    'jenis' => $request->jenis
                ]);

        return redirect('/worker')->with('status', 'Worker data has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        Worker::destroy($worker->id);
        return redirect('/worker')->with('status', 'Worker has been deleted');
    }
}
