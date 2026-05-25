@extends('layouts.user')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Welcome back, ' . Auth::user()->name . '!')

@section('content')
<style>
    .premium-card {
        border-radius: 24px;
        border: none;
        overflow: hidden;
        height: 100%;
        transition: transform 0.3s ease;
    }
    .premium-card:hover {
        transform: translateY(-5px);
    }

    .stat-card {
        min-height: 180px; 
        padding: 1.5rem !important;
        display: flex;
        align-items: center;
    }

    .stat-main-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .stat-info-container {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 130px; 
    }

    .label-area {
        height: 35px; 
        display: flex;
        align-items: flex-start;
    }

    .stat-label {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin: 0;
        line-height: 1.2;
    }

    .number-area {
        height: 60px;
        display: flex;
        align-items: flex-end; 
        margin-bottom: 5px;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        line-height: 0.9;
        margin: 0;
    }

    .stat-number-small {
        font-size: 1.8rem; 
    }

    .stat-badge {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 5px 12px;
        font-size: 0.7rem;
        font-weight: 600;
        color: white;
        border-radius: 50px;
        width: fit-content;
    }

    /* BACKGROUND PUTIH DIHAPUS DISINI */
    .icon-box {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        /* Properti background, border, dan blur dibuang agar menyatu */
    }

    /* Map Markers */
    .marker-dot {
        width: 12px; height: 12px; background: #198754;
        border: 2px solid white; border-radius: 50%;
        box-shadow: 0 0 10px rgba(0,0,0,0.5); position: absolute;
        left: 50%; top: 50%; transform: translate(-50%, -50%); z-index: 2;
    }
    .marker-pulse {
        width: 30px; height: 30px; background: rgba(25, 135, 84, 0.4);
        border-radius: 50%; animation: pulse-marker 2s infinite;
        position: absolute; left: 50%; top: 50%;
        transform: translate(-50%, -50%); z-index: 1;
    }
    @keyframes pulse-marker {
        0% { transform: translate(-50%, -50%) scale(0.5); opacity: 1; }
        100% { transform: translate(-50%, -50%) scale(2); opacity: 0; }
    }
    .premium-popup .leaflet-popup-content-wrapper {
        border-radius: 15px; padding: 5px; box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
</style>

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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-map-fill text-success me-2"></i>Explore Ecotourism</h5>
        <div class="d-flex gap-2">
            <select id="provinceFilter" class="form-select form-select-sm border shadow-none" style="width: auto; border-radius: 10px;">
                <option value="">All Provinces</option>
            </select>
            <select id="categoryFilter" class="form-select form-select-sm border shadow-none" style="width: auto; border-radius: 10px;">
                <option value="">All Categories</option>
                <option value="Pantai">Pantai</option>
                <option value="Gunung">Gunung</option>
                <option value="Danau">Danau</option>
                <option value="Hutan">Hutan</option>
                <option value="Laut">Laut</option>
                <option value="Budaya">Budaya</option>
            </select>
        </div>
    </div>
    <div id="indonesiaMap" style="height: 450px; border-radius: 20px; z-index: 1;"></div>
    <div class="mt-3">
        <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Exploring <strong>38 Provinces</strong> across the Indonesian Archipelago.</small>
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
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('indonesiaMap').setView([-2.5, 118], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var activeIcon = L.divIcon({
        className: 'premium-marker active',
        html: '<div class="marker-pulse"></div><div class="marker-dot"></div>',
        iconSize: [20, 20], iconAnchor: [10, 10]
    });

    var staticIcon = L.divIcon({
        className: 'premium-marker',
        html: '<div class="marker-dot"></div>',
        iconSize: [20, 20], iconAnchor: [10, 10]
    });

    var backendDestinations = @json($destinations);
    var provinces = [
        {id: 1, name: 'Aceh', lat: 4.6951, lng: 96.7494},
        {id: 2, name: 'Sumatera Utara', lat: 2.1121, lng: 99.3923},
        {id: 11, name: 'DKI Jakarta', lat: -6.2088, lng: 106.8456},
        {id: 12, name: 'Jawa Barat', lat: -7.0909, lng: 107.6689},
        {id: 15, name: 'Jawa Timur', lat: -7.7231, lng: 112.7329},
        {id: 17, name: 'Bali', lat: -8.3405, lng: 115.0920}
    ];

    var allMarkers = [];
    var destinationUrlTemplate = @json(route('destination.show', ['id' => '__DESTINATION_ID__']));

    provinces.forEach(function(prov) {
        var match = backendDestinations.find(d => d.province && d.province.name === prov.name);
        var isReal = !!match;
        var data = match || { name: 'Explore ' + prov.name, price: 500000, category: 'Nature' };

        var marker = L.marker([prov.lat, prov.lng], {
            icon: isReal ? activeIcon : staticIcon
        }).addTo(map);

        var popupContent = `
            <div style="min-width: 200px; padding: 5px;">
                <h6 style="margin-bottom: 5px; font-weight: 700;">${data.name}</h6>
                <p style="font-size: 0.75rem; color: #666; margin-bottom: 10px;">Premium ecotourism destination in ${prov.name}.</p>
                <div class="d-flex justify-content-between align-items-center">
                    <span style="font-weight: 800; color: #198754;">Rp ${new Intl.NumberFormat('id-ID').format(data.price)}</span>
                    ${isReal ? `<a href="${destinationUrlTemplate.replace('__DESTINATION_ID__', data.id)}" class="btn btn-sm btn-success py-1 px-2" style="font-size: 0.65rem;">Explore</a>` : ''}
                </div>
            </div>
        `;

        marker.bindPopup(popupContent, {className: 'premium-popup'});
        marker.provName = prov.name;
        marker.category = data.category;
        allMarkers.push(marker);

        $('#provinceFilter').append(`<option value="${prov.name}">${prov.name}</option>`);
    });

    function filterMarkers() {
        var selProv = $('#provinceFilter').val();
        var selCat = $('#categoryFilter').val();
        
        allMarkers.forEach(function(m) {
            var matchP = !selProv || m.provName === selProv;
            var matchC = !selCat || m.category === selCat;
            if (matchP && matchC) { m.addTo(map); } else { map.removeLayer(m); }
        });
    }

    $('#provinceFilter, #categoryFilter').on('change', filterMarkers);

    setTimeout(() => { map.invalidateSize(); }, 800);
});
</script>
@endsection
