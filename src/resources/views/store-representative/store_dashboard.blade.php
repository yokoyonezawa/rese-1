@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/store_dashboard.css') }}">


@section('content')
<div class="container">
    <h1>店舗代表者ダッシュボード</h1>

    <!-- メッセージ表示 -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('store.shops.create') }}" class="btn btn-primary">新しい店舗を作成</a>
    </div>

    <!-- 登録済み店舗一覧 -->
    <h2>登録済み店舗</h2>
    <ul>
    @foreach($shops as $shop)
        <li>
            {{ $shop->name }} ({{ $shop->area->name }}) 
            <a href="{{ route('store.shops.edit', $shop->id) }}" class="btn btn-sm btn-secondary">編集</a>
        </li>
    @endforeach
    </ul>
    <ul>
    @foreach($shops as $shop)
        <li>
            {{ $shop->name }} ({{ $shop->area->name }})
            <a href="{{ route('store.reservations.index', $shop->id) }}" class="btn btn-sm btn-info">予約確認</a>
        </li>
    @endforeach
    </ul>
    <form action="/verify-qr-code" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="">
            <button type="submit">QRコードを確認</button>
    </form>
</div>
@endsection
