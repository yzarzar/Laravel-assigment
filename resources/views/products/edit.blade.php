@extends('layouts.master')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-box2 icon-gradient bg-happy-itmeo"></i>
                    </div>
                    <div>Edit Product
                        <div class="page-title-subheading">
                            Modify product information
                        </div>
                    </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('products.index') }}" class="btn-shadow btn btn-info">
                        <span class="pr-2 btn-icon-wrapper opacity-7">
                            <i class="fa fa-arrow-left fa-w-20"></i>
                        </span>
                        Back to List
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3 main-card card">
                    <div class="card-header">Product Information</div>
                    <div class="card-body">
                        <form action="{{ route('products.update', ['id' => $product['id']]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="position-relative form-group">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $product['name']) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="position-relative form-group">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product['category_id']) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="position-relative form-group">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" id="price" name="price" step="0.01"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price', $product['price']) }}" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="position-relative form-group">
                                <label for="image" class="block mb-2 text-lg">
                                    Image:
                                    <input type="file" name="image" id="image"
                                        class="px-2 py-1 w-full rounded border border-gray-300 @error('image') border-red-500 @enderror"
                                        onchange="
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
                                    <div class="mt-2">Current Image:</div>
                                    <img src="{{ asset('images/' . $product['image']) }}" id="image-preview"
                                        class="object-cover mt-2 w-48 h-48 rounded" alt="Current product image">
                                </label>
                            </div>

                            <div class="position-relative form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="4">{{ old('description', $product['description']) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="position-relative form-group">
                                <label for="status" class="form-label">Status</label>
                                <input type="checkbox" name="status" id="status" class="rounded border-gray-300" {{ $product['status'] ? 'checked' : '' }}>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="mt-3 btn btn-primary">Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
