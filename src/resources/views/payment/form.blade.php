<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
</head>
<body>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
        @csrf
        <input type="hidden" name="amount" value="5000"> <!-- 金額 -->
        <div id="card-element"></div>
        <button type="submit">Pay</button>
    </form>

    <script>
        var stripe = Stripe('{{ env('STRIPE_PUBLISHABLE_KEY') }}');
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');
    </script>
</body>
</html>
