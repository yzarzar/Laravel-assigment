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
                        Confirm Role Deletion
                        <div class="page-title-subheading">This action will affect associated users</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="mb-3 main-card card">
                    <div class="text-white card-header bg-warning">
                        <h5 class="m-0">Warning: Deleting Role "{{ $role->name }}"</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger">
                            <h5><i class="fas fa-exclamation-circle"></i> This role has {{ $role->users()->count() }}
                                associated users:</h5>
                            <ul class="mt-3 list-group">
                                @foreach ($role->users as $user)
                                    <li class="list-group-item">
                                        <div class="d-flex align-items-center">
                                            @if ($user->image)
                                                <img width="40" height="40" class="rounded-circle"
                                                    src="{{ asset('images/' . $user->image) }}"
                                                    alt="{{ $user->name }}'s profile"
                                                    style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                            @else
                                                <div class="text-white widget-heading bg-primary rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px; object-fit: cover;">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0 ml-3">{{ $user->name }}</h6>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mt-4">
                            <form action="{{ route('roles.force-delete', $role->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete Role and All Users
                                </button>
                            </form>
                            <a href="{{ route('roles.index') }}" class="ml-2 btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
