<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index(){
        date_default_timezone_set("Asia/Jakarta");

        $b = time();
        $hour = date("G", $b);

        if ($hour >= 0 && $hour <= 11) {
            $ucapan = "Selamat Pagi :)";
        } elseif ($hour >= 12 && $hour <= 14) {
            $ucapan = "Selamat Siang :) ";
        } elseif ($hour >= 15 && $hour <= 17) {
            $ucapan = "Selamat Sore :) ";
        } elseif ($hour >= 17 && $hour <= 18) {
            $ucapan = "Selamat Petang :) ";
        } elseif ($hour >= 19 && $hour <= 23) {
            $ucapan = "Selamat Malam :) ";
        }
        return view('login', [
            'ucapan' => $ucapan
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Login failed!');

    }
}
