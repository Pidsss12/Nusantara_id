@extends('layouts.admin')

@section('title', 'Bookings')
@section('page-title', 'Manage Bookings')
@section('page-subtitle', 'View and manage all booking requests')

@section('content')
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
                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success rounded-pill me-2"><i class="bi bi-search"></i> Filter</button>
                <a href="{{ route('admin.bookings') }}" class="btn btn-outline-secondary rounded-pill"><i class="bi bi-x-lg"></i> Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch; width: 100%;">
            <table class="table table-hover mb-0" style="white-space: nowrap; min-width: 1000px;">
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
                        <th class="border-0">Payment</th>
                        <th class="border-0 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td class="px-4 fw-bold" style="color: #1abc9c;">#{{ $booking->booking_code }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px; font-size: 11px; flex-shrink: 0;">
                                    {{ strtoupper(substr($booking->customer_name, 0, 2)) }}
                                </div>
                                <div>
                                    <span class="d-block fw-medium">{{ $booking->customer_name }}</span>
                                    <small class="text-muted">{{ $booking->customer_email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $booking->destination->name ?? '-' }}</td>
                        <td><span class="badge border-0" style="background-color: rgba(26, 188, 156, 0.15); color: #1abc9c;">{{ $booking->package->name ?? 'No Package' }}</span></td>
                        <td>{{ $booking->visit_date->format('d M Y') }}</td>
                        <td><span class="badge bg-secondary">{{ $booking->participants }}</span></td>
                        <td class="fw-bold text-success">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge rounded-pill bg-{{ $booking->status == 'Confirmed' ? 'success' : ($booking->status == 'Pending' ? 'warning text-dark' : 'danger') }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td>
                            <span class="badge rounded-pill bg-{{ $booking->payment_status == 'Paid' ? 'success' : ($booking->payment_status == 'Pending' ? 'info' : 'secondary') }}">
                                {{ $booking->payment_status }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm rounded-3 d-flex align-items-center justify-content-center" 
                                        style="width: 32px; height: 32px; border: 1.5px solid #1abc9c; color: #1abc9c; background: transparent;"
                                        data-bs-toggle="modal" data-bs-target="#viewBooking{{ $booking->id }}" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>

                                @if($booking->status == 'Pending')
                                <form action="{{ route('admin.bookings.status', $booking) }}" method="POST" class="confirm-status-form">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="Confirmed">
                                    <button type="button" class="btn btn-sm rounded-3 d-flex align-items-center justify-content-center btn-confirm-status" 
                                            style="width: 32px; height: 32px; border: 1.5px solid #198754; color: #198754; background: transparent;"
                                            title="Confirm">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                                @endif

                                @if($booking->status != 'Cancelled')
                                <form action="{{ route('admin.bookings.status', $booking) }}" method="POST" class="cancel-status-form">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="Cancelled">
                                    <button type="button" class="btn btn-sm rounded-3 d-flex align-items-center justify-content-center btn-cancel-status" 
                                            style="width: 32px; height: 32px; border: 1.5px solid #dc3545; color: #dc3545; background: transparent;"
                                            title="Cancel">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </form>
                                @endif
                            </div>

                            <div class="modal fade" id="viewBooking{{ $booking->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg rounded-4">
                                        <div class="modal-header border-0 bg-light rounded-top-4 px-4">
                                            <h5 class="modal-title fw-bold">Detail Pesanan #{{ $booking->booking_code }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4 text-start" style="white-space: normal;">
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <small class="text-muted d-block">Pelanggan</small>
                                                    <span class="fw-bold">{{ $booking->customer_name }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted d-block">Destinasi</small>
                                                    <span class="fw-bold">{{ $booking->destination->name ?? '-' }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted d-block">Tanggal Kunjungan</small>
                                                    <span class="fw-bold">{{ $booking->visit_date->format('d M Y') }}</span>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted d-block">Jumlah Peserta</small>
                                                    <span class="fw-bold">{{ $booking->participants }} Orang</span>
                                                </div>
                                                 <div class="col-12">
                                                    <hr class="my-2 opacity-10">
                                                    <small class="text-muted d-block mb-2">Informasi Pembayaran</small>
                                                    <div class="bg-light p-3 rounded-3 mt-1">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <small class="text-muted d-block">Metode</small>
                                                                <span class="fw-bold">{{ $booking->payment_method ?? 'Belum dipilih' }}</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <small class="text-muted d-block">Status</small>
                                                                <span class="badge bg-{{ $booking->payment_status == 'Paid' ? 'success' : 'warning text-dark' }}">{{ $booking->payment_status }}</span>
                                                            </div>
                                                            @if($booking->payment_proof)
                                                            <div class="col-12 mt-3">
                                                                <small class="text-muted d-block mb-1">Bukti Transfer</small>
                                                                <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank">
                                                                    <img src="{{ asset('storage/' . $booking->payment_proof) }}" class="img-fluid rounded-3 border" style="max-height: 200px;">
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-4 text-center">
                                                    <h4 class="fw-bold text-success">Total: Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 px-4 pb-4">
                                            @if($booking->payment_status == 'Pending')
                                            <form action="{{ route('admin.bookings.payment-status', $booking) }}" method="POST" class="d-inline">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="payment_status" value="Paid">
                                                <button type="submit" class="btn btn-success rounded-pill px-4">Verifikasi Pembayaran (Lunas)</button>
                                            </form>
                                            @endif
                                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-5 text-muted">No bookings found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle Konfirmasi (Check)
        const confirmButtons = document.querySelectorAll('.btn-confirm-status');
        confirmButtons.forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.confirm-status-form');
                Swal.fire({
                    title: 'Konfirmasi Pesanan?',
                    text: "Pesanan akan ditandai sebagai 'Confirmed'.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Konfirmasi!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Handle Pembatalan (Silang)
        const cancelButtons = document.querySelectorAll('.btn-cancel-status');
        cancelButtons.forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.cancel-status-form');
                Swal.fire({
                    title: 'Batalkan Pesanan?',
                    text: "Apakah Anda yakin ingin membatalkan pesanan ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Batalkan!',
                    cancelButtonText: 'Kembali'
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
@endsection