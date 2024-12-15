@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/edit.css') }}">

@section('content')
<div class="container">
    <h1>店舗情報編集</h1>

    <!-- メッセージ表示 -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('store.shops.update', $shop->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">店舗名</label>
            <input type="text" id="name" name="name" value="{{ old('name', $shop->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="detail" class="form-label">店舗詳細</label>
            <textarea id="detail" name="detail" class="form-control">{{ old('detail', $shop->detail) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="area_id" class="form-label">エリア</label>
            <select id="area_id" name="area_id" class="form-control" required>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}" {{ $shop->area_id == $area->id ? 'selected' : '' }}>
                        {{ $area->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="genre_id" class="form-label">ジャンル</label>
            <select id="genre_id" name="genre_id" class="form-control" required>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ $shop->genre_id == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">画像</label>
            <input type="file" id="image" name="image" class="form-control">
            @if($shop->image_url)
                <img src="{{ asset('storage/' . $shop->image_url) }}" alt="現在の画像" class="img-thumbnail mt-2" style="max-height: 200px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection
