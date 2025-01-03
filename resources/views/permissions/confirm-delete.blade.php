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
                        Confirm Permission Deletion
                        <div class="page-title-subheading">This action will affect associated roles</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="mb-3 main-card card">
                    <div class="text-white card-header bg-warning">
                        <h5 class="m-0">Warning: Deleting Permission "{{ $permission->name }}"</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger">
                            <h5><i class="fas fa-exclamation-circle"></i> This permission has {{ $roles->count() }}
                                associated roles:</h5>
                            <ul class="mt-3 list-group">
                                @foreach ($roles as $role)
                                    <li class="list-group-item">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="mb-0">{{ $role->name }}</h6>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mt-4">
                            <form action="{{ route('permissions.force-delete', $permission->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete Permission and All Roles
                                </button>
                            </form>
                            <a href="{{ route('permissions.index') }}" class="ml-2 btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
