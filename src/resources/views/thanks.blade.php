@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">

@section('content')
<div class="thanks__content">
    <div class="thanks__message">
        <p>会員登録ありがとうございます</p>
    </div>
    <a href="{{ route('login') }}">
        <button class="login__btn">ログインする</button>
    </a>
</div>
@endsection