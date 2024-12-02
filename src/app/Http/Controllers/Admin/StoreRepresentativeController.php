<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class StoreRepresentativeController extends Controller
{
    public function __construct()
    {
        // adminロールを持つユーザーのみアクセスを許可
        $this->middleware('role:admin');
    }


    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:4',
        ]);

        // 新しい店舗代表者の作成
        $storeRepresentative = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // ここでメール認証が完了したものとして扱い、email_verified_at に日時を設定
        $storeRepresentative->email_verified_at = Carbon::now();
        $storeRepresentative->save();

        // "store-representative" ロールを割り当て
        $storeRepresentative->assignRole('store-representative');

        // 店舗代表者作成ページにリダイレクト
        return view('admin.store-representative-create', [
            'storeRepresentative' => $storeRepresentative,
        ]);
    }

}
