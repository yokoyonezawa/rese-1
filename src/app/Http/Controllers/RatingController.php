<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request, $shop_id)
    {
        $shop = Shop::findOrFail($shop_id);

        $shop->ratings()->create([
            'user_id' => auth()->id(),
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
            'shop_id' => $shop_id, // 追加: shop_id を明示的に指定
        ]);

    return redirect()->route('shop_detail', $shop->id)->with('message', '評価が送信されました');
    }

    public function create($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);
        return view('rating', compact('shop'));
    }
}
