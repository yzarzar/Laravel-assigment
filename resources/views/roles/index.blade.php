@extends('layouts.master')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fas fa-user-shield icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>Roles Management
                        <div class="page-title-subheading">Manage user roles and their permissions</div>
                    </div>
                </div>
                <div class="page-title-actions">
                    @can('role-create')
                        <a href="{{ route('roles.create') }}" class="btn-shadow btn btn-info">
                            <span class="pr-2 btn-icon-wrapper opacity-7">
                                <i class="fas fa-plus fa-w-20"></i>
                            </span>
                            Create New Role
                        </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3 main-card card">
                    <div class="card-header">Roles List</div>
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Permissions</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>
                                            <div class="p-0 widget-content">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $role->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width: 800px;">
                                            @foreach ($role->permissions as $permission)
                                                <span class="badge badge-info"
                                                    style="margin-right: 5px;">{{ $permission->name }}</span>
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @can('role-edit')
                                                <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan
                                            @if ($role->name !== 'admin')
                                                <form action="{{ route('roles.destroy', $role) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this role?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    @can('role-delete')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @endcan
                                                </form>
                                            @endif
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
