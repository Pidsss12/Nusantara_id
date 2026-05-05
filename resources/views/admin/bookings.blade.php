@extends('layouts.admin')

@section('title', 'Bookings')
@section('page-title', 'Manage Bookings')
@section('page-subtitle', 'View and manage all booking requests')

@section('content')
<!-- session success handled by layout -->

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 bg-success text-white">
            <div class="card-body">
                <h6 class="opacity-75">Confirmed</h6>
                <h3 class="fw-bold">{{ $stats['confirmed'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 bg-warning text-white">
            <div class="card-body">
                <h6 class="opacity-75">Pending</h6>
                <h3 class="fw-bold">{{ $stats['pending'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 bg-danger text-white">
            <div class="card-body">
                <h6 class="opacity-75">Cancelled</h6>
                <h3 class="fw-bold">{{ $stats['cancelled'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 bg-info text-white">
            <div class="card-body">
                <h6 class="opacity-75">Total Revenue</h6>
                <h3 class="fw-bold">Rp {{ number_format($stats['total_revenue'] / 1000000, 1) }}M</h3>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-body">
        <form action="{{ route('admin.bookings') }}" method="GET" class="row g-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search booking ID or customer..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="destination_id" class="form-select">
                    <option value="">All Destinations</option>
                    @foreach($destinations as $dest)
                    <option value="{{ $dest->id }}" {{ request('destination_id') == $dest->id ? 'selected' : '' }}>{{ $dest->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}" placeholder="From Date">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success rounded-pill me-2"><i class="bi bi-search"></i> Filter</button>
                <a href="{{ route('admin.bookings') }}" class="btn btn-outline-secondary rounded-pill"><i class="bi bi-x-lg"></i> Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Bookings Table -->
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-4">Booking ID</th>
                        <th class="border-0">Customer</th>
                        <th class="border-0">Destination</th>
                        <th class="border-0">Package</th>
                        <th class="border-0">Date</th>
                        <th class="border-0">Pax</th>
                        <th class="border-0">Amount</th>
                        <th class="border-0">Status</th>
                        <th class="border-0">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td class="px-4 fw-bold text-primary">#{{ $booking->booking_code }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px; font-size: 12px;">
                                    {{ strtoupper(substr($booking->customer_name, 0, 2)) }}
                                </div>
                                <div>
                                    <span class="d-block fw-medium">{{ $booking->customer_name }}</span>
                                    <small class="text-muted">{{ $booking->customer_email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $booking->destination->name ?? '-' }}</td>
                        <td><span class="badge bg-primary-subtle text-primary">{{ $booking->package->name ?? 'No Package' }}</span></td>
                        <td>{{ $booking->visit_date->format('d M Y') }}</td>
                        <td><span class="badge bg-secondary">{{ $booking->participants }}</span></td>
                        <td class="fw-bold text-success">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                        <td><span class="badge bg-{{ $booking->status == 'Confirmed' ? 'success' : ($booking->status == 'Pending' ? 'warning' : 'danger') }}">{{ $booking->status }}</span></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewBooking{{ $booking->id }}" title="View"><i class="bi bi-eye"></i></button>
                                @if($booking->status == 'Pending')
                                <form action="{{ route('admin.bookings.status', $booking) }}" method="POST" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="Confirmed">
                                    <button type="submit" class="btn btn-outline-success btn-sm" title="Confirm"><i class="bi bi-check"></i></button>
                                </form>
                                @endif
                                @if($booking->status != 'Cancelled')
                                <form action="{{ route('admin.bookings.status', $booking) }}" method="POST" style="display:inline;" class="action-form">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="Cancelled">
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-action-confirm" title="Cancel"><i class="bi bi-x"></i></button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">No bookings found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($bookings->hasPages())
    <div class="card-footer">
        {{ $bookings->appends(request()->query())->links() }}
    </div>
    @endif
</div>

<!-- View Booking Modals -->
@foreach($bookings as $booking)
<div class="modal fade" id="viewBooking{{ $booking->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="bi bi-eye me-2"></i>Booking #{{ $booking->booking_code }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless">
                    <tr><th width="40%">Customer</th><td>{{ $booking->customer_name }}</td></tr>
                    <tr><th>Email</th><td>{{ $booking->customer_email }}</td></tr>
                    <tr><th>Phone</th><td>{{ $booking->customer_phone ?? '-' }}</td></tr>
                    <tr><th>Institution</th><td>{{ $booking->institution ?? '-' }}</td></tr>
                    <tr><th>Destination</th><td>{{ $booking->destination->name ?? '-' }}</td></tr>
                    <tr><th>Package</th><td>{{ $booking->package->name ?? 'No Package' }}</td></tr>
                    <tr><th>Visit Date</th><td>{{ $booking->visit_date->format('d M Y') }}</td></tr>
                    <tr><th>Participants</th><td>{{ $booking->participants }} orang</td></tr>
                    <tr><th>Total Amount</th><td class="fw-bold text-success">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td></tr>
                    <tr><th>Status</th><td><span class="badge bg-{{ $booking->status == 'Confirmed' ? 'success' : ($booking->status == 'Pending' ? 'warning' : 'danger') }}">{{ $booking->status }}</span></td></tr>
                    <tr><th>Notes</th><td>{{ $booking->notes ?? '-' }}</td></tr>
                    <tr><th>Created</th><td>{{ $booking->created_at->format('d M Y H:i') }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const confirmButtons = document.querySelectorAll('.btn-action-confirm');
        confirmButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('.action-form');
                const action = this.title || 'perform this action';
                
                Swal.fire({
                    title: action + '?',
                    text: "Are you sure you want to " + action.toLowerCase() + " this booking?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, ' + action.toLowerCase() + '!',
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
