<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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


    public function shop_all()
    {
        $shops = Shop::with(['area', 'genre'])->get();

        return view('shop_all', compact('shops'));
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
            $user->favorites()->detach($shop_id);//あれば解除
        } else {
            $user->favorites()->attach($shop_id);//なければ登録
        }

        return redirect()->back();
    }



}
