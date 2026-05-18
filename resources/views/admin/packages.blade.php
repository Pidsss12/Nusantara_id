@extends('layouts.admin')

@section('title', 'Packages')
@section('page-title', 'Manage Packages')
@section('page-subtitle', 'Create and manage tour packages')

@section('content')
<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-body">
        <div class="row g-3 align-items-center">
            <div class="col-lg-9">
                <form action="{{ route('admin.packages') }}" method="GET" class="row g-2">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0" placeholder="Search packages..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="destination_id" class="form-select">
                            <option value="">All Destinations</option>
                            @foreach($destinations as $dest)
                            <option value="{{ $dest->id }}" {{ request('destination_id') == $dest->id ? 'selected' : '' }}>{{ $dest->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success rounded-pill px-3">Filter</button>
                        <a href="{{ route('admin.packages') }}" class="btn btn-outline-secondary rounded-pill px-3">Reset</a>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 text-lg-end text-start">
                <button class="btn btn-success rounded-pill w-100 w-lg-auto" data-bs-toggle="modal" data-bs-target="#addPackageModal">
                    <i class="bi bi-plus-circle me-2"></i>New Package
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    @forelse($packages as $pkg)
    <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="position-relative">
                <img src="{{ $pkg->image ? asset($pkg->image) : 'https://picsum.photos/seed/pkg' . $pkg->id . '/400/250' }}" class="card-img-top" style="height: 200px; object-fit: cover; border-radius: 16px 16px 0 0;">
                <span class="position-absolute top-0 end-0 m-3 badge rounded-pill bg-{{ $pkg->status == 'Active' ? 'success' : 'secondary' }} shadow-sm">
                    {{ $pkg->status }}
                </span>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <h5 class="fw-bold mb-1">{{ $pkg->name }}</h5>
                    <small class="text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $pkg->destination->name ?? '-' }}</small>
                </div>
                
                <div class="row g-0 text-center py-3 my-3 border-top border-bottom">
                    <div class="col-4 border-end">
                        <i class="bi bi-calendar3 text-success d-block mb-1"></i>
                        <small class="fw-bold">{{ $pkg->duration }}</small>
                    </div>
                    <div class="col-4 border-end">
                        <i class="bi bi-people text-success d-block mb-1"></i>
                        <small class="fw-bold">{{ $pkg->max_participants }} Max</small>
                    </div>
                    <div class="col-4">
                        <i class="bi bi-bookmark-check text-warning d-block mb-1"></i>
                        <small class="fw-bold">{{ $pkg->bookings_count }} Booked</small>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mt-auto">
                    <div>
                        <small class="text-muted d-block">Price</small>
                        <h5 class="text-success fw-bold mb-0">Rp {{ number_format($pkg->price, 0, ',', '.') }}</h5>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-sm btn-outline-success rounded-pill me-1" data-bs-toggle="modal" data-bs-target="#editPackage{{ $pkg->id }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <form action="{{ route('admin.packages.destroy', $pkg) }}" method="POST" class="delete-form">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill btn-delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editPackage{{ $pkg->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-4 border-0 shadow">
                <form action="{{ route('admin.packages.update', $pkg) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="modal-header bg-success text-white border-0">
                        <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Package</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Package Name</label>
                                <input type="text" name="name" class="form-control rounded-3" value="{{ $pkg->name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Destination</label>
                                <select name="destination_id" class="form-select rounded-3" required>
                                    @foreach($destinations as $dest)
                                    <option value="{{ $dest->id }}" {{ $pkg->destination_id == $dest->id ? 'selected' : '' }}>{{ $dest->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Duration</label>
                                <input type="text" name="duration" class="form-control rounded-3" value="{{ $pkg->duration }}" placeholder="e.g. 3D/2N" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Price (Rp)</label>
                                <input type="number" name="price" class="form-control rounded-3" value="{{ $pkg->price }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Max Participants</label>
                                <input type="number" name="max_participants" class="form-control rounded-3" value="{{ $pkg->max_participants }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Status</label>
                                <select name="status" class="form-select rounded-3">
                                    <option value="Active" {{ $pkg->status == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ $pkg->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="description" class="form-control rounded-3" rows="4">{{ $pkg->description }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Update Image</label>
                                <input type="file" name="image" class="form-control rounded-3" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 py-5">
            <div class="card-body text-center text-muted">
                <i class="bi bi-box-seam display-1 d-block mb-3 opacity-25"></i>
                <h4>No packages found</h4>
                <p>Try adjusting your search or filters</p>
            </div>
        </div>
    </div>
    @endforelse
</div>

@if($packages->hasPages())
<div class="d-flex justify-content-center mt-5">
    {{ $packages->appends(request()->query())->links() }}
</div>
@endif

<div class="modal fade" id="addPackageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-success text-white border-0">
                    <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle me-2"></i>Create New Package</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Package Name</label>
                            <input type="text" name="name" class="form-control rounded-3" required placeholder="Enter package name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Destination</label>
                            <select name="destination_id" class="form-select rounded-3" required>
                                <option value="">Select Destination</option>
                                @foreach($destinations as $dest)
                                <option value="{{ $dest->id }}">{{ $dest->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Duration</label>
                            <input type="text" name="duration" class="form-control rounded-3" placeholder="e.g. 3D/2N" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Price (Rp)</label>
                            <input type="number" name="price" class="form-control rounded-3" placeholder="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Max Participants</label>
                            <input type="number" name="max_participants" class="form-control rounded-3" value="20" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control rounded-3" rows="4" placeholder="Tell more about this package..."></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Package Image</label>
                            <input type="file" name="image" class="form-control rounded-3" accept="image/*" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm">Create Package</button>
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
            button.addEventListener('click', function() {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Delete this package?',
                    text: "All associated data will be removed!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete',
                    cancelButtonText: 'Keep it',
                    background: '#fff',
                    customClass: {
                        popup: 'rounded-4 border-0 shadow',
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