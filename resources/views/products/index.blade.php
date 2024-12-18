<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Products</title>
</head>

<body class="h-screen bg-gray-100">
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
        <h1 class="mb-4 text-3xl font-bold">All Products</h1>
        <a href="{{ route('products.create') }}"
            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
            + Add New Product
        </a>
        <ul class="mt-4">
            @foreach ($products as $data)
                <li class="p-4 mb-4 bg-white rounded shadow">
                    <a href="{{ route('products.show', ['id' => $data['id']]) }}">
                        <h2 class="text-2xl font-bold"><span>{{ $data['id'] }}. </span>{{ $data['name'] }}</h2>
                    </a>
                    <p class="text-gray-600">{{ $data['description'] }}</p>
                    <p class="text-gray-600">price: ${{ $data['price'] }}</p>
                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('products.edit', ['id' => $data['id']]) }}"
                            class="px-4 py-2 font-bold text-white bg-yellow-500 rounded hover:bg-yellow-700">
                            Edit
                        </a>
                        <form action="{{ route('products.destroy', ['id' => $data['id']]) }}" method="POST"
                            class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
