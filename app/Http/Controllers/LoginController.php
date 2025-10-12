<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function postLogin(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password'))){
            return redirect('/studentDashboard');
        }

        return redirect('/login');
    }
}
