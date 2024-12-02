@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/shop_all.css') }}">

@section('content')
@if( Auth::check() )

<!-- 検索フィルター -->
<div class="search-filter">
    <form id="search-form" action="{{ url('/') }}" method="GET">
        <select name="area_id" id="area-select">
            <option value="">All area</option>
            @foreach($areas as $area)
                <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>
                    {{ $area->name }}
                </option>
            @endforeach
        </select>

        <select name="genre_id" id="genre-select">
            <option value="">All genre</option>
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>

        <input type="text" name="shop_name" id="shop-name" placeholder="Search by shop name" value="{{ request('shop_name') }}">
    </form>
</div>


<div class="shop__all">
<div class="shop__list">
    @foreach($shops as $shop)
    <div class="shop__card">
        <div class="shop__img">
            <img src="{{ Str::startsWith($shop->image_url, 'http') ? $shop->image_url : asset('storage/' . $shop->image_url) }}" alt="{{ $shop->name }}" />
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


<script>
    document.getElementById('area-select').addEventListener('change', function() {
        document.getElementById('search-form').submit();
    });

    document.getElementById('genre-select').addEventListener('change', function() {
        document.getElementById('search-form').submit();
    });

    // Enterキーが押されたらフォームを送信する処理
    document.getElementById('shop-name').addEventListener('keyup', function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); // フォームが送信されるデフォルトの動作を無効にする
            document.getElementById('search-form').submit(); // フォームを送信する
        }
    });
</script>




@endif
@endsection