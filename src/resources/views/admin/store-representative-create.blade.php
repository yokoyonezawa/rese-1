@extends('layouts.app')

@section('content')
    <h1>新しい店舗代表者が作成されました</h1>

    <div>
        <h2>代表者情報</h2>
        <p><strong>名前:</strong> {{ $storeRepresentative->name }}</p>
        <p><strong>メールアドレス:</strong> {{ $storeRepresentative->email }}</p>
    </div>

    <div>
        <a href="{{ route('admin.admin_dashboard') }}" class="btn btn-secondary">戻る（別の代表者を作成）</a>
    </div>
@endsection
