@extends('layouts.user')

@section('title', 'My Bookings')
@section('page-title', 'My Bookings')
@section('page-subtitle', 'View and manage your booking history')

@section('styles')
<style>
    .btn-premium-action {
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 800;
        padding: 10px 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        min-width: 140px;
    }

    .btn-premium-success {
        background: rgba(25, 135, 84, 0.18);
        color: #115e3b;
        border: 2px solid rgba(25, 135, 84, 0.4);
    }

    .btn-premium-success:hover {
        background: #198754;
        border-color: #198754;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(25, 135, 84, 0.25);
    }

    .btn-premium-danger {
        background: rgba(220, 53, 69, 0.18);
        color: #b02a37;
        border: 2px solid rgba(220, 53, 69, 0.4);
    }

    .btn-premium-danger:hover {
        background: #dc3545;
        border-color: #dc3545;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(220, 53, 69, 0.25);
    }

    .booking-stat-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }
</style>
@endsection

@section('content')
<!-- session success/error handled by global swal in layout -->

<!-- Filters -->
<div class="premium-card p-4 mb-4">
    <form action="{{ route('user.bookings') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-md-3">
            <p class="mb-2 small fw-bold text-uppercase opacity-75" style="letter-spacing: 1px; font-size: 0.7rem;">Booking Status</p>
            <select name="status" class="form-select border-0 shadow-sm rounded-3 py-2 px-3" style="background: rgba(255,255,255,0.8);">
                <option value="">All Status</option>
                <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div class="col-md-3">
            <p class="mb-2 small fw-bold text-uppercase opacity-75" style="letter-spacing: 1px; font-size: 0.7rem;">From Date</p>
            <input type="date" name="date_from" class="form-control border-0 shadow-sm rounded-3 py-2 px-3" value="{{ request('date_from') }}" style="background: rgba(255,255,255,0.8);">
        </div>
        <div class="col-md-3">
            <p class="mb-2 small fw-bold text-uppercase opacity-75" style="letter-spacing: 1px; font-size: 0.7rem;">To Date</p>
            <input type="date" name="date_to" class="form-control border-0 shadow-sm rounded-3 py-2 px-3" value="{{ request('date_to') }}" style="background: rgba(255,255,255,0.8);">
        </div>
        <div class="col-md-3">
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success rounded-pill px-4 py-2 fw-bold shadow-sm" style="min-width: 120px;"><i class="bi bi-search me-2"></i>Filter</button>
                <a href="{{ route('user.bookings') }}" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-muted border shadow-sm" style="min-width: 120px;"><i class="bi bi-arrow-counterclockwise me-2"></i>Reset</a>
            </div>
        </div>
    </form>
</div>

<!-- Bookings List -->
<div class="row g-4">
    @forelse($bookings as $booking)
    <div class="col-lg-6">
        <div class="premium-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h6 class="fw-bold mb-1" style="color: var(--text-title); font-size: 1rem;">{{ optional($booking->destination)->name ?? 'Destinasi tidak ditemukan' }}</h6>
                    <span class="badge rounded-pill px-2 py-1" style="background: rgba(0,0,0,0.06); color: #475569; font-size: 0.65rem; font-family: monospace;">#{{ $booking->booking_code }}</span>
                </div>
                <span class="badge rounded-pill px-3 py-2 fw-bold text-uppercase" style="background: {{ $booking->status == 'Confirmed' ? 'rgba(25, 135, 84, 0.1)' : ($booking->status == 'Pending' ? 'rgba(255, 193, 7, 0.1)' : 'rgba(220, 53, 69, 0.1)') }}; color: {{ $booking->status == 'Confirmed' ? '#198754' : ($booking->status == 'Pending' ? '#e6a800' : '#dc3545') }}; font-size: 0.65rem; letter-spacing: 0.5px; border: 1px solid rgba(0,0,0,0.05);">
                    {{ $booking->status }}
                </span>
            </div>
            
            <div class="row g-3 mb-4">
                <div class="col-6">
                    <div class="d-flex align-items-center gap-3">
                        <div class="booking-stat-icon" style="background: rgba(25, 135, 84, 0.1); color: var(--primary-green);">
                            <i class="bi bi-calendar3 fs-5"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Visit Date</small>
                            <span class="fw-bold" style="font-size: 0.9rem; color: var(--text-title);">{{ $booking->visit_date ? $booking->visit_date->format('d M Y') : '-' }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center gap-3">
                        <div class="booking-stat-icon" style="background: rgba(13, 110, 253, 0.1); color: #0d6efd;">
                            <i class="bi bi-people fs-5"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Participants</small>
                            <span class="fw-bold" style="font-size: 0.9rem; color: var(--text-title);">{{ $booking->participants }} Pax</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted d-block" style="font-size: 0.7rem;">Total Amount</small>
                    <h5 class="fw-bold text-success mb-0">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</h5>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-premium-action btn-premium-success" data-bs-toggle="modal" data-bs-target="#detailModal{{ $booking->id }}">
                        <i class="bi bi-info-circle"></i> Details
                    </button>
                    @if(in_array($booking->status, ['Pending', 'Confirmed']))
                    <form action="{{ route('user.bookings.cancel', $booking) }}" method="POST" class="cancel-form d-inline-block">
                        @csrf @method('PATCH')
                        <button type="button" class="btn btn-premium-action btn-premium-danger btn-cancel">
                            <i class="bi bi-x-circle"></i> Cancel
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal{{ $booking->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 30px; overflow: hidden;">
                <div class="modal-header border-0 px-4 pt-4 pb-0">
                    <h5 class="modal-title fw-bold" style="color: var(--text-title);"><i class="bi bi-file-text me-2 text-success"></i>Booking Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
                        <tr><th width="40%">Booking Code</th><td>#{{ $booking->booking_code }}</td></tr>
                        <tr><th>Destination</th><td>{{ $booking->destination->name }}</td></tr>
                        <tr><th>Package</th><td>{{ $booking->package->name ?? 'No Package' }}</td></tr>
                        <tr><th>Visit Date</th><td>{{ $booking->visit_date->format('d M Y') }}</td></tr>
                        <tr><th>Participants</th><td>{{ $booking->participants }} orang</td></tr>
                        <tr><th>Institution</th><td>{{ $booking->institution ?? '-' }}</td></tr>
                        <tr><th>Total Amount</th><td class="fw-bold text-success">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td></tr>
                        <tr><th>Status</th><td><span class="badge bg-{{ $booking->status == 'Confirmed' ? 'success' : ($booking->status == 'Pending' ? 'warning' : 'danger') }}">{{ $booking->status }}</span></td></tr>
                        <tr><th>Notes</th><td>{{ $booking->notes ?? '-' }}</td></tr>
                        <tr><th>Booked At</th><td>{{ $booking->created_at->format('d M Y H:i') }}</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted"></i>
                <h5 class="mt-3 mb-2">No Bookings Found</h5>
                <p class="text-muted mb-3">You haven't made any bookings yet. Start exploring Indonesia's beautiful ecotourism destinations!</p>
                <a href="{{ route('destinations.index') }}" class="btn btn-success rounded-pill">
                    <i class="bi bi-compass me-2"></i>Explore Destinations
                </a>
            </div>
        </div>
    </div>
    @endforelse
</div>

@if($bookings->hasPages())
<div class="mt-4">
    {{ $bookings->appends(request()->query())->links() }}
</div>
@endif
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cancelButtons = document.querySelectorAll('.btn-cancel');
        cancelButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('.cancel-form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this booking!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel it!',
                    cancelButtonText: 'No, keep it',
                    background: 'rgba(255, 255, 255, 0.95)',
                    backdrop: `rgba(0,0,0,0.4)`,
                    customClass: {
                        popup: 'premium-card',
                        title: 'fw-bold text-title',
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
