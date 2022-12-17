<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.user.index', [
            'title' => 'Admin',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.create', [
            'title' => 'Admin'
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
            'email' => 'required|email:dns',
            'no_wa' => 'required',
            'jenis' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'jenis' => $request->jenis,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/dashboard/user')->with('status', 'New admin has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('dashboard.user.show', [
            'title' => 'Admin',
            'admin' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.user.edit', [
            'title' => 'Admin',
            'admin' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        if ($request->old_password && $request->password){

            $request->validate([
                'old_password' => 'required',
                'password' => 'required|confirmed|min:6'
            ]);

            if (Hash::check($request->old_password, $user->password)) {
                $user->fill([
                    'password' => Hash::make($request->password)
                ])->save();

                return redirect('/dashboard/user')->with('status', 'Password changed.');
            } else {
                return redirect('/dashboard/user')->with('status', 'Password tidak sama.');
            }
        } else {
            $request->validate([
                'nama' => 'required',
                'no_wa' => 'required',
                'jenis' => 'required'
            ]);

            User::where('id', $user->id)
                ->update([
                    'nama' => $request->nama,
                    'no_wa' => $request->no_wa,
                    'jenis' => $request->jenis,
                ]);

            return redirect('/dashboard/user')->with('status', 'Data admin has been updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $post = User::destroy($user->id);
        return response()->json($post);
    }
}
