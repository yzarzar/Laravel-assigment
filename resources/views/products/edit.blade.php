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
            <ul class="flex gap-4 items-center">
                <li><a href="{{ route('categories.index') }}" class="hover:text-blue-500">Categories</a></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-blue-500">Products</a></li>
                <li class="relative" id="user-menu">
                    <button
                        class="flex gap-2 items-center px-4 py-2 w-full text-sm font-medium text-gray-700 bg-white rounded-md border border-gray-300 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100"
                        type="button" aria-expanded="false" aria-haspopup="true" onclick="toggleDropdown(event)">
                        <span
                            class="inline-flex justify-center items-center w-8 h-8 text-base font-semibold text-white bg-gray-700 rounded-full">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </span>
                        <span class="ml-2">{{ auth()->user()->name }}</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <ul id="dropdown-menu" class="hidden absolute right-0 py-1 w-48 bg-white rounded-md shadow-lg"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                        <a href="{{ route('user.show', ['id' => auth()->user()->id]) }}">
                            <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                Profile
                            </li>
                        </a>
                        <a href="#">
                            <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                Settings
                            </li>
                        </a>
                        <a href="{{ route('users.index') }}">
                            <li class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                See All Users
                            </li>
                        </a>
                        <a href="{{ route('users.create') }}">
                            <li class="block px-4 py-2 text-sm text-gray-700 border-t hover:bg-gray-100" role="menuitem">
                                + Create New User
                            </li>
                        </a>
                        <li class="block px-4 py-2 text-sm text-gray-700 border-t hover:bg-gray-100" role="menuitem">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
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
                <img src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}" class="object-cover mb-4 w-48 h-48 rounded" id="image-preview">
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
            <label for="category_id" class="block mb-2 text-lg">
                Category:
                <select name="category_id" id="category_id" class="px-2 py-1 w-full rounded border border-gray-300">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product['category_id'] ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </label>
            <label for="status" class="block mb-2 text-lg">
                Status:
                <input type="checkbox" name="status" id="status" class="rounded border-gray-300" {{ $product['status'] ? 'checked' : '' }}>
                @error('status')
                    <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </label>
            <button type="submit"
                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Update</button>
        </form>
    </div>
    <script>
        function toggleDropdown(event) {
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        window.addEventListener('click', function(event) {
            const userMenu = document.getElementById('user-menu');
            const dropdownMenu = document.getElementById('dropdown-menu');

            if (!userMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
