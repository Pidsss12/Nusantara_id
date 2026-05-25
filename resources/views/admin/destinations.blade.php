@extends('layouts.admin')

@section('title', 'Destinations')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="premium-card p-4 bg-white shadow-sm d-flex justify-content-between align-items-center" style="border-radius: 20px;">
                <div>
                    <h3 class="fw-bold mb-1">Manage Destinations</h3>
                    <p class="text-muted mb-0">Add, edit, and manage ecotourism destinations</p>
                </div>
                <div>
                    <button class="btn btn-success rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addDestinationModal">
                        <i class="bi bi-plus-circle me-2"></i>Add New Destination
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="premium-card p-3 bg-white shadow-sm" style="border-radius: 20px;">
                <form action="{{ route('admin.destinations') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control border-0 bg-light" placeholder="Search destinations..." value="{{ request('search') }}" style="border-radius: 10px;">
                    </div>
                    <div class="col-md-2">
                        <select name="province_id" class="form-select border-0 bg-light" style="border-radius: 10px;">
                            <option value="">All Provinces</option>
                            @foreach($provinces as $province)
                            <option value="{{ $province->id }}" {{ request('province_id') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="category" class="form-select border-0 bg-light custom-filter-select" style="border-radius: 10px;">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select border-0 bg-light" style="border-radius: 10px;">
                            <option value="">All Status</option>
                            <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-success flex-grow-1" style="border-radius: 10px;"><i class="bi bi-search"></i></button>
                        <a href="{{ route('admin.destinations') }}" class="btn btn-outline-secondary" style="border-radius: 10px;"><i class="bi bi-arrow-clockwise"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 px-4">Image</th>
                            <th class="border-0">Name</th>
                            <th class="border-0">Province</th>
                            <th class="border-0">Category</th>
                            <th class="border-0">Price</th>
                            <th class="border-0">Rating</th>
                            <th class="border-0">Status</th>
                            <th class="border-0 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($destinations as $dest)
                        @php
                            $pricingOptions = config('travel_pricing.destinations');
                            $hotelOptions = $pricingOptions[$dest->name]['hotels'] ?? $pricingOptions['Default']['hotels'];
                            $restaurantOptions = $pricingOptions[$dest->name]['restaurants'] ?? $pricingOptions['Default']['restaurants'];
                            $unavailableHotels = $dest->unavailable_hotels ?? [];
                            $unavailableRestaurants = $dest->unavailable_restaurants ?? [];
                            $unavailableMenus = $dest->unavailable_menus ?? [];
                        @endphp
                        <tr>
                            <td class="px-4">
                                <img src="{{ $dest->photo ? asset($dest->photo) : 'https://picsum.photos/seed/' . $dest->slug . '/60/60' }}" class="rounded-3" width="50" height="50" style="object-fit: cover;">
                            </td>
                            <td class="fw-bold">{{ $dest->name }}</td>
                            <td>{{ $dest->province->name ?? '-' }}</td>
                            <td>
                                <span class="badge border-0" style="background-color: rgba(26, 188, 156, 0.15); color: #1abc9c; font-weight: 600; padding: 0.5em 1em; border-radius: 50px;">
                                    {{ $dest->category }}
                                </span>
                            </td>
                            <td class="fw-medium">Rp {{ number_format($dest->price, 0, ',', '.') }}</td>
                            <td><span class="text-warning">⭐</span> {{ $dest->rating }}</td>
                            <td>
                                <span class="badge rounded-pill px-3 bg-{{ $dest->status == 'Active' ? 'success' : 'secondary' }}">{{ $dest->status }}</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-light mx-1 rounded" data-bs-toggle="modal" data-bs-target="#viewModal{{ $dest->id }}" style="color: #1abc9c;"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-sm btn-light text-success mx-1 rounded" data-bs-toggle="modal" data-bs-target="#editModal{{ $dest->id }}"><i class="bi bi-pencil"></i></button>
                                    <form action="{{ route('admin.destinations.destroy', $dest->id) }}" method="POST" style="display:inline;" class="delete-form">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-light text-danger mx-1 rounded btn-delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="viewModal{{ $dest->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content rounded-4 border-0">
                                    <div class="modal-header bg-success text-white border-0">
                                        <h5 class="modal-title fw-bold">{{ $dest->name }}</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <img src="{{ $dest->photo ? asset($dest->photo) : 'https://picsum.photos/seed/' . $dest->slug . '/400/300' }}" class="img-fluid rounded-4 shadow-sm">
                                            </div>
                                            <div class="col-md-7">
                                                <div class="mb-3">
                                                    <label class="text-muted small text-uppercase fw-bold">Location</label>
                                                    <p class="mb-0 fw-medium">{{ $dest->location }}, {{ $dest->province->name ?? '-' }}</p>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-6">
                                                        <label class="text-muted small text-uppercase fw-bold">Price</label>
                                                        <p class="mb-0 fw-bold text-success">Rp {{ number_format($dest->price, 0, ',', '.') }}</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="text-muted small text-uppercase fw-bold">Seats Occupied</label>
                                                        <p class="mb-0 fw-bold text-danger">{{ is_array($dest->occupied_seats) ? implode(',', $dest->occupied_seats) : ($dest->occupied_seats ?? 'None') }}</p>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="text-muted small text-uppercase fw-bold">Hotel</label>
                                                    @if(count($unavailableHotels))
                                                        <div class="d-flex flex-wrap gap-2 mt-1">
                                                            @foreach($unavailableHotels as $hotelName)
                                                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2">{{ $hotelName }}</span>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <p class="mb-0 fw-bold text-success">Semua hotel tersedia</p>
                                                    @endif
                                                </div>
                                                <div class="mb-3">
                                                    <label class="text-muted small text-uppercase fw-bold">Restoran</label>
                                                    @if(count($unavailableRestaurants))
                                                        <div class="d-flex flex-wrap gap-2 mt-1">
                                                            @foreach($unavailableRestaurants as $restaurantName)
                                                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2">{{ $restaurantName }}</span>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <p class="mb-0 fw-bold text-success">Semua restoran tersedia</p>
                                                    @endif
                                                </div>
                                                <div class="mb-3">
                                                    <label class="text-muted small text-uppercase fw-bold">Menu</label>
                                                    @if(count($unavailableMenus))
                                                        <div class="d-flex flex-wrap gap-2 mt-1">
                                                            @foreach($unavailableMenus as $menuName)
                                                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2">{{ str_replace('::', ' - ', $menuName) }}</span>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <p class="mb-0 fw-bold text-success">Semua menu tersedia</p>
                                                    @endif
                                                </div>
                                                <div>
                                                    <label class="text-muted small text-uppercase fw-bold">Description</label>
                                                    <p class="mb-0 text-muted small" style="text-align: justify;">{{ $dest->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="editModal{{ $dest->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content rounded-4 border-0">
                                    <form action="{{ route('admin.destinations.update', $dest->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="modal-header bg-primary text-white border-0">
                                            <h5 class="modal-title fw-bold">Edit Destination</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Destination Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $dest->name }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Province</label>
                                                    <select name="province_id" class="form-select" required>
                                                        @foreach($provinces as $province)
                                                        <option value="{{ $province->id }}" {{ $dest->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label fw-bold">Category</label>
                                                    <select name="category" class="form-select" required>
                                                        @foreach($categories as $cat)
                                                        <option value="{{ $cat }}" {{ $dest->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label fw-bold">Price (Rp)</label>
                                                    <input type="number" name="price" class="form-control" value="{{ $dest->price }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label fw-bold">Status</label>
                                                    <select name="status" class="form-select">
                                                        <option value="Active" {{ $dest->status == 'Active' ? 'selected' : '' }}>Active</option>
                                                        <option value="Inactive" {{ $dest->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-bold">Location Details</label>
                                                    <input type="text" name="location" class="form-control" value="{{ $dest->location }}" required>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-bold">Description</label>
                                                    <textarea name="description" class="form-control" rows="3" required>{{ $dest->description }}</textarea>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <label class="form-label fw-bold text-danger d-block mb-1">Set Blokir Kursi</label>
                                                    <input type="hidden" name="occupied_seats" id="edit_occupied_seats_input_{{ $dest->id }}" value="{{ is_array($dest->occupied_seats) ? implode(',', $dest->occupied_seats) : $dest->occupied_seats }}">
                                                    
                                                    @php
                                                        $currentOccupied = [];
                                                        if (!empty($dest->occupied_seats)) {
                                                            if (is_array($dest->occupied_seats)) {
                                                                $currentOccupied = $dest->occupied_seats;
                                                            } else {
                                                                $currentOccupied = array_map('intval', explode(',', str_replace(' ', '', $dest->occupied_seats)));
                                                            }
                                                        }
                                                    @endphp
                                                    
                                                    <div class="admin-seat-container edit-seat-grid" data-id="{{ $dest->id }}">
                                                        <div class="admin-seat {{ in_array(1, $currentOccupied) ? 'occupied' : '' }}" data-seat="1"></div>
                                                        <div class="admin-seat {{ in_array(2, $currentOccupied) ? 'occupied' : '' }}" data-seat="2"></div>
                                                        <div class="admin-aisle"></div>
                                                        <div class="admin-seat {{ in_array(3, $currentOccupied) ? 'occupied' : '' }}" data-seat="3"></div>
                                                        <div class="admin-seat {{ in_array(4, $currentOccupied) ? 'occupied' : '' }}" data-seat="4"></div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label fw-bold text-danger d-block mb-1">Hotel Penuh</label>
                                                    <div class="hotel-full-grid">
                                                        @foreach($hotelOptions as $hotel)
                                                            <label class="hotel-full-option {{ in_array($hotel['name'], $unavailableHotels, true) ? 'is-full' : '' }}">
                                                                <input type="checkbox" name="unavailable_hotels[]" value="{{ $hotel['name'] }}" {{ in_array($hotel['name'], $unavailableHotels, true) ? 'checked' : '' }}>
                                                                <span>
                                                                    <strong>{{ $hotel['name'] }}</strong>
                                                                    <small>Kisaran Rp {{ number_format($hotel['price'], 0, ',', '.') }}/mlm</small>
                                                                </span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label fw-bold text-danger d-block mb-1">Restoran Tidak Tersedia</label>
                                                    <div class="hotel-full-grid">
                                                        @foreach($restaurantOptions as $restaurant)
                                                            <label class="hotel-full-option {{ in_array($restaurant['name'], $unavailableRestaurants, true) ? 'is-full' : '' }}">
                                                                <input type="checkbox" name="unavailable_restaurants[]" value="{{ $restaurant['name'] }}" {{ in_array($restaurant['name'], $unavailableRestaurants, true) ? 'checked' : '' }}>
                                                                <span>
                                                                    <strong>{{ $restaurant['name'] }}</strong>
                                                                    <small>Tidak muncul sebagai pilihan aktif di user</small>
                                                                </span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label fw-bold text-danger d-block mb-1">Menu Habis</label>
                                                    <div class="hotel-full-grid">
                                                        @foreach($restaurantOptions as $restaurant)
                                                            @foreach(($restaurant['menus'] ?? []) as $menu)
                                                                @php
                                                                    $menuKey = $restaurant['name'] . '::' . $menu['name'];
                                                                @endphp
                                                                <label class="hotel-full-option {{ in_array($menuKey, $unavailableMenus, true) || in_array($menu['name'], $unavailableMenus, true) ? 'is-full' : '' }}">
                                                                    <input type="checkbox" name="unavailable_menus[]" value="{{ $menuKey }}" {{ in_array($menuKey, $unavailableMenus, true) || in_array($menu['name'], $unavailableMenus, true) ? 'checked' : '' }}>
                                                                    <span>
                                                                        <strong>{{ $menu['name'] }}</strong>
                                                                        <small>{{ $restaurant['name'] }} - Rp {{ number_format($menu['price'], 0, ',', '.') }}</small>
                                                                    </span>
                                                                </label>
                                                            @endforeach
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label fw-bold">Update Photo</label>
                                                    <input type="file" name="photo" class="form-control" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary rounded-pill px-4">Update Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-folder-x fs-1 d-block mb-2"></i>
                                No destinations found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($destinations->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            {{ $destinations->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>

<div class="modal fade" id="addDestinationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 border-0">
            <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-success text-white border-0">
                    <h5 class="modal-title fw-bold">Add New Destination</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Destination Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Raja Ampat" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Province</label>
                            <select name="province_id" class="form-select" required>
                                <option value="">Select Province</option>
                                @foreach($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Category</label>
                            <select name="category" class="form-select" required>
                                @foreach($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Price (Rp)</label>
                            <input type="number" name="price" class="form-control" placeholder="0" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Location Details</label>
                            <input type="text" name="location" class="form-control" placeholder="Full address" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Tell about this place..." required></textarea>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label fw-bold text-danger d-block mb-1">Set Blokir Kursi</label>
                            <input type="hidden" name="occupied_seats" id="add_occupied_seats_input" value="">
                            <div class="admin-seat-container" id="addSeatGrid">
                                <div class="admin-seat" data-seat="1"></div>
                                <div class="admin-seat" data-seat="2"></div>
                                <div class="admin-aisle"></div>
                                <div class="admin-seat" data-seat="3"></div>
                                <div class="admin-seat" data-seat="4"></div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="alert alert-light border rounded-4 mb-0">
                                <i class="bi bi-info-circle text-success me-2"></i>
                                Simpan destinasi dulu, lalu klik edit untuk mengatur hotel penuh, restoran tidak tersedia, dan menu habis.
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Destination Photo</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4">Save Destination</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .custom-filter-select:focus {
        border-color: #1abc9c !important;
        box-shadow: 0 0 0 0.25rem rgba(26, 188, 156, 0.25) !important;
    }

    /* CSS Khusus Admin Grid Kursi Premium Maksimal 4 Kursi */
    .admin-seat-container {
        display: grid;
        grid-template-columns: 45px 45px 25px 45px 45px;
        gap: 12px;
        justify-content: center;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 12px;
        border: 1px solid #dee2e6;
        width: fit-content;
        margin: 0 auto;
    }
    .admin-seat {
        width: 45px;
        height: 45px;
        background-color: #ffffff;
        border: 2px solid #198754;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0 !important;
        color: transparent !important;
        text-indent: -9999px !important;
    }
    .admin-seat::before, .admin-seat::after {
        content: "" !important;
        display: none !important;
    }
    .admin-seat.occupied {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
    }
    .admin-aisle {
        width: 25px;
    }

    .hotel-full-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 10px;
    }

    .hotel-full-option {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 12px;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        background: #fff;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .hotel-full-option input {
        margin-top: 4px;
    }

    .hotel-full-option span {
        display: flex;
        flex-direction: column;
        line-height: 1.3;
    }

    .hotel-full-option small {
        color: #6c757d;
    }

    .hotel-full-option.is-full {
        border-color: #dc3545;
        background: #fff5f5;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Logika SweetAlert Delete
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
                    background: '#fff',
                    customClass: {
                        popup: 'rounded-4',
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

        // Logika Klik Kursi Modal Add
        const addSeats = document.querySelectorAll('#addSeatGrid .admin-seat');
        addSeats.forEach(seat => {
            seat.addEventListener('click', function() {
                this.classList.toggle('occupied');
                const occupiedArray = [];
                document.querySelectorAll('#addSeatGrid .admin-seat.occupied').forEach(s => {
                    occupiedArray.push(s.getAttribute('data-seat'));
                });
                document.getElementById('add_occupied_seats_input').value = occupiedArray.join(',');
            });
        });

        // Logika Klik Kursi Modal Edit (Looping Sejenis Aman)
        const editGrids = document.querySelectorAll('.edit-seat-grid');
        editGrids.forEach(grid => {
            const destId = grid.getAttribute('data-id');
            const seats = grid.querySelectorAll('.admin-seat');
            const hiddenInput = document.getElementById('edit_occupied_seats_input_' + destId);
            
            seats.forEach(seat => {
                seat.addEventListener('click', function() {
                    this.classList.toggle('occupied');
                    const occupiedArray = [];
                    grid.querySelectorAll('.admin-seat.occupied').forEach(s => {
                        occupiedArray.push(s.getAttribute('data-seat'));
                    });
                    hiddenInput.value = occupiedArray.join(',');
                });
            });
        });

        document.querySelectorAll('.hotel-full-option input').forEach(input => {
            input.addEventListener('change', function() {
                this.closest('.hotel-full-option').classList.toggle('is-full', this.checked);
            });
        });
    });
</script>
@endsection
