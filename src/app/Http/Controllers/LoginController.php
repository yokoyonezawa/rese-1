<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect('/');
        } else {
            return redirect()->route('login')->with('result', 'メールアドレスまたはパスワードが間違っています');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect("login");
    }
}