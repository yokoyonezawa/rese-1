@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">

@section('content')

<div class="mypage__content">
    <div class="user-name">
        <h2>{{ $user->name }}さん</h2>
    </div>
    <div class="reservation__popup">
        <div class="reservation__ttl">
            <h2>予約状況</h2>
        </div>

        <div class="reservation__content">
        @forelse($reservations as $reservation)
            <div class="reservation__item">
                <p>予約{{ $loop->iteration }}</p>
                <!-- 予約変更ボタン -->
                <form action="{{ route('reservation.edit', ['id' => $reservation->id]) }}" method="GET">
                    <button type="submit">予約の変更</button>
                </form>
                <form action="/reservation/cancel/{{ $reservation->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">×</button>
                </form>
                <p>Shop: {{ $reservation->shop->name }}</p>
                <p>Date: {{ $reservation->date }}</p>
                <p>Time: {{ $reservation->time }}</p>
                <p>Number: {{ $reservation->number }}</p>
            </div>
            <div class="rating-page">
                <button onclick="location.href='{{ route('ratings.create', ['shop_id' => $reservation->shop->id]) }}'">評価する</button>
            </div>
            <div class="payment">
                <form action="{{ route('payment.form') }}" method="GET">
                    <button type="submit" class="btn btn-primary">お支払いページに進む</button>
                </form>
            </div>
            @empty
                <p>現在予約はありません。</p>
        @endforelse
    </div>

    </div>

    <div class="favorite__shops">
        <div class="favorite__ttl">
            <h2>お気に入り店舗</h2>
            <div class="shop__list">
                @forelse($favoriteShops as $shop)
                <div class="shop__item">
                    <div class="shop__content">
                        <div class="shop__name">
                            <h2>{{ $shop->name }}</h2>
                        </div>
                        <div class="shop__area">#{{ $shop->area->name }}</div>
                        <div class="shop_genre">#{{ $shop->genre->name }}</div>
                        <div class="shop__detail-btn">
                            <input type="button" onclick="location.href='{{ route('shop_detail', ['shop_id' => $shop->id]) }}'" value="詳しく見る">
                        </div>
                    </div>
                </div>
                @empty
                    <p>現在お気に入り店舗はありません。</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="qr-code__content">
        <h2>来店時にこちらのQRコードをスタッフへ提示してください</h2>
        @forelse($reservations as $reservation)
            <a href="{{ route('qr.generate', ['reservation_id' => $reservation->id]) }}" target="_blank">こちら</a>
        @empty
            <p>予約がないためQRコードは発行できません。</p>
        @endforelse
    </div>




</div>

@endsection
