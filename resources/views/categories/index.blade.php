@extends('layouts.master')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fas fa-tags icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>Categories
                        <div class="page-title-subheading">
                            Manage your categories here
                        </div>
                    </div>
                </div>
                @can('category-create')
                    <div class="page-title-actions">
                        <a href="{{ route('categories.create') }}" class="btn-shadow btn btn-info">
                            <span class="pr-2 btn-icon-wrapper opacity-7">
                                <i class="fa fa-plus fa-w-20"></i>
                            </span>
                            Add New Category
                        </a>
                    </div>
                @endcan
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3 main-card card">
                    <div class="card-header">
                        Categories List
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th class="">Image</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="p-0 widget-content">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $category->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <img src="{{ asset('images/' . $category->image) }}"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        </td>
                                        <td class="text-center">
                                            @can('category-view')
                                                <a href="{{ route('categories.show', $category->id) }}"
                                                    class="btn btn-primary btn-sm">Details</a>
                                            @endcan
                                            @can('category-edit')
                                                <a href="{{ route('categories.edit', $category->id) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>
                                            @endcan
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                @can('category-delete')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                @endcan
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
