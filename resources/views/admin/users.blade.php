@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', 'Manage Users')
@section('page-subtitle', 'View and manage user accounts')

@section('content')
<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-body">
        <div class="row g-3 align-items-center">
            <div class="col-lg-9">
                <form action="{{ route('admin.users') }}" method="GET" class="row g-2">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0" placeholder="Search name or email..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="role" class="form-select">
                            <option value="">All Roles</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success rounded-pill px-3">Filter</button>
                        <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary rounded-pill px-3">Reset</a>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 text-lg-end text-start">
                <button class="btn btn-success rounded-pill w-100 w-lg-auto" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="bi bi-person-plus me-2"></i>New User
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    @forelse($users as $user)
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body text-center">
                <div class="bg-{{ $user->role == 'admin' ? 'danger' : 'success' }} text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; font-size: 28px;">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <h6 class="fw-bold mb-1">{{ $user->name }}</h6>
                <small class="text-muted d-block mb-2">{{ $user->email }}</small>
                
                @if($user->role == 'admin')
                    <span class="badge bg-danger mb-2 px-3 py-2 rounded-pill">{{ ucfirst($user->role) }}</span>
                @else
                    <span class="badge bg-success mb-2 px-3 py-2 rounded-pill">{{ ucfirst($user->role) }}</span>
                @endif

                <div class="d-flex justify-content-around text-center mt-3 pt-3 border-top">
                    <div>
                        <h6 class="fw-bold text-success mb-0">{{ $user->bookings_count ?? 0 }}</h6>
                        <small class="text-muted">Bookings</small>
                    </div>
                    <div>
                        <small class="text-muted d-block">Joined</small>
                        <small>{{ $user->created_at->format('d M Y') }}</small>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-sm btn-outline-success rounded-pill me-1" data-bs-toggle="modal" data-bs-target="#editUser{{ $user->id }}"><i class="bi bi-pencil"></i></button>
                    
                    @if($user->role != 'admin' || \App\Models\User::where('role', 'admin')->count() > 1)
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;" class="delete-form">
                        @csrf @method('DELETE')
                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill btn-delete"><i class="bi bi-trash"></i></button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Edit User</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password <small class="text-muted">(leave empty to keep current)</small></label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success rounded-pill">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="text-center py-5 text-muted">
            <i class="bi bi-people fs-1"></i>
            <p class="mt-3">No users found</p>
        </div>
    </div>
    @endforelse
</div>

@if($users->hasPages())
<div class="mt-4">
    {{ $users->appends(request()->query())->links() }}
</div>
@endif

<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="bi bi-person-plus me-2"></i>Add New User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" minlength="8" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Delete this user?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete!',
                    cancelButtonText: 'Cancel',
                    background: 'rgba(255, 255, 255, 0.95)',
                    customClass: {
                        popup: 'premium-card',
                        title: 'fw-bold text-danger',
                        confirmButton: 'rounded-pill px-4',
                        cancelButton: 'rounded-pill px-4'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection