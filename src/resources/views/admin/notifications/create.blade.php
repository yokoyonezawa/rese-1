@extends('layouts.app')

@section('content')
<div>
    <h1>お知らせメールの送信</h1>
    <form method="POST" action="{{ route('admin.notifications.store') }}">
        @csrf
        <div>
            <label for="message">お知らせ内容</label>
            <textarea id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit">送信</button>
    </form>
</div>
@endsection
