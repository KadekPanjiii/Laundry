<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function cek_login(Request $request){
        $data = [
            'username'  => $request->username,
            'password'  => $request->password,
        ];

        if(Auth::attempt($data)){   
            return redirect('dashboard')->with('toastr', [
                'type' => 'success',
                'message' => 'Berhasil Login.'
            ]);
        } else {
            return redirect('/')->with('toastr', [
                'type' => 'error',
                'message' => 'Username atau Password Salah.'
            ]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('toastr', [
            'type' => 'success',
            'message' => 'Berhasil Logout.'
        ]);
    }
}
