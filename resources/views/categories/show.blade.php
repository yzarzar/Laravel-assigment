@extends('layouts.master')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-drawer icon-gradient bg-happy-itmeo"></i>
                    </div>
                    <div>Category Details
                        <div class="page-title-subheading">
                            View detailed information about this category
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
                        <div class="row">
                            <div class="col-md-4">
                                <div class="position-relative">
                                    <img src="{{ asset('images/' . $category['image']) }}"
                                        alt="{{ $category['name'] }}"
                                        class="w-100 rounded shadow-sm">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="position-relative">
                                    <h4 class="mb-3">Category Details</h4>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="bg-light" style="width: 200px;">Name</th>
                                            <td>{{ $category['name'] }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Description</th>
                                            <td>{{ $category['description'] ?? 'No description available' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Created At</th>
                                            <td>{{ $category['created_at'] ? date('F j, Y, g:i a', strtotime($category['created_at'])) : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Updated At</th>
                                            <td>{{ $category['updated_at'] ? date('F j, Y, g:i a', strtotime($category['updated_at'])) : 'N/A' }}</td>
                                        </tr>
                                    </table>
                                    
                                    <div class="mt-4">
                                        <a href="{{ route('categories.edit', $category['id']) }}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i> Edit Category
                                        </a>
                                        <form action="{{ route('categories.destroy', $category['id']) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">
                                                <i class="fa fa-trash"></i> Delete Category
                                            </button>
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
