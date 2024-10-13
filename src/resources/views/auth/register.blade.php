@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/register.css') }}">

@section('content')
<div class="content">
    <div class="register__ttl">Registration</div>
    <form action="/register" method="post">
        @csrf
        <div class="register__content">
            name<input type="text" name="name" value="{{ old('name') }}">
        </div>
        <div class="register_content">
            Email<input type="email" name="email" value="{{ old('email') }}">
        </div>
        <div class="register__content">
            Password<input type="password" name="password">
        </div>
        <div class="btn-container">
            <input type="submit" value="登録">
        </div>
    </form>
</div>
@endsection