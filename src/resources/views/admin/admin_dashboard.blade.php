@extends('layouts.app')

@section('content')
    <h1>店舗代表者の登録</h1>

    <form action="{{ route('admin.store-representatives.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">名前</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div>
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>

        <button type="submit">店舗代表者を作成</button>
    </form>
@endsection

