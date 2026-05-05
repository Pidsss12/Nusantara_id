@extends('layouts.admin')

@section('title', 'Packages')
@section('page-title', 'Manage Packages')
@section('page-subtitle', 'Create and manage tour packages')

@section('content')
<!-- session success handled by layout -->

<div class="d-flex justify-content-between align-items-center mb-4">
    <form action="{{ route('admin.packages') }}" method="GET" class="d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Search packages..." value="{{ request('search') }}" style="width: 200px;">
        <select name="destination_id" class="form-select" style="width: 180px;">
            <option value="">All Destinations</option>
            @foreach($destinations as $dest)
            <option value="{{ $dest->id }}" {{ request('destination_id') == $dest->id ? 'selected' : '' }}>{{ $dest->name }}</option>
            @endforeach
        </select>
        <select name="status" class="form-select" style="width: 130px;">
            <option value="">All Status</option>
            <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
            <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        <button type="submit" class="btn btn-outline-success"><i class="bi bi-search"></i></button>
        <a href="{{ route('admin.packages') }}" class="btn btn-outline-secondary"><i class="bi bi-x-lg"></i></a>
    </form>
    <button class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addPackageModal">
        <i class="bi bi-plus-circle me-2"></i>Add New Package
    </button>
</div>

<div class="row g-4">
    @forelse($packages as $pkg)
    <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <img src="{{ $pkg->image ? asset($pkg->image) : 'https://picsum.photos/seed/pkg' . $pkg->id . '/400/200' }}" class="card-img-top" style="height: 150px; object-fit: cover; border-radius: 16px 16px 0 0;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h6 class="fw-bold mb-0">{{ $pkg->name }}</h6>
                    <span class="badge bg-{{ $pkg->status == 'Active' ? 'success' : 'secondary' }}">{{ $pkg->status }}</span>
                </div>
                <small class="text-muted"><i class="bi bi-geo-alt"></i> {{ $pkg->destination->name ?? '-' }}</small>
                
                <div class="d-flex justify-content-between mt-3 pt-3 border-top">
                    <div class="text-center">
                        <i class="bi bi-calendar3 text-success"></i>
                        <small class="d-block text-muted">{{ $pkg->duration }}</small>
                    </div>
                    <div class="text-center">
                        <i class="bi bi-people text-primary"></i>
                        <small class="d-block text-muted">Max {{ $pkg->max_participants }}</small>
                    </div>
                    <div class="text-center">
                        <i class="bi bi-bookmark-check text-warning"></i>
                        <small class="d-block text-muted">{{ $pkg->bookings_count }} booked</small>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                    <h5 class="text-success fw-bold mb-0">Rp {{ number_format($pkg->price, 0, ',', '.') }}</h5>
                    <div>
                        <button class="btn btn-sm btn-outline-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#editPackage{{ $pkg->id }}"><i class="bi bi-pencil"></i></button>
                        <form action="{{ route('admin.packages.destroy', $pkg) }}" method="POST" style="display:inline;" class="delete-form">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill btn-delete"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Package Modal -->
    <div class="modal fade" id="editPackage{{ $pkg->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-4">
                <form action="{{ route('admin.packages.update', $pkg) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Edit Package</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Package Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $pkg->name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Destination</label>
                                <select name="destination_id" class="form-select" required>
                                    @foreach($destinations as $dest)
                                    <option value="{{ $dest->id }}" {{ $pkg->destination_id == $dest->id ? 'selected' : '' }}>{{ $dest->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Duration</label>
                                <input type="text" name="duration" class="form-control" value="{{ $pkg->duration }}" placeholder="e.g. 3D/2N" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Price (Rp)</label>
                                <input type="number" name="price" class="form-control" value="{{ $pkg->price }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Max Participants</label>
                                <input type="number" name="max_participants" class="form-control" value="{{ $pkg->max_participants }}" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="Active" {{ $pkg->status == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ $pkg->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ $pkg->description }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <small class="text-muted">Leave empty to keep current image</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill">Update Package</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="text-center py-5 text-muted">
            <i class="bi bi-box-seam fs-1"></i>
            <p class="mt-3">No packages found</p>
        </div>
    </div>
    @endforelse
</div>

@if($packages->hasPages())
<div class="mt-4">
    {{ $packages->appends(request()->query())->links() }}
</div>
@endif

<!-- Add Package Modal -->
<div class="modal fade" id="addPackageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4">
            <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Add New Package</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Package Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Destination</label>
                            <select name="destination_id" class="form-select" required>
                                <option value="">Select Destination</option>
                                @foreach($destinations as $dest)
                                <option value="{{ $dest->id }}">{{ $dest->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Duration</label>
                            <input type="text" name="duration" class="form-control" placeholder="e.g. 3D/2N" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Price (Rp)</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Max Participants</label>
                            <input type="number" name="max_participants" class="form-control" value="20" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Upload Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill">Save Package</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Delete this package?',
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
