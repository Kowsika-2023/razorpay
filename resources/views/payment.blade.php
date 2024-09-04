<!DOCTYPE html>
<html>
<head>
    <title>Razorpay Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <script>
        var options = {
            "key": "{{ env('RAZORPAY_KEY_ID') }}", // Access key from .env
            "amount": "{{ $amount }}",
            "currency": "{{ $currency }}",
            // ... other options
        };
        var rzp = new Razorpay(options);
        rzp.open();
    </script>
</body>
</html>
