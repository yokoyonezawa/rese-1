@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<div class="content">
    <div class="login__ttl">Login</div>
    @if(session('result'))
        <div class="error-message">{{ session('result') }}</div>
    @endif
    <form action="/login" method="post">
        @csrf
        <div class="login_content">
            Email<input type="email" name="email" value="{{ old('email') }}">
            @error('email')
            <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="login__content">
            Password<input type="password" name="password">
            @error('password')
            <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="btn-container">
            <input type="submit" value="ログイン">
        </div>
    </form>
</div>


@endsection