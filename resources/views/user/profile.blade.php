@extends('layouts.user')

@section('title', 'Profile')
@section('page-title', 'My Profile')
@section('page-subtitle', 'Manage your account settings')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show rounded-4" role="alert">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row g-4">
    <!-- Profile Info Card -->
    <div class="col-lg-4">
        <div class="premium-card p-4 text-center">
            <div class="mb-4 position-relative d-inline-block">
                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm" style="width: 100px; height: 100px; font-size: 36px; background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%) !important;">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div class="position-absolute bottom-0 end-0 bg-white rounded-circle p-2 shadow-sm border" style="transform: translate(10%, 10%);">
                    <i class="bi bi-patch-check-fill text-primary fs-5"></i>
                </div>
            </div>
            <h5 class="fw-bold mb-1" style="color: var(--text-title)">{{ $user->name }}</h5>
            <p class="text-muted small mb-3">{{ $user->email }}</p>
            <span class="badge rounded-pill px-3 py-2" style="background: rgba(25, 135, 84, 0.1); color: var(--primary-green);">{{ ucfirst($user->role) }} Member</span>
            <hr class="my-4 opacity-10">
            <div class="row text-center g-0">
                <div class="col-6 border-end">
                    <h6 class="fw-bold text-success mb-0">{{ $user->bookings->count() }}</h6>
                    <small class="text-muted" style="font-size: 0.7rem;">Trips</small>
                </div>
                <div class="col-6">
                    <h6 class="fw-bold text-success mb-0">{{ $user->created_at->format('M Y') }}</h6>
                    <small class="text-muted" style="font-size: 0.7rem;">Active Since</small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Profile Settings -->
    <div class="col-lg-8">
        <div class="premium-card p-4 mb-4">
            <h6 class="fw-bold mb-4" style="color: var(--text-title)"><i class="bi bi-person-fill text-success me-2"></i>Profile Information</h6>
            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf @method('PUT')
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-muted">Full Name</label>
                        <input type="text" name="name" class="form-control premium-card border-0 py-2 px-3 shadow-none" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-muted">Email Address</label>
                        <input type="email" name="email" class="form-control premium-card border-0 py-2 px-3 shadow-none" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-muted">Phone Number</label>
                        <input type="text" name="phone" class="form-control premium-card border-0 py-2 px-3 shadow-none" value="{{ old('phone', $user->phone) }}" placeholder="+62">
                    </div>
                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-success rounded-pill px-5 shadow-sm">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Change Password -->
        <div class="premium-card p-4">
            <h6 class="fw-bold mb-4" style="color: var(--text-title)"><i class="bi bi-shield-lock-fill text-danger me-2"></i>Security Settings</h6>
            <form action="{{ route('user.password.update') }}" method="POST">
                @csrf @method('PUT')
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label small fw-bold text-muted">Current Password</label>
                        <input type="password" name="current_password" class="form-control premium-card border-0 py-2 px-3 shadow-none" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-muted">New Password</label>
                        <input type="password" name="password" class="form-control premium-card border-0 py-2 px-3 shadow-none" minlength="8" required>
                        <small class="text-muted" style="font-size: 0.65rem;">Minimum 8 characters</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-muted">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control premium-card border-0 py-2 px-3 shadow-none" required>
                    </div>
                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-danger rounded-pill px-5 shadow-sm">
                            Update Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
