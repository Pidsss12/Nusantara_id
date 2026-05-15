@extends('layouts.user')

@section('title', 'My Bookings')
@section('page-title', 'My Bookings')
@section('page-subtitle', 'View and manage your booking history')

@section('content')
{{-- 
    Ganti class 'main-content-wrapper' manual dengan 'container-fluid' 
    dan padding standar Bootstrap 'py-4 px-3 px-lg-5'
--}}
<div class="container-fluid py-4 px-3 px-lg-4">

    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4 bg-white">
        <form action="{{ route('user.bookings') }}" method="GET" class="row g-3 align-items-end" id="filterForm">
            <div class="col-md-3">
                <label class="form-label small fw-bold text-uppercase text-muted mb-2" style="letter-spacing: 1px;">Booking Status</label>
                <select name="status" class="form-select border-0 bg-light rounded-3 shadow-none" style="height: 48px;">
                    <option value="">All Status</option>
                    <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold text-uppercase text-muted mb-2" style="letter-spacing: 1px;">From Date</label>
                <input type="date" name="date_from" class="form-control border-0 bg-light rounded-3 shadow-none" value="{{ request('date_from') }}" style="height: 48px;">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold text-uppercase text-muted mb-2" style="letter-spacing: 1px;">To Date</label>
                <input type="date" name="date_to" class="form-control border-0 bg-light rounded-3 shadow-none" value="{{ request('date_to') }}" style="height: 48px;">
            </div>
            <div class="col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success rounded-3 fw-bold w-100 shadow-sm border-0" style="height: 48px;">
                        <i class="bi bi-search me-2"></i>Filter
                    </button>
                    <button type="button" onclick="window.location.href='{{ route('user.bookings') }}'" class="btn btn-light rounded-3 fw-bold text-muted w-100 border-0" style="height: 48px;">
                        <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row g-4">
        @forelse($bookings as $booking)
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden bg-white">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h6 class="fw-bold mb-1 text-dark fs-5">{{ optional($booking->destination)->name ?? 'Destination Not Found' }}</h6>
                            <span class="badge bg-light text-secondary border rounded-pill px-2">#{{ $booking->booking_code }}</span>
                        </div>
                        @php
                            $statusColor = $booking->status == 'Confirmed' ? 'success' : ($booking->status == 'Pending' ? 'warning' : 'danger');
                        @endphp
                        <span class="badge bg-{{ $statusColor }}-subtle text-{{ $statusColor }} border border-{{ $statusColor }} rounded-pill px-3 py-2 fw-bold text-uppercase" style="font-size: 0.7rem;">
                            {{ $booking->status }}
                        </span>
                    </div>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3 p-2 rounded-3 bg-light-subtle">
                                <div class="bg-success bg-opacity-10 text-success rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                    <i class="bi bi-calendar3 fs-5"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.65rem;">Visit Date</small>
                                    <span class="fw-bold text-dark">{{ $booking->visit_date ? $booking->visit_date->format('d M Y') : '-' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center gap-3 p-2 rounded-3 bg-light-subtle">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                    <i class="bi bi-people fs-5"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.65rem;">Participants</small>
                                    <span class="fw-bold text-dark">{{ $booking->participants }} Pax</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted d-block" style="font-size: 0.75rem;">Total Amount</small>
                            <h4 class="fw-bold text-success mb-0">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</h4>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-success border-2 rounded-pill px-3 fw-bold small text-uppercase" style="font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#detailModal{{ $booking->id }}">
                                <i class="bi bi-info-circle me-1"></i> Details
                            </button>
                            @if(in_array($booking->status, ['Pending', 'Confirmed']))
                            <form action="{{ route('user.bookings.cancel', $booking) }}" method="POST" class="cancel-form d-inline-block">
                                @csrf @method('PATCH')
                                <button type="button" class="btn btn-outline-danger border-2 rounded-pill px-3 fw-bold small text-uppercase btn-cancel" style="font-size: 0.7rem;">
                                    <i class="bi bi-x-circle me-1"></i> Cancel
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="detailModal{{ $booking->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow rounded-4">
                    <div class="modal-header border-0 px-4 pt-4">
                        <h5 class="modal-title fw-bold"><i class="bi bi-file-text me-2 text-success"></i>Booking Details</h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body px-4 pb-4">
                        <div class="bg-light rounded-4 p-3">
                            <table class="table table-borderless mb-0">
                                <tr class="border-bottom border-white"><th class="text-muted fw-normal">Code</th><td class="fw-bold">#{{ $booking->booking_code }}</td></tr>
                                <tr class="border-bottom border-white"><th class="text-muted fw-normal">Destination</th><td class="fw-bold">{{ optional($booking->destination)->name }}</td></tr>
                                <tr class="border-bottom border-white"><th class="text-muted fw-normal">Visit Date</th><td class="fw-bold">{{ $booking->visit_date ? $booking->visit_date->format('d M Y') : '-' }}</td></tr>
                                <tr class="border-bottom border-white"><th class="text-muted fw-normal">Participants</th><td class="fw-bold">{{ $booking->participants }} orang</td></tr>
                                <tr><th class="text-muted fw-normal">Amount</th><td class="fw-bold text-success fs-5">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 text-center py-5">
                <div class="card-body">
                    <i class="bi bi-inbox fs-1 text-muted opacity-25"></i>
                    <h5 class="mt-3 text-dark fw-bold">No Bookings Found</h5>
                    <p class="text-muted">You haven't made any bookings yet.</p>
                    <a href="{{ route('destinations.index') }}" class="btn btn-success rounded-pill px-4 fw-bold">Find Destinations</a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    @if($bookings->hasPages())
    <div class="mt-5 d-flex justify-content-center">
        {{ $bookings->appends(request()->query())->links() }}
    </div>
    @endif

</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cancelButtons = document.querySelectorAll('.btn-cancel');
        cancelButtons.forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.cancel-form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: 'Yes, cancel it!',
                    borderRadius: '20px'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    });
</script>
@endsection