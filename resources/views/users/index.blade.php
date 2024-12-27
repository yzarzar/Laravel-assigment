@extends('layouts.master')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-happy-itmeo"></i>
                    </div>
                    <div>User Management
                        <div class="page-title-subheading">
                            Manage all users in the system
                        </div>
                    </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('users.create') }}" class="btn-shadow btn btn-info">
                        <span class="pr-2 btn-icon-wrapper opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Create New User
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="mb-3 main-card card">
                    <div class="card-header">Users List</div>
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <td class="text-center text-muted">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="p-0 widget-content">
                                                <div class="widget-content-wrapper">
                                                    <div class="mr-3 widget-content-left">
                                                        <div class="widget-content-left">
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
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $user->name }}</div>
                                                        @if (auth()->user()->id === $user->id)
                                                            <div class="widget-subheading opacity-7">
                                                                <span class="badge badge-info">You</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('user.show', ['id' => $user->id]) }}"
                                                    class="mr-2 btn btn-info btn-sm" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @if (auth()->user()->id !== $user->id)
                                                    <form action="{{ route('users.destroy', ['id' => $user->id]) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
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
