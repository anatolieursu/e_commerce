<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset("styles/index.css") }}">
    <title>Cart | {{ \Illuminate\Support\Facades\Auth::user()->name }}</title>
</head>
<body>
    @include("welcome.header")
    @if(count($products) > 0)
            <div style="display: flex; justify-content: center; width: 100%">
                <div>
                    @php
                      $totalPrice = 0;
                    @endphp
                    @foreach($products as $product)
                        @php
                          $totalPrice += $product["price"];
                        @endphp
                        <div style="display: flex; justify-content: center; align-items: center; width: 80%; padding: 15px;">
                            <div>
                                <img style="width: 300px" src="{{ $product['image_path'] }}" alt="{{ $product["image_path"] }}">
                            </div>
                            <div style="margin-left: 20px;">
                                <p>Product Name: {{ $product["name"] }}</p>
                                <p>Description: {{ $product["description"] }}</p>
                                <div>
                                    <h1 style="font-family: Arial;font-size: 30px">${{ $product["price"] }}</h1>
                                    <form action="/cart/delete" method="post">
                                        @csrf
                                        <input style="display: none" type="number" name="productID" value="{{ $product["id"] }}">
                                        <button style="cursor: pointer;padding: 15px 50px; background-color: red; color: white" type="submit">Delete from Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div style="width: 100%; height: 10vh"></div>
                        <form action="/cart/checkout" method="post">
                            @csrf
                            <div style="width: 100%; display: flex; justify-content: space-around;">
                                <p style="margin: 0; font-size: 40px">Total: ${{ $totalPrice }}</p>
                                <button style="cursor: pointer; font-size: 20px; background-color: #49a62c; color: white; padding: 15px 50px;" type="submit">Checkout</button>
                            </div>
                        </form>
                </div>
            </div>
        @else
            <p style="text-align: center; margin-top: 20px; font-family: Arial">No products in your cart</p>
    @endif

        <div style="width: 100%; height: 10vh">

        </div>
</div>
</body>
</html>
