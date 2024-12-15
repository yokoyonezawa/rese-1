@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/done.css') }}">

@section('content')

<div class="body">
    <div class="done__content">
        <div class="done__content-message">
            <h2>ご予約ありがとうございます</h2>
        </div>
        <div class="done__content--btn">
            <button type="button" onClick="history.back()">戻る</button>
        </div>
    </div>
</div>

@endsection