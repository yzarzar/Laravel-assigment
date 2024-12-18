<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Category Details</title>
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
        <h1 class="mb-4 text-3xl font-bold">Category Details</h1>
        <a href="{{ route('categories.index') }}" class="px-4 py-2 font-bold text-white bg-gray-700 rounded hover:bg-gray-900"><- Back</a>
        <div class="p-4 mt-4 bg-white rounded shadow">
            <h2 class="text-2xl font-bold">{{ $category['id'] }}. {{ $category['name'] }}</h2>
        </div>
    </div>
</body>
</html>
