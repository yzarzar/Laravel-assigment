@extends('layouts.master')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-exclamation-triangle icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Confirm Category Deletion
                    <div class="page-title-subheading">This action will affect associated products</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header bg-warning text-white">
                    <h5 class="m-0">Warning: Deleting Category "{{ $category->name }}"</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger">
                        <h5><i class="fas fa-exclamation-circle"></i> This category has {{ $products->count() }} associated products:</h5>
                        <ul class="list-group mt-3">
                            @foreach($products as $product)
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" 
                                             class="mr-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <h6 class="mb-0">{{ $product->name }}</h6>
                                            <small class="text-muted">Price: ${{ $product->price }}</small>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-4">
                        <form action="{{ route('categories.force-delete', $category->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Delete Category and All Products
                            </button>
                        </form>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary ml-2">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
