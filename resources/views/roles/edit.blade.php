@extends('layouts.master')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-user-shield icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Edit Role: {{ $role->name }}
                    <div class="page-title-subheading">Modify role details and permissions</div>
                </div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('roles.index') }}" class="btn-shadow btn btn-info">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fas fa-arrow-left fa-w-20"></i>
                    </span>
                    Back to Roles
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Edit Role</div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('roles.update', $role) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="position-relative form-group">
                            <label for="name">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                value="{{ old('name', $role->name) }}" required 
                                {{ $role->name === 'admin' ? 'readonly' : '' }}>
                        </div>
                        
                        <div class="position-relative form-group">
                            <label>Permissions</label>
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-md-3">
                                        <div class="position-relative form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" 
                                                value="{{ $permission->name }}" id="permission{{ $permission->id }}"
                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <button type="submit" class="mt-2 btn btn-primary">Update Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
