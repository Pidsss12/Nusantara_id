@extends('layouts.user')

@section('title', 'Profile')
@section('page-title', 'My Profile')
@section('page-subtitle', 'Manage your account settings')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row g-4">
    <div class="col-lg-4">
        <div class="premium-card p-4 text-center">
            <div class="mb-4 position-relative d-inline-block">
                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm overflow-hidden" 
                     style="width: 120px; height: 120px; background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%) !important;">
                    @if($user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" class="w-100 h-100 object-fit-cover" id="profilePreview">
                    @else
                        <span class="text-white fw-bold" style="font-size: 42px;">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                    @endif
                </div>

                <form action="{{ route('user.profile.photo') }}" method="POST" enctype="multipart/form-data" id="photoForm">
                    @csrf @method('PATCH')
                    <input type="file" name="photo" id="photoInput" class="d-none" accept="image/*" onchange="document.getElementById('photoForm').submit()">
                    <button type="button" onclick="document.getElementById('photoInput').click()" 
                            class="position-absolute bottom-0 end-0 bg-white rounded-circle p-2 shadow-sm border btn-premium-action" 
                            style="transform: translate(5%, 5%); width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;"
                            title="Change Photo">
                        <i class="bi bi-camera-fill text-success fs-6"></i>
                    </button>
                </form>
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
                        <button type="submit" class="btn btn-success rounded-pill px-5 shadow-sm">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>

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
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-muted">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control premium-card border-0 py-2 px-3 shadow-none" required>
                    </div>
                    <div class="col-12 pt-2">
                        <button type="submit" class="btn btn-danger rounded-pill px-5 shadow-sm">Update Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection