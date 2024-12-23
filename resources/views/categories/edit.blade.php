<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Update Category</title>
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
        <h1 class="mb-4 text-3xl font-bold">Update Category</h1>
        <a href="{{ route('categories.index') }}" class="inline-block px-4 py-2 mb-4 text-white bg-gray-700 rounded hover:bg-gray-900"><- Back</a>
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            @method('POST')
            <label for="name" class="block mb-2 text-lg">
                Name:
                <input type="text" name="name" id="name" value="{{ $category->name }}" class="px-2 py-1 w-full rounded border border-gray-300">
                @error('name')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </label>
            <label for="image" class="block mb-2 text-lg">
                Image:
                <img src="{{ asset('images/' . $category->image) }}" alt="{{ $category->name }}" class="object-cover mb-4 w-48 h-48 rounded" id="image-preview">
                <input type="file" name="image" id="image" class="px-2 py-1 w-full rounded border border-gray-300" onchange="
                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        const imagePreview = document.getElementById('image-preview');
                        imagePreview.setAttribute('src', reader.result);
                    });
                    reader.readAsDataURL(this.files[0]);
                ">
                @error('image')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </label>
            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Update</button>
        </form>
    </div>
</body>

</html>
