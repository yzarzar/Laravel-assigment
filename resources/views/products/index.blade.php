<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
</head>

<body>
    <h1>All Products</h1>
    <a href="{{ route('products.create') }}">+ Add New Product</a>
    <ul style="list-style: none;">
        @foreach ($products as $data)
            <li>
                <a href="{{ route('products.show', ['id' => $data['id']]) }}">
                    <h2><span>{{ $data['id'] }}. </span>{{ $data['name'] }}</h2>
                    <form action="{{ route('products.destroy', ['id' => $data['id']]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </a>
                <p>{{ $data['description'] }}</p>
                <p>price: ${{ $data['price'] }}</p>
            </li>
        @endforeach
    </ul>
</body>

</html>
