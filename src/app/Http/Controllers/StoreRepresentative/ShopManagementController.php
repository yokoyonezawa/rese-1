<?php

namespace App\Http\Controllers\StoreRepresentative;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;
use App\Models\Reservation;


class ShopManagementController extends Controller
{
    // ダッシュボードを表示
    public function dashboard()
    {
        // ログイン中の店舗代表者が登録した店舗を取得
        $shops = Shop::where('user_id', auth()->id())->get();

        return view('store-representative.store_dashboard', compact('shops'));
    }

    // 店舗作成フォーム表示
    public function create()
    {
        // 仮に Area モデルを使ってエリア情報を取得する例
        $areas = Area::all();

        $genres = Genre::all();

        return view('store-representative.shops.create', compact('areas', 'genres'));
    }

    // 店舗作成処理
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'area_id' => 'required|integer',
            'genre_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $shop = new Shop();
        $shop->name = $validated['name'];
        $shop->detail = $validated['detail'];
        $shop->area_id = $validated['area_id'];
        $shop->genre_id = $validated['genre_id'];
        $shop->user_id = auth()->id(); // 店舗代表者IDを設定

        // 画像がアップロードされている場合、ストレージに保存
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('shops', 'public'); // 'shops' フォルダに保存
            $shop->image_url = $imagePath; // 保存したパスをデータベースに保存

        }

        $shop->save();

        return redirect()->route('store.dashboard')->with('success', '店舗が作成されました！');
    }


    // 店舗編集フォーム表示
    public function edit($shopId)
    {
        $shop = Shop::where('id', $shopId)->where('user_id', auth()->id())->firstOrFail();
        $areas = Area::all();
        $genres = Genre::all();

        return view('store-representative.shops.edit', compact('shop', 'areas', 'genres'));
    }

    // 店舗更新処理
    public function update(Request $request, $shopId)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'area_id' => 'required|integer',
            'genre_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $shop = Shop::where('id', $shopId)->where('user_id', auth()->id())->firstOrFail();
        $shop->name = $validated['name'];
        $shop->detail = $validated['detail'];
        $shop->area_id = $validated['area_id'];
        $shop->genre_id = $validated['genre_id'];

        if ($request->hasFile('image')) {
            if ($shop->image_url) {
                Storage::disk('public')->delete($shop->image_url);
            }
            $shop->image_url = $request->file('image')->store('shops', 'public');
        }

        $shop->save();

        return redirect()->route('store.dashboard')->with('success', '店舗情報が更新されました！');
    }


    // 予約情報の表示
    public function reservations($shopId)
    {
        // 自分が登録した店舗の予約情報のみ表示
        $shop = Shop::where('id', $shopId)->where('user_id', auth()->id())->firstOrFail();

        // 指定された店舗の予約情報を取得
        $reservations = Reservation::where('shop_id', $shopId)->get();

        // ビューに渡す
        return view('store-representative.reservations.index', compact('shop', 'reservations'));
    }

}
