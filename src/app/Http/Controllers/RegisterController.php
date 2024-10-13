<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
        public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        try {
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            return redirect('login')->with('result', '会員登録が完了しました');
        } catch (\Throwable $th) {
            return redirect('register')->with('result', 'エラーが発生しました');
        }
    }
}
