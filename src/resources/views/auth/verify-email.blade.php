@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">

@section('content')
<div class="content">
    <div class="email_verify">
        <h1>メール認証が必要です</h1>
        <p>登録したメールアドレスに認証リンクを送信しました。</p>
        <p>認証メールが届いていない場合、再送信できます。</p>

        @if (session('status') == 'verification-link-sent')
            <p>新しい認証リンクが送信されました。</p>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit">認証メールを再送する</button>
        </form>
    </div>
</div>
@endsection
