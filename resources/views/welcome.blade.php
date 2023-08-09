<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset("styles/index.css") }}">
    <title>E-Commerce Website | Ursu Anatolie</title>
</head>
<body>
    @include("welcome.header")
    <div class="container">
        <div class="customization">

        </div>
        @include("welcome.products")
    </div>
</body>
</html>
