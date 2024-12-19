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
    <div class="container p-6 mx-auto">
        <h1 class="mb-6 text-3xl font-bold text-center">Category Details</h1>
        <a href="{{ route('categories.index') }}"
            class="inline-block px-4 py-2 mb-6 font-bold text-white bg-gray-700 rounded hover:bg-gray-900">
            ← Back
        </a>
        <div class="flex justify-center">
            <div class="p-6 w-full max-w-sm bg-white rounded-lg shadow-lg">
                <!-- Image -->
                <div class="overflow-hidden w-full rounded-t-lg">
                    <img src="{{ asset('images/' . $category['image']) }}"
                        alt="{{ $category['name'] }}"
                        class="w-full h-auto">
                </div>
                <!-- Card Content -->
                <div class="p-4">
                    <h2 class="mb-2 text-xl font-semibold">{{ $category['name'] }}</h2>
                    <p class="text-gray-700">This is a brief description of the category. Add more details here if needed.</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
