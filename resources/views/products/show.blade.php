@extends('layouts.master')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fas fa-box icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>Product Details
                        <div class="page-title-subheading">
                            View detailed information about this product
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
                        <div class="row">
                            <div class="col-md-4">
                                <div class="position-relative">
                                    <img src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}"
                                        class="rounded shadow-sm w-100">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="position-relative">
                                    <h4 class="mb-3">Product Details</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="bg-light" style="width: 200px;">Name</th>
                                            <td>{{ $product['name'] }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Category</th>
                                            <td>{{ $product['category']['name'] }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Price</th>
                                            <td>${{ number_format($product['price'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Description</th>
                                            <td>{{ $product['description'] ?? 'No description available' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Created At</th>
                                            <td>{{ $product['created_at'] ? date('F j, Y, g:i a', strtotime($product['created_at'])) : 'N/A' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Updated At</th>
                                            <td>{{ $product['updated_at'] ? date('F j, Y, g:i a', strtotime($product['updated_at'])) : 'N/A' }}
                                            </td>
                                        </tr>
                                    </table>

                                    <div class="mt-4">
                                        @can('product-edit')
                                            <a href="{{ route('products.edit', $product['id']) }}" class="btn btn-primary">
                                                <i class="fa fa-edit"></i> Edit Product
                                            </a>
                                        @endcan
                                        <form action="{{ route('products.destroy', $product['id']) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            @can('product-delete')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                                    <i class="fa fa-trash"></i> Delete Product
                                                </button>
                                            @endcan
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
