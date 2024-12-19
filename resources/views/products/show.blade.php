<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Product Details</title>
</head>

<body class="bg-gray-100">
    <nav class="bg-white shadow">
        <div class="container flex justify-between px-4 py-2 mx-auto">
            <a href="/" class="text-2xl font-bold">Laravel Exercises</a>
            <ul class="flex gap-4">
                <li><a href="{{ route('categories.index') }}" class="hover:text-blue-500">Categories</a></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-blue-500">Products</a></li>
            </ul>
        </div>
    </nav>
    <div class="container p-4 mx-auto">
        <h1 class="mb-4 text-3xl font-bold">Product Details</h1>
        <a href="{{ route('products.index') }}" class="inline-block px-4 py-2 mb-4 text-white bg-gray-700 rounded hover:bg-gray-900"><- Back</a>
        <div class="flex justify-center items-center">
            <div class="p-4 bg-white rounded shadow">
                <h2 class="text-2xl font-bold">{{ $product['id'] }}. {{ $product['name'] }}</h2>
                <img src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}"
                    class="object-cover mx-auto w-48 h-48 rounded">
                <p class="mt-4">{{ $product['description'] }}</p>
                <span class="block mt-4">price: ${{ $product['price'] }}</span>
            </div>
        </div>
    </div>
</body>

</html>
