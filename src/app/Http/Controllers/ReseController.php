<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\ReseRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReseController extends Controller
{
    public function done(Request $request){
        $shop_id = $request->input('shop_id');
        $date = $request->input('date');
        $time = $request->input('time');
        $number = $request->input('number');

        Reservation::create([
            'shop_id' => $shop_id,
            'user_id' => Auth::id(),
            'date' => $date,
            'time' => $time,
            'number' => $number,
        ]);

        return view('done', compact('shop_id', 'date', 'time', 'number'));
    }


    public function mypage()
    {
        if (!Auth::check()) {
        return redirect()->route('login');
        }
        $user = Auth::user();
        $reservations = Reservation::with('shop')->where('user_id', $user->id)->get();
        $favoriteShops = $user->favorites()->with('area', 'genre')->get();

        return view('my_page', compact('user', 'reservations', 'favoriteShops'));
    }


    public function cancelReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('mypage')->with('status', '予約をキャンセルしました');
    }


    public function shop_all(Request $request)
    {
        $areaId = $request->input('area_id');
        $genreId = $request->input('genre_id');
        $shopName = $request->input('shop_name');

        $query = Shop::with(['area', 'genre']);

        if ($areaId) {
            $query->where('area_id', $areaId);
        }

        if ($genreId) {
            $query->where('genre_id', $genreId);
        }

        if ($shopName) {
            $query->where('name', 'like', '%' . $shopName . '%');
        }

        // 検索条件に応じて結果を取得
        $shops = $query->get();

        // エリアとジャンルの一覧を取得
        $areas = Area::all();
        $genres = Genre::all();

        return view('shop_all', compact('areas', 'genres', 'shops'));
    }



    public function shop_detail($shop_id)
    {
        $shop = Shop::with(['area', 'genre'])->findOrFail($shop_id);
        $today = Carbon::today()->format('Y-m-d');


        return view('shop_detail', compact('shop', 'today'));
    }

    public function toggleFavorite($shop_id)
    {
        $user = auth()->user();
        $shop = Shop::findOrFail($shop_id);

        if ($user->favorites()->where('shop_id', $shop_id)->exists()) {
            //existsはレコードがあるか確認してくれる
            $user->favorites()->detach($shop_id);//あれば解除する
        } else {
            $user->favorites()->attach($shop_id);//なければ登録する
        }

        return redirect()->back();
    }

        public function editReservation($id)
{
    $reservation = Reservation::with('shop')->findOrFail($id);
    $today = Carbon::today()->format('Y-m-d');

    return view('reservation_edit', compact('reservation', 'today'));
}

public function updateReservation(ReseRequest $request, $id)
{
    $validatedData = $request->validated();
    $reservation = Reservation::findOrFail($id);


    $reservation->update([
        'date' => $validatedData['date'],
        'time' => $validatedData['time'],
        'number' => $validatedData['number'],
    ]);

    return redirect()->route('mypage')->with('status', '予約を変更しました');
}


}
