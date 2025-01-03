@extends('layouts.master')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fas fa-key icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>Permissions Management
                        <div class="page-title-subheading">Manage system permissions for roles and users</div>
                    </div>
                </div>
                <div class="page-title-actions">
                    @can('permission-create')
                        <a href="{{ route('permissions.create') }}" class="btn-shadow btn btn-info">
                            <span class="pr-2 btn-icon-wrapper opacity-7">
                                <i class="fas fa-plus fa-w-20"></i>
                            </span>
                            Create New Permission
                        </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="mb-3 main-card card">
                    <div class="card-header">Permissions List ({{ count($permissions) }})</div>
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Permission Name</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $key => $permission)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <div class="p-0 widget-content">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $permission->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @can('permission-edit')
                                                <a href="{{ route('permissions.edit', $permission->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan
                                            <form action="{{ route('permissions.destroy', $permission->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                @can('permission-delete')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
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
