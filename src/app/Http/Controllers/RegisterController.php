<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;

class RegisterController extends Controller
{
        public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(AuthRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            // メール認証が完了したものとして扱うため、email_verified_at を現在の日時に設定
            $user->email_verified_at = Carbon::now();
            $user->save();

            // // メール認証通知を送信
            // $user->sendEmailVerificationNotification();

            // 新規登録ユーザーに "user" ロールを付与
            $user->assignRole('user');

            return redirect()->route('thanks');
        } catch (\Throwable $th) {
            return redirect('register')->with('result', 'エラーが発生しました');
        }
    }

    public function thanks()
    {
        return view('thanks');
    }

}
