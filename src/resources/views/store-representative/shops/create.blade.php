@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/create.css') }}">

@section('content')
<div class="container">
    <h1>店舗情報作成</h1>
    <form action="{{ route('store.shops.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">店舗名</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="detail">詳細</label>
            <textarea class="form-control" id="detail" name="detail"></textarea>
        </div>
        <div class="form-group">
            <label for="area_id">エリア</label>
            <select class="form-control" id="area_id" name="area_id" required>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="genre_id">ジャンル</label>
            <select class="form-control" id="genre_id" name="genre_id" required>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>
        <form action="{{ route('store.shops.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- 他のフィールド -->

        <div class="form-group">
            <label for="image">店舗画像</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>

        <button type="submit" class="btn btn-primary">店舗を作成</button>
    </form>

</div>
@endsection
