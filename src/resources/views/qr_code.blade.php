<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/qr_code.css') }}">
    <title>QRコード</title>
</head>
<body>
    <h1>予約確認用QRコード</h1>
    <div>{!! $qrCode !!}</div>
    <p>このQRコードを店舗側に提示してください。</p>
</body>
</html>
