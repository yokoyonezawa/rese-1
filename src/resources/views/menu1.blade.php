<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu1.css') }}">
</head>
<body>

<div class="menu-1">
    <div class="close__btn">×</div>
    <div class="menu-1__content">
        <ul>
            <li>Home</li>
            <li>
                <form class="form" action="/logout" method="post">
                @csrf
                Logout
            </li>
            <li>Mypage</li>
        </ul>
    </div>
</div>

</body>
</html>