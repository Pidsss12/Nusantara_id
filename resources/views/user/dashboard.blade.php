@extends('layouts.user')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Welcome back, ' . Auth::user()->name . '!')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/user-dashboard.css') }}?v={{ filemtime(public_path('css/user-dashboard.css')) }}">
@endsection

@section('content')
<div class="row g-4 mb-5">
    <div class="col-xl-3 col-sm-6">
        <div class="premium-card stat-card" style="background: linear-gradient(135deg, #7e67e1 0%, #5a44b3 100%);">
            <div class="stat-main-wrapper">
                <div class="stat-info-container">
                    <div class="label-area"><p class="stat-label">Total Bookings</p></div>
                    <div class="number-area"><h1 class="stat-number">{{ $stats['total_bookings'] }}</h1></div>
                    <span class="stat-badge">All time</span>
                </div>
                <div class="icon-box"><i class="bi bi-calendar-event text-white" style="font-size: 3.5rem; opacity: 0.8;"></i></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="premium-card stat-card" style="background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);">
            <div class="stat-main-wrapper">
                <div class="stat-info-container">
                    <div class="label-area"><p class="stat-label">Confirmed</p></div>
                    <div class="number-area"><h1 class="stat-number">{{ $stats['confirmed_bookings'] }}</h1></div>
                    <span class="stat-badge">Ready to go</span>
                </div>
                <div class="icon-box"><i class="bi bi-check-circle text-white" style="font-size: 3.5rem; opacity: 0.8;"></i></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="premium-card stat-card" style="background: linear-gradient(135deg, #ffb300 0%, #f39c12 100%);">
            <div class="stat-main-wrapper">
                <div class="stat-info-container">
                    <div class="label-area"><p class="stat-label">Pending</p></div>
                    <div class="number-area"><h1 class="stat-number">{{ $stats['pending_bookings'] }}</h1></div>
                    <span class="stat-badge">Awaiting</span>
                </div>
                <div class="icon-box"><i class="bi bi-clock-history text-white" style="font-size: 3.5rem; opacity: 0.8;"></i></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="premium-card stat-card" style="background: linear-gradient(135deg, #00d2ff 0%, #3a7bd5 100%);">
            <div class="stat-main-wrapper">
                <div class="stat-info-container">
                    <div class="label-area"><p class="stat-label">Total Spent</p></div>
                    <div class="number-area"><h1 class="stat-number stat-number-small">Rp {{ number_format($stats['total_spent'] / 1000000, 1) }}M</h1></div>
                    <span class="stat-badge">Investment</span>
                </div>
                <div class="icon-box"><i class="bi bi-wallet2 text-white" style="font-size: 3.5rem; opacity: 0.8;"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="premium-card bg-white shadow-sm p-4 mb-5" style="border: 1px solid #f1f5f9;">
    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
        <div>
            <h5 class="fw-bold mb-1 text-dark"><i class="bi bi-map-fill text-success me-2"></i>Explore Ecotourism</h5>
            <small id="locationStatus" class="location-status d-none"></small>
        </div>
        <div class="d-flex flex-wrap gap-2 justify-content-end">
            <button type="button" id="locateMeBtn" class="btn btn-success btn-sm rounded-pill px-3 fw-bold">
                <i class="bi bi-crosshair me-1"></i>Lokasi Saya
            </button>
        </div>
    </div>
    <div id="indonesiaMap" style="height: 450px; border-radius: 20px; z-index: 1;"></div>
    <div class="mt-3">
        <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Lihat destinasi ekowisata aktif di seluruh Indonesia.</small>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="premium-card bg-white shadow-sm p-4">
            <h6 class="fw-bold mb-4 text-dark"><i class="bi bi-calendar-event-fill text-success me-2"></i>Upcoming Trips</h6>
            <div class="pe-2" style="max-height: 400px; overflow-y: auto;">
                @forelse($upcomingBookings as $booking)
                <div class="d-flex align-items-center mb-3 p-3 rounded-4 bg-light border border-white">
                    <div class="rounded-4 p-2 me-3 text-center d-flex flex-column justify-content-center" style="min-width: 65px; height: 65px; background: #198754; color: white;">
                        <span class="fs-5 fw-bold lh-1">{{ $booking->visit_date->format('d') }}</span>
                        <small style="font-size: 0.65rem; text-transform: uppercase; opacity: 0.8;">{{ $booking->visit_date->format('M') }}</small>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1 fw-bold text-dark">{{ $booking->destination->name }}</h6>
                        <div class="d-flex align-items-center gap-2">
                            <small class="text-muted"><i class="bi bi-people me-1"></i>{{ $booking->participants }} pax</small>
                            <span class="badge rounded-pill" style="background: rgba(25, 135, 84, 0.1); color: #198754; font-size: 0.65rem;">{{ $booking->status }}</span>
                        </div>
                    </div>
                    <a href="{{ route('user.bookings') }}" class="btn btn-sm btn-success px-3 rounded-pill" style="font-size: 0.75rem;">Details</a>
                </div>
                @empty
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-calendar-x fs-1 opacity-50 d-block mb-3"></i>
                    <p class="mb-3">No upcoming trips planned</p>
                    <a href="{{ route('destinations.index') }}" class="btn btn-success rounded-pill px-4">Book Now</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="premium-card bg-white shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0 text-dark"><i class="bi bi-clock-history text-success me-2"></i>Recent Bookings</h6>
                <a href="{{ route('user.bookings') }}" class="text-success text-decoration-none small fw-bold">View All <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
            <div class="pe-2" style="max-height: 400px; overflow-y: auto;">
                @forelse($recentBookings as $booking)
                <div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-4 bg-light">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-white p-2 me-3 shadow-sm text-success">
                            <i class="bi bi-bag-check fs-5"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold text-dark" style="font-size: 0.9rem;">#{{ $booking->booking_code }}</h6>
                            <small class="text-muted d-block">{{ $booking->destination->name }}</small>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold text-success mb-1" style="font-size: 0.9rem;">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</div>
                        <span class="badge rounded-pill px-3" style="background: {{ $booking->status == 'Confirmed' ? 'rgba(25, 135, 84, 0.1)' : 'rgba(255, 193, 7, 0.1)' }}; color: {{ $booking->status == 'Confirmed' ? '#198754' : '#ffc107' }}; font-size: 0.65rem;">
                            {{ $booking->status }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-inbox fs-1 opacity-50 d-block mb-3"></i>
                    <p class="mb-0">No booking history yet</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    window.NusantaraUserDashboardData = {
        destinations: @json($destinations),
        destinationUrlTemplate: @json(route('destination.show', ['id' => '__DESTINATION_ID__']))
    };
</script>
<script src="{{ asset('js/user-dashboard.js') }}?v={{ filemtime(public_path('js/user-dashboard.js')) }}"></script>
@endsection