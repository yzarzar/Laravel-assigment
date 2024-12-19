<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Product</title>
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
        <h1 class="mb-4 text-3xl font-bold">Edit Product</h1>
        <a href="{{ route('products.index') }}"
            class="inline-block px-4 py-2 mb-4 text-white bg-gray-700 rounded hover:bg-gray-900"><- Back</a>
        <form action="{{ route('products.update', ['id' => $product['id']]) }}" method="POST" class="mt-4"
            enctype="multipart/form-data">
            @csrf
            <label for="name" class="block mb-2 text-lg">
                Name:
                <input type="text" name="name" id="name" value="{{ $product['name'] }}"
                    class="px-2 py-1 w-full rounded border border-gray-300">
                @error('name')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </label>
            <label for="description" class="block mb-2 text-lg">
                Description:
                <textarea name="description" id="description" class="px-2 py-1 w-full h-40 rounded border border-gray-300">{{ $product['description'] }}</textarea>
                @error('description')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </label>
            <label for="price" class="block mb-2 text-lg">
                Price:
                <input type="decimal" name="price" id="price" value="{{ $product['price'] }}"
                    class="px-2 py-1 w-full rounded border border-gray-300">
                @error('price')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </label>
            <label for="image" class="block mb-2 text-lg">
                Image:
                <input type="file" name="image" id="image" class="px-2 py-1 w-full rounded border border-gray-300">
                @error('image')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </label>
            <label for="status" class="block mb-2 text-lg">
                Status:
                <input type="checkbox" name="status" id="status" class="rounded border-gray-300" >
                @error('status')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </label>
            <button type="submit"
                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Update</button>
        </form>
    </div>
</body>

</html>
