<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset("styles/index.css") }}">
    <link rel="stylesheet" href="{{ asset("styles/product.css") }}">
    <title>Product {{ $info->name }}</title>
</head>
<body>
    @include("welcome.header")
    <div style="width: 100%; height: 85vh; background-color: #6b7280; display: flex; justify-content: center; align-items: center">
        <div style="width: 50%; height: 100%; display: flex; justify-content: center; align-items: center">
            <div style="padding: 20px; color: white;">
                <img src="{{ $info->image_path }}" alt="">
                <p>Product Name: {{ $info->name }}</p>
                <p>Product Description: {{ $info->description }}</p>
            </div>
        </div>
        <div style="width: 50%; height: 100%; display: flex; justify-content: center; align-items: center">
            <div style="padding: 20px; color: white;" class="buttons-info">
                <p style="font-size: 40px; margin: 0">Price: ${{ $price }}</p>
                <a href="/cart/add-to-cart/{{ $info->name }}"><button style="padding: 15px 40px; background-color: #2563eb; color: white; cursor: pointer">Add to Cart</button></a>
                <a href="/cart"><button style="padding: 15px 40px; background-color: #49a62c; color: white; cursor: pointer">Buy</button></a>
            </div>
        </div>
    </div>

    @foreach($reviews as $review)
        <div style="padding: 10px; box-shadow: 1px 1px 2px 2px black; margin-top: 20px; margin-bottom: 20px">
            <p>{{ $review->name }}</p>
            <p>
                @for($i=0; $i<$review->stars; $i++)
                    &#128948;
                @endfor
            </p>
            <p>The review: {{ $review->review }}</p>
            <p>{{ $review->created_at }}</p>
        </div>
    @endforeach

    @if($bought)
        <div style="padding: 20px; background-color: #2d3748; margin-top: 10px; display: flex; justify-content: center; align-items: center">
            <form action="/reviews/add/{{ $info->id }}" class="review_form" method="post">
                @csrf
                <input type="number" max="5" min="1" name="stars" placeholder="Enter the number for stars">
                <input type="text" placeholder="Enter the review" name="review">
                <button type="submit" style="cursor: pointer;">
                    Submit
                </button>
            </form>
        </div>
    @else
        <p style="text-align: center; margin-top: 20px;">You need to buy this product to can leave a review</p>
    @endif
</body>
</html>
