<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Products</title>
</head>
<body>
    <h1>Add New Product</h1>
    <a href="{{ route('products.index') }}"><- Back</a>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        @method('POST')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required>
        <button type="submit">Create</button>
    </form>
</body>
</html>
