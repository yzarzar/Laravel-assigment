@extends('layouts.master')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="fas fa-key icon-gradient bg-mean-fruit"></i>
                    </div>
                    <div>Create Permission
                        <div class="page-title-subheading">Add a new permission to the system</div>
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
                    <div class="card-header">Create New Permission</div>
                    <div class="card-body">
                        <form action="{{ route('permissions.store') }}" method="POST">
                            @csrf
                            <div class="position-relative form-group">
                                <label for="name" class="font-weight-bold">Permission Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter permission name">
                                <small class="form-text text-muted">Example: user-list, role-create, etc.</small>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create Permission</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
