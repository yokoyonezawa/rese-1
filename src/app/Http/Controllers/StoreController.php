<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{

    public function create(Request $request)
    {
        // // バリデーション
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'area_id' => 'required|exists:areas,id',
        //     'genre_id' => 'required|exists:genres,id',
        //     'detail' => 'nullable|string',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        // 画像アップロード処理
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('shops', 'public');
            $validatedData['image'] = $imagePath; // パスをデータに追加
        }

        // 店舗情報を保存
        $shop = Shop::create([
            'name' => $validatedData['name'],
            'area_id' => $validatedData['area_id'],
            'genre_id' => $validatedData['genre_id'],
            'detail' => $validatedData['detail'] ?? '',
            'image' => $validatedData['image'] ?? null,
            'user_id' => auth()->id(), // 店舗代表者のIDを保存
        ]);

        // 成功メッセージと共にリダイレクト
        return redirect()->route('shops.index')->with('success', '店舗が正常に作成されました！');
    }
}
