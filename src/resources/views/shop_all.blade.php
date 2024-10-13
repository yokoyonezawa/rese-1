@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/shop_all.css') }}">

@section('content')
@if( Auth::check() )

<div class="shop__all">
<div class="shop__list">
    @foreach($shops as $shop)
    <div class="shop__card">
        <div class="shop__img">
            <img src="{{ $shop->image_url }}" alt="{{ $shop->name }}" />
        </div>
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

        <div class="shop__favorite">
            <form action="{{ route('favorite.toggle', ['shop_id' => $shop->id]) }}" method="POST">
                @csrf
                @if(Auth::user()->favorites->contains($shop->id))
                    <button type="submit" class="favorite-btn">
                        ❤️
                    </button>
                @else
                    <button type="submit" class="favorite-btn">
                        🤍
                    </button>
                @endif
            </form>
        </div>


    </div>
    @endforeach
</div>
</div>

@endif
@endsection