<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Add New Products</title>
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
        <h1 class="mb-4 text-3xl font-bold">Add New Product</h1>
        <a href="{{ route('products.index') }}" class="inline-block px-4 py-2 mb-4 text-white bg-gray-700 rounded hover:bg-gray-900"><- Back</a>
        <form action="{{ route('products.store') }}" method="POST" class="mt-4">
            @csrf
            @method('POST')
            <label for="name" class="block mb-2 text-lg">
                Name:
                <input type="text" name="name" id="name" class="px-2 py-1 w-full rounded border border-gray-300 @error('name') border-red-500 @enderror" value="{{ old('name') }}">
                @error('name')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </label>
            <label for="description" class="block mb-2 text-lg">
                Description:
                <textarea name="description" id="description" class="px-2 py-1 w-full h-40 rounded border border-gray-300 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </label>
            <label for="price" class="block mb-2 text-lg">
                Price:
                <input type="decimal" name="price" id="price" class="px-2 py-1 w-full rounded border border-gray-300 @error('price') border-red-500 @enderror" value="{{ old('price') }}">
                @error('price')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </label>
            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Create</button>
        </form>
    </div>
</body>
</html>
