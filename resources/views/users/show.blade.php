@extends('layouts.master')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-user icon-gradient bg-happy-itmeo"></i>
                    </div>
                    <div>User Profile
                        <div class="page-title-subheading">
                            View and edit your profile information
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
                    <div class="card-header">Profile Information</div>
                    <div class="card-body">
                        <form action="{{ route('users.update', auth()->user()) }}" method="POST" id="profile-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="position-relative text-center">
                                        <div class="mb-3 avatar-circle">
                                            @if(auth()->user()->image)
                                                <img src="{{ asset('images/' . auth()->user()->image) }}"
                                                     alt="Profile Image"
                                                     class="img-fluid rounded-circle"
                                                     style="width: 150px; height: 150px; object-fit: cover;">
                                            @else
                                                <span class="display-4 font-weight-bold text-primary">
                                                    {{ substr(auth()->user()->name, 0, 1) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div id="image-upload-section" style="display: none;">
                                            <div class="position-relative form-group">
                                                <label for="image" class="form-label">Update Profile Image</label>
                                                <input type="file" id="image" name="image"
                                                    class="form-control @error('image') is-invalid @enderror"
                                                    accept="image/*"
                                                    onchange="previewImage(this)">
                                                @error('image')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="position-relative">
                                        <!-- View Mode -->
                                        <div id="view-mode">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th class="bg-light" style="width: 200px;">Name</th>
                                                    <td id="name-display">{{ auth()->user()->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light">Email</th>
                                                    <td id="email-display">{{ auth()->user()->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light">Address</th>
                                                    <td id="address-display">{{ auth()->user()->address ?? 'Not provided' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light">Phone</th>
                                                    <td id="phone-display">{{ auth()->user()->phone ?? 'Not provided' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light">Created At</th>
                                                    <td>{{ auth()->user()->created_at ? date('F j, Y, g:i a', strtotime(auth()->user()->created_at)) : 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-light">Updated At</th>
                                                    <td>{{ auth()->user()->updated_at ? date('F j, Y, g:i a', strtotime(auth()->user()->updated_at)) : 'N/A' }}</td>
                                                </tr>
                                            </table>
                                        </div>

                                        <!-- Edit Mode -->
                                        <div id="edit-mode" style="display: none;">
                                            <div class="position-relative form-group">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" id="name" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name', auth()->user()->name) }}" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="position-relative form-group">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" id="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email', auth()->user()->email) }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="position-relative form-group">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" id="address" name="address"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    value="{{ old('address', auth()->user()->address) }}">
                                                @error('address')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="position-relative form-group">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" id="phone" name="phone"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    value="{{ old('phone', auth()->user()->phone) }}">
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <button type="button" id="editBtn" class="btn btn-primary" onclick="toggleEdit()">
                                                <i class="fa fa-edit"></i> Edit Profile
                                            </button>
                                            <button type="submit" id="saveBtn" class="btn btn-success" style="display: none;">
                                                <i class="fa fa-save"></i> Save Changes
                                            </button>
                                            <button type="button" id="cancelBtn" class="btn btn-secondary" style="display: none;" onclick="toggleEdit()">
                                                <i class="fa fa-times"></i> Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .avatar-circle {
            width: 150px;
            height: 150px;
            background-color: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            border: 3px solid #e9ecef;
            overflow: hidden;
        }
    </style>

    <script>
        function toggleEdit() {
            const viewMode = document.getElementById('view-mode');
            const editMode = document.getElementById('edit-mode');
            const editBtn = document.getElementById('editBtn');
            const saveBtn = document.getElementById('saveBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            const imageUploadSection = document.getElementById('image-upload-section');

            if (editMode.style.display === 'none') {
                // Switch to edit mode
                viewMode.style.display = 'none';
                editMode.style.display = 'block';
                imageUploadSection.style.display = 'block';
                editBtn.style.display = 'none';
                saveBtn.style.display = 'inline-block';
                cancelBtn.style.display = 'inline-block';
            } else {
                // Switch to view mode
                viewMode.style.display = 'block';
                editMode.style.display = 'none';
                imageUploadSection.style.display = 'none';
                editBtn.style.display = 'inline-block';
                saveBtn.style.display = 'none';
                cancelBtn.style.display = 'none';
            }
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const avatarCircle = document.querySelector('.avatar-circle');
                    avatarCircle.innerHTML = `
                        <img src="${e.target.result}"
                             alt="Profile Image Preview"
                             class="img-fluid rounded-circle"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    `;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
