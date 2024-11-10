<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;

class EmailVerificationController extends Controller
{
    public function verify(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (! hash_equals($request->route('hash'), sha1($user->email))) {
            return redirect('/')->with('error', '不正なリンクです。');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/')->with('message', 'メールはすでに認証されています。');
        }

        $user->markEmailAsVerified();
        event(new Verified($user));

        return redirect('/')->with('message', 'メール認証が完了しました。');
    }
}
