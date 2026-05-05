@extends('layouts.admin')

@section('title', 'Destinations')
@section('page-title', 'Manage Destinations')
@section('page-subtitle', 'Add, edit, and manage ecotourism destinations')

@section('content')
<!-- session success handled by layout -->

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <button class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addDestinationModal">
            <i class="bi bi-plus-circle me-2"></i>Add New Destination
        </button>
    </div>
    <form action="{{ route('admin.destinations') }}" method="GET" class="d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Search destinations..." value="{{ request('search') }}">
        <select name="province_id" class="form-select" style="width: 180px;">
            <option value="">All Provinces</option>
            @foreach($provinces as $province)
            <option value="{{ $province->id }}" {{ request('province_id') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
            @endforeach
        </select>
        <select name="category" class="form-select" style="width: 150px;">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        <select name="status" class="form-select" style="width: 130px;">
            <option value="">All Status</option>
            <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
            <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        <button type="submit" class="btn btn-outline-success"><i class="bi bi-search"></i></button>
        <a href="{{ route('admin.destinations') }}" class="btn btn-outline-secondary"><i class="bi bi-x-lg"></i></a>
    </form>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-4">Image</th>
                        <th class="border-0">Name</th>
                        <th class="border-0">Province</th>
                        <th class="border-0">Category</th>
                        <th class="border-0">Price</th>
                        <th class="border-0">Rating</th>
                        <th class="border-0">Bookings</th>
                        <th class="border-0">Status</th>
                        <th class="border-0">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($destinations as $dest)
                    <tr>
                        <td class="px-4">
                            <img src="{{ $dest->photo ? asset($dest->photo) : 'https://picsum.photos/seed/' . $dest->slug . '/60/60' }}" class="rounded" width="50" height="50" style="object-fit: cover;">
                        </td>
                        <td class="fw-bold">{{ $dest->name }}</td>
                        <td>{{ $dest->province->name ?? '-' }}</td>
                        <td><span class="badge bg-info-subtle text-info">{{ $dest->category }}</span></td>
                        <td>Rp {{ number_format($dest->price, 0, ',', '.') }}</td>
                        <td><span class="text-warning">⭐</span> {{ $dest->rating }}</td>
                        <td>{{ $dest->bookings_count }}</td>
                        <td>
                            <span class="badge bg-{{ $dest->status == 'Active' ? 'success' : 'secondary' }}">{{ $dest->status }}</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewModal{{ $dest->id }}"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editModal{{ $dest->id }}"><i class="bi bi-pencil"></i></button>
                                <form action="{{ route('admin.destinations.destroy', $dest) }}" method="POST" style="display:inline;" class="delete-form">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- View Modal -->
                    <div class="modal fade" id="viewModal{{ $dest->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content rounded-4">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title"><i class="bi bi-eye me-2"></i>{{ $dest->name }}</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="{{ $dest->photo ? asset($dest->photo) : 'https://picsum.photos/seed/' . $dest->slug . '/400/300' }}" class="img-fluid rounded mb-3">
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Province:</strong> {{ $dest->province->name ?? '-' }}</p>
                                            <p><strong>Category:</strong> {{ $dest->category }}</p>
                                            <p><strong>Location:</strong> {{ $dest->location }}</p>
                                            <p><strong>Price:</strong> Rp {{ number_format($dest->price, 0, ',', '.') }}</p>
                                            <p><strong>Quota/Day:</strong> {{ $dest->quota_per_day }}</p>
                                            <p><strong>Rating:</strong> ⭐ {{ $dest->rating }}</p>
                                            <p><strong>Total Bookings:</strong> {{ $dest->bookings_count }}</p>
                                            <p><strong>Status:</strong> <span class="badge bg-{{ $dest->status == 'Active' ? 'success' : 'secondary' }}">{{ $dest->status }}</span></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <p><strong>Description:</strong></p>
                                    <p>{{ $dest->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $dest->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content rounded-4">
                                <form action="{{ route('admin.destinations.update', $dest) }}" method="POST" enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Edit {{ $dest->name }}</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Destination Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ $dest->name }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Province</label>
                                                <select name="province_id" class="form-select" required>
                                                    @foreach($provinces as $province)
                                                    <option value="{{ $province->id }}" {{ $dest->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Category</label>
                                                <select name="category" class="form-select" required>
                                                    @foreach($categories as $cat)
                                                    <option value="{{ $cat }}" {{ $dest->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Price (Rp)</label>
                                                <input type="number" name="price" class="form-control" value="{{ $dest->price }}" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-select">
                                                    <option value="Active" {{ $dest->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                    <option value="Inactive" {{ $dest->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Location</label>
                                                <input type="text" name="location" class="form-control" value="{{ $dest->location }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Quota/Day</label>
                                                <input type="number" name="quota_per_day" class="form-control" value="{{ $dest->quota_per_day }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Description</label>
                                                <textarea name="description" class="form-control" rows="3" required>{{ $dest->description }}</textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Photo</label>
                                                <input type="file" name="photo" class="form-control" accept="image/*">
                                                <small class="text-muted">Leave empty to keep current photo</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary rounded-pill">Update Destination</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">No destinations found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($destinations->hasPages())
    <div class="card-footer">
        {{ $destinations->appends(request()->query())->links() }}
    </div>
    @endif
</div>

<!-- Add Destination Modal -->
<div class="modal fade" id="addDestinationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4">
            <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Add New Destination</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Destination Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Province</label>
                            <select name="province_id" class="form-select" required>
                                <option value="">Select Province</option>
                                @foreach($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select" required>
                                @foreach($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Price (Rp)</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Quota/Day</label>
                            <input type="number" name="quota_per_day" class="form-control" value="50">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Upload Photo</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill">Save Destination</button>
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
                    title: 'Delete destination?',
                    text: "All associated packages and bookings might be affected!",
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
