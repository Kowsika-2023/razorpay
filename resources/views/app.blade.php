<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel with Razorpay Pay</title>
  </head>
  <body>
       <form action="{{route('razorpaymethod')}}" method="post">
        @csrf
        @method('POST')
        <input type="text" name="amount" placeholder="Enter Amount">
        <button type="submit" >Pay with Razorpay</button>

       </form>
  </body>
</html>
