@extends('layouts.admin')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('page-subtitle', 'Configure system settings')

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
    <div class="col-lg-3">
        <div class="premium-card p-0 overflow-hidden">
            <div class="list-group list-group-flush border-0">
                <a href="#profile" class="list-group-item list-group-item-action active border-0 px-4 py-3" data-bs-toggle="list" style="background: transparent; color: var(--text-title); font-weight: 600;">
                    <i class="bi bi-person me-2"></i> Profile
                </a>
                <a href="#security" class="list-group-item list-group-item-action border-0 px-4 py-3" data-bs-toggle="list" style="background: transparent; color: var(--text-body);">
                    <i class="bi bi-shield-lock me-2"></i> Security
                </a>
            </div>
        </div>
        
        <style>
            .list-group-item.active {
                background: rgba(25, 137, 84, 0.1) !important;
                color: var(--primary-green) !important;
                border-left: 4px solid var(--primary-green) !important;
            }
            .list-group-item {
                transition: 0.3s;
                background: transparent !important;
                border: none !important;
                color: var(--text-body) !important;
            }
            .list-group-item:hover {
                background: rgba(128, 128, 128, 0.05) !important;
                padding-left: 30px !important;
            }
            
            .premium-input {
                background: rgba(128, 128, 128, 0.05) !important;
                border: 1px solid var(--glass-border) !important;
                border-radius: 12px !important;
                padding: 12px 18px !important;
                color: var(--text-body) !important;
                transition: all 0.3s;
            }
            .premium-input:focus {
                background: var(--bg-card) !important;
                border-color: var(--primary-green) !important;
                box-shadow: 0 0 0 4px rgba(25, 137, 84, 0.1) !important;
                transform: translateY(-2px);
            }
            .form-label {
                font-weight: 600;
                font-size: 0.9rem;
                color: var(--text-title);
                margin-bottom: 8px;
                display: block;
            }
        </style>
    </div>
    
    <div class="col-lg-9">
        <div class="tab-content">
            <!-- Profile Settings -->
            <div class="tab-pane fade show active" id="profile">
                <div class="premium-card p-4">
                    <div class="d-flex align-items-center mb-5 pb-3 border-bottom border-light border-opacity-10">
                        <i class="bi bi-person-circle fs-3 text-success me-3"></i>
                        <h5 class="fw-bold mb-0" style="color: var(--text-title)">Profile Information</h5>
                    </div>
                    
                    <div class="row align-items-center mb-5">
                        <div class="col-auto">
                            <div class="position-relative">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=198754&color=fff&size=128" 
                                     class="rounded-circle shadow-lg border border-4 border-white border-opacity-10" width="100" height="100" alt="Avatar">
                                <button class="btn btn-sm btn-success rounded-circle position-absolute bottom-0 end-0 p-2 shadow" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-camera-fill" style="font-size: 0.8rem;"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col">
                            <h4 class="fw-bold mb-1" style="color: var(--text-title)">{{ Auth::user()->name }}</h4>
                            <p class="text-success mb-0 fw-medium">Administrator</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.settings.profile') }}" method="POST">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control premium-input" value="{{ Auth::user()->name }}" required placeholder="Enter full name">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control premium-input" value="{{ Auth::user()->email }}" required placeholder="email@example.com">
                            </div>
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control premium-input" value="{{ Auth::user()->phone }}" placeholder="+62 8..." >
                            </div>
                        </div>
                        <div class="mt-2 text-end">
                            <button type="submit" class="btn btn-success px-5 py-3 rounded-pill fw-bold shadow-sm">
                                <i class="bi bi-check2-circle me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Security Settings -->
            <div class="tab-pane fade" id="security">
                <div class="premium-card p-4">
                    <div class="d-flex align-items-center mb-5 pb-3 border-bottom border-light border-opacity-10">
                        <i class="bi bi-shield-lock-fill fs-3 text-danger me-3"></i>
                        <h5 class="fw-bold mb-0" style="color: var(--text-title)">Account Security</h5>
                    </div>
                    
                    <form action="{{ route('admin.settings.password') }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-4">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control premium-input" required placeholder="••••••••">
                        </div>
                        <hr class="my-5 opacity-10">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control premium-input" minlength="8" required placeholder="Min. 8 characters">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control premium-input" required placeholder="Repeat new password">
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-danger px-5 py-3 rounded-pill fw-bold shadow-sm">
                                <i class="bi bi-key-fill me-2"></i>Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
