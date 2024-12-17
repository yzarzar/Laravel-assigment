<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Details</title>
</head>

<body>
    <h1>Product Details</h1>
    <a href="{{ route('products.index') }}"><- Back</a>
    <h2>{{ $product['id'] }}. {{ $product['name'] }}</h2>
    <p>{{ $product['description'] }}</p>
    <span>price: ${{ $product['price'] }}</span>
</body>

</html>
