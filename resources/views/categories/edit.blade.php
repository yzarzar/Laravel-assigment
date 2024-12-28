@extends('layouts.master')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fas fa-edit icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>Edit Category
                        <div class="page-title-subheading">
                            Modify category information
                        </div>
                    </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('categories.index') }}" class="btn-shadow btn btn-info">
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
                    <div class="card-header">Category Information</div>
                    <div class="card-body">
                        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="position-relative form-group">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" id="name" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $category->name) }}" required>
                                @error('name')
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
                                    <img src="{{ asset('images/' . $category->image) }}" id="image-preview"
                                        class="object-cover mt-2 w-48 h-48 rounded" alt="Current category image">
                                </label>
                            </div>

                            <div class="position-relative form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="4">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="mt-3 btn btn-primary">Update Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
