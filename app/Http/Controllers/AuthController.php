<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Auth;

class AuthController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Login Page'
        );

        return view('index', $data);
    }

    public function cek_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }
    }
}
