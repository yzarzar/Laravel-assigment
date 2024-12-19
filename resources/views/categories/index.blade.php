<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>All Categories</title>
</head>
<body>
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
        <h1 class="my-4 text-3xl font-bold">All Categories</h1>
        <a href="{{ route('categories.create') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">+ Add New Category</a>
        <div class="overflow-x-auto mt-4">
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th class="px-4 py-2 w-16 text-left border-t border-b">ID</th>
                        <th class="px-4 py-2 w-1/2 text-left border-t border-b">Name</th>
                        <th class="px-4 py-2 w-1/2 text-left border-t border-b">Image</th>
                        <th class="px-4 py-2 w-1/2 text-left border-t border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="px-4 py-2 border-t border-b">{{ $category->id }}</td>
                            <td class="px-4 py-2 border-t border-b">{{ $category->name }}</td>
                            <td class="px-4 py-2 border-t border-b">
                                <img src="{{ asset('images/' . $category->image) }}" alt="{{ $category->name }}" class="object-cover w-16 h-16 rounded">
                            </td>
                            <td class="flex gap-2 px-4 py-2 border-t border-b">
                                <a href="{{ route('categories.show', $category->id) }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Details</a>
                                <a href="{{ route('categories.edit', $category->id) }}" class="px-4 py-2 font-bold text-white bg-yellow-500 rounded hover:bg-yellow-700">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
