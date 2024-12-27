@extends('layouts.master')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-user icon-gradient bg-happy-itmeo"></i>
                    </div>
                    <div>Edit User
                        <div class="page-title-subheading">
                            Update user information
                        </div>
                    </div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('users.index') }}" class="btn-shadow btn btn-info">
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
                    <div class="card-header">User Information</div>
                    <div class="card-body">
                        <form action="{{ route('users.update-another-user', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="position-relative form-group">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" id="name" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email', $user->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea id="address" name="address"
                                                  class="form-control @error('address') is-invalid @enderror"
                                                  rows="3">{{ old('address', $user->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" id="phone" name="phone"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ old('phone', $user->phone) }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="position-relative form-group">
                                        <label for="image" class="form-label">Profile Image</label>
                                        @if($user->image)
                                            <div class="mt-2 mb-3" id="currentImageContainer">
                                                <img src="{{ asset('images/' . $user->image) }}"
                                                     alt="Current Profile Image"
                                                     id="imagePreview"
                                                     class="img-thumbnail"
                                                     style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                            </div>
                                        @else
                                            <div class="mt-2 mb-3" id="currentImageContainer">
                                                <img src=""
                                                     alt="Profile Image Preview"
                                                     id="imagePreview"
                                                     class="img-thumbnail"
                                                     style="max-width: 200px; max-height: 200px; object-fit: cover; display: none;">
                                            </div>
                                        @endif
                                        <input type="file" id="image" name="image"
                                            class="form-control @error('image') is-invalid @enderror"
                                            accept="image/*"
                                            onchange="handleImagePreview(this)">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="mt-2 form-text text-muted">
                                            Supported formats: JPG, PNG, GIF. Max size: 2MB
                                        </small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Update User
                                </button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
