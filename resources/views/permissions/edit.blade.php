@extends('layouts.master')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fas fa-key icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>Edit Permission
                        <div class="page-title-subheading">Modify existing permission details</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="mb-3 main-card card">
                    <div class="card-header">Edit Permission</div>
                    <div class="card-body">
                        <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="position-relative form-group">
                                <label for="name" class="font-weight-bold">Permission Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $permission->name }}" required>
                                <small class="form-text text-muted">Example: user-list, role-create, etc.</small>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Permission</button>
                            </div>
                        </form>

                        <div class="pt-4 mt-4 border-top">
                            <h5 class="mb-3">
                                <i class="mr-2 fas fa-user-shield"></i>
                                Related Roles
                            </h5>
                            <div class="table-responsive">
                                <table class="table mb-0 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 60px">#</th>
                                            <th>Role Name</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($permission->roles as $key => $role)
                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td>
                                                    <span class="badge badge-info">{{ $role->name }}</span>
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        This role has access to this permission
                                                    </small>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="py-3 text-center">
                                                    <em class="text-muted">No roles are currently using this permission</em>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @if ($permission->roles->count() > 0)
                                <div class="mt-3 mb-0 alert alert-info">
                                    <i class="mr-2 fas fa-info-circle"></i>
                                    This permission is being used by {{ $permission->roles->count() }} role(s).
                                    Modifying it will affect all these roles.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
