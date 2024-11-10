@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/rating.css') }}">

@section('content')

<div class="rating__content">
    <form action="{{ route('ratings.store', $shop->id) }}" method="POST">
    @csrf
    <label for="rating">評価（1～5）:</label>
        <input type="number" name="rating" min="1" max="5" required>
    <label for="comment">コメント:</label>
        <textarea name="comment" maxlength="255"></textarea>
    <button type="submit">評価を送信</button>
    </form>
</div>

@endsection