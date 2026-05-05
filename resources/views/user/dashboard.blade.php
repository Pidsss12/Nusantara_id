@extends('layouts.user')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Welcome back, ' . Auth::user()->name . '!')

@section('content')
<!-- Stats Cards -->
<div class="row g-4 mb-5">
    <div class="col-xl-3 col-sm-6">
        <div class="premium-card p-4" style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%); border: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 1px;">Total Bookings</p>
                    <h2 class="mb-0 fw-bold text-white mt-1">{{ $stats['total_bookings'] }}</h2>
                    <div class="mt-2">
                        <span class="badge rounded-pill text-white small" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.1);">
                           All time
                        </span>
                    </div>
                </div>
                <div class="rounded-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.1);">
                    <i class="bi bi-calendar-check fs-2 text-white"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6">
        <div class="premium-card p-4" style="background: linear-gradient(135deg, rgba(25, 135, 84, 0.9) 0%, rgba(32, 201, 151, 0.9) 100%); border: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 1px;">Confirmed</p>
                    <h2 class="mb-0 fw-bold text-white mt-1">{{ $stats['confirmed_bookings'] }}</h2>
                    <div class="mt-2">
                        <span class="badge rounded-pill text-white small" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.1);">
                           Ready to go
                        </span>
                    </div>
                </div>
                <div class="rounded-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.1);">
                    <i class="bi bi-check-circle fs-2 text-white"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6">
        <div class="premium-card p-4" style="background: linear-gradient(135deg, rgba(255, 193, 7, 0.9) 0%, rgba(255, 152, 0, 0.9) 100%); border: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 1px;">Pending</p>
                    <h2 class="mb-0 fw-bold text-white mt-1">{{ $stats['pending_bookings'] }}</h2>
                    <div class="mt-2">
                        <span class="badge rounded-pill text-white small" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.1);">
                           Awaiting
                        </span>
                    </div>
                </div>
                <div class="rounded-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.1);">
                    <i class="bi bi-clock-history fs-2 text-white"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6">
        <div class="premium-card p-4" style="background: linear-gradient(135deg, rgba(13, 202, 240, 0.9) 0%, rgba(13, 110, 253, 0.9) 100%); border: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 1px;">Total Spent</p>
                    <h2 class="mb-0 fw-bold text-white mt-1">Rp {{ number_format($stats['total_spent'] / 1000000, 1) }}M</h2>
                    <div class="mt-2">
                        <span class="badge rounded-pill text-white small" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.1);">
                           Investment
                        </span>
                    </div>
                </div>
                <div class="rounded-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.1);">
                    <i class="bi bi-wallet2 fs-2 text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Interactive Map Section -->
<div class="premium-card p-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0" style="color: var(--text-title)"><i class="bi bi-map-fill text-success me-2"></i>Explore Ecotourism</h5>
        <div class="d-flex gap-2">
            <select id="provinceFilter" class="form-select form-select-sm premium-card border-0 py-2 px-3 shadow-none" style="width: auto;">
                <option value="">All Provinces</option>
            </select>
            <select id="categoryFilter" class="form-select form-select-sm premium-card border-0 py-2 px-3 shadow-none" style="width: auto;">
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
    <style>
        .marker-dot {
            width: 12px;
            height: 12px;
            background: #198754;
            border: 2px solid white;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
        }
        .marker-pulse {
            width: 30px;
            height: 30px;
            background: rgba(25, 135, 84, 0.4);
            border-radius: 50%;
            animation: pulse-marker 2s infinite;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
        }
        @keyframes pulse-marker {
            0% { transform: translate(-50%, -50%) scale(0.5); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(2); opacity: 0; }
        }
        .premium-popup .leaflet-popup-content-wrapper {
            border-radius: 15px;
            padding: 5px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
    </style>
    <div id="indonesiaMap" style="height: 450px; border-radius: 20px; z-index: 1;"></div>
    <div class="mt-3">
        <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Exploring <strong>38 Provinces</strong> across the Indonesian Archipelago.</small>
    </div>
</div>

<!-- Upcoming Trips and Recent Bookings -->
<div class="row g-4">
    <!-- Upcoming Trips -->
    <div class="col-lg-6">
        <div class="premium-card p-4 h-100">
            <h6 class="fw-bold mb-4" style="color: var(--text-title)"><i class="bi bi-calendar-event-fill text-success me-2"></i>Upcoming Trips</h6>
            <div class="pe-2" style="max-height: 400px; overflow-y: auto;">
                @forelse($upcomingBookings as $booking)
                <div class="d-flex align-items-center mb-4 p-3 rounded-4" style="background: rgba(25, 135, 84, 0.03); border: 1px solid rgba(25, 135, 84, 0.05);">
                    <div class="rounded-4 p-3 me-3 text-center d-flex flex-column justify-content-center" style="min-width: 65px; height: 65px; background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%); color: white;">
                        <span class="fs-5 fw-bold lh-1">{{ $booking->visit_date->format('d') }}</span>
                        <small style="font-size: 0.65rem; text-uppercase; opacity: 0.8;">{{ $booking->visit_date->format('M') }}</small>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1 fw-bold" style="color: var(--text-title)">{{ $booking->destination->name }}</h6>
                        <div class="d-flex align-items-center gap-2">
                            <small class="text-muted"><i class="bi bi-people me-1"></i>{{ $booking->participants }} pax</small>
                            <span class="badge rounded-pill" style="background: rgba(25, 135, 84, 0.1); color: var(--primary-green); font-size: 0.65rem;">{{ $booking->status }}</span>
                        </div>
                    </div>
                    <a href="{{ route('user.bookings') }}" class="btn btn-sm px-3 rounded-pill text-white" style="background: var(--primary-green); font-size: 0.75rem;">Details</a>
                </div>
                @empty
                <div class="text-center py-5 text-muted">
                    <div class="rounded-pill p-3 bg-light d-inline-block mb-3">
                        <i class="bi bi-calendar-x fs-1 opacity-50"></i>
                    </div>
                    <p class="mb-3">No upcoming trips planned</p>
                    <a href="{{ route('destinations.index') }}" class="btn btn-success rounded-pill px-4">Book Now</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Recent Bookings -->
    <div class="col-lg-6">
        <div class="premium-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-bold mb-0" style="color: var(--text-title)"><i class="bi bi-clock-history text-success me-2"></i>Recent Bookings</h6>
                <a href="{{ route('user.bookings') }}" class="text-success text-decoration-none small fw-bold">View All <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
            <div class="pe-2" style="max-height: 400px; overflow-y: auto;">
                @forelse($recentBookings as $booking)
                <div class="d-flex justify-content-between align-items-center mb-4 p-3 rounded-4" style="background: rgba(0,0,0,0.02);">
                    <div class="d-flex align-items-center">
                        <div class="rounded-3 p-3 me-3 text-success" style="background: rgba(25, 135, 84, 0.1);">
                            <i class="bi bi-journal-check fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold" style="color: var(--text-title)">#{{ $booking->booking_code }}</h6>
                            <small class="text-muted d-block">{{ $booking->destination->name }}</small>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="fw-bold text-success mb-1">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</div>
                        <span class="badge rounded-pill px-3" style="background: {{ $booking->status == 'Confirmed' ? 'rgba(25, 135, 84, 0.1)' : ($booking->status == 'Pending' ? 'rgba(255, 193, 7, 0.1)' : 'rgba(220, 53, 69, 0.1)') }}; color: {{ $booking->status == 'Confirmed' ? '#198754' : ($booking->status == 'Pending' ? '#ffc107' : '#dc3545') }}; font-size: 0.7rem;">
                            {{ $booking->status }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 text-muted">
                    <div class="rounded-pill p-3 bg-light d-inline-block mb-3">
                        <i class="bi bi-inbox fs-1 opacity-50"></i>
                    </div>
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
// Initialize map with vibrant colors
var map = L.map('indonesiaMap').setView([-2.5, 118], 5);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
    maxZoom: 18
}).addTo(map);

// Custom Premium Marker Styles
var activeIcon = L.divIcon({
    className: 'premium-marker active',
    html: '<div class="marker-pulse"></div><div class="marker-dot"></div>',
    iconSize: [20, 20],
    iconAnchor: [10, 10]
});

var staticIcon = L.divIcon({
    className: 'premium-marker',
    html: '<div class="marker-dot"></div>',
    iconSize: [20, 20],
    iconAnchor: [10, 10]
});

// Marker cluster group
var markers = L.markerClusterGroup({
    maxClusterRadius: 60,
    spiderfyOnMaxZoom: true,
    showCoverageOnHover: false
});

// Destinations data from backend
var backendDestinations = @json($destinations);

// 38 Provinces of Indonesia coordinates
var provinces = [
    {id: 1, name: 'Aceh', lat: 4.6951, lng: 96.7494},
    {id: 2, name: 'Sumatera Utara', lat: 2.1121, lng: 99.3923},
    {id: 3, name: 'Sumatera Barat', lat: -0.7399, lng: 100.8000},
    {id: 4, name: 'Riau', lat: 0.5071, lng: 101.5471},
    {id: 5, name: 'Jambi', lat: -1.6101, lng: 103.6131},
    {id: 6, name: 'Sumatera Selatan', lat: -3.3194, lng: 104.9145},
    {id: 7, name: 'Bengkulu', lat: -3.7928, lng: 102.2608},
    {id: 8, name: 'Lampung', lat: -4.5586, lng: 105.4068},
    {id: 9, name: 'Bangka Belitung', lat: -2.7410, lng: 106.4406},
    {id: 10, name: 'Kepulauan Riau', lat: 3.9456, lng: 108.1400},
    {id: 11, name: 'DKI Jakarta', lat: -6.2088, lng: 106.8456},
    {id: 12, name: 'Jawa Barat', lat: -7.0909, lng: 107.6689},
    {id: 13, name: 'Jawa Tengah', lat: -7.1510, lng: 110.1403},
    {id: 14, name: 'DI Yogyakarta', lat: -7.7956, lng: 110.3695},
    {id: 15, name: 'Jawa Timur', lat: -7.7231, lng: 112.7329},
    {id: 16, name: 'Banten', lat: -6.4058, lng: 106.0600},
    {id: 17, name: 'Bali', lat: -8.3405, lng: 115.0920},
    {id: 18, name: 'Nusa Tenggara Barat', lat: -8.6529, lng: 117.3616},
    {id: 19, name: 'Nusa Tenggara Timur', lat: -8.6574, lng: 121.0794},
    {id: 20, name: 'Kalimantan Barat', lat: 0.0000, lng: 110.0000},
    {id: 21, name: 'Kalimantan Tengah', lat: -1.6815, lng: 113.3824},
    {id: 22, name: 'Kalimantan Selatan', lat: -3.3194, lng: 114.5907},
    {id: 23, name: 'Kalimantan Timur', lat: 0.5387, lng: 116.4194},
    {id: 24, name: 'Kalimantan Utara', lat: 3.0765, lng: 116.2159},
    {id: 25, name: 'Sulawesi Utara', lat: 0.6247, lng: 123.9750},
    {id: 26, name: 'Sulawesi Tengah', lat: -1.4300, lng: 121.4456},
    {id: 27, name: 'Sulawesi Selatan', lat: -3.9722, lng: 119.8159},
    {id: 28, name: 'Sulawesi Tenggara', lat: -4.1449, lng: 122.1746},
    {id: 29, name: 'Gorontalo', lat: 0.6999, lng: 122.4467},
    {id: 30, name: 'Sulawesi Barat', lat: -2.8441, lng: 119.2321},
    {id: 31, name: 'Maluku', lat: -3.2385, lng: 130.1453},
    {id: 32, name: 'Maluku Utara', lat: 1.5700, lng: 127.8000},
    {id: 33, name: 'Papua Barat', lat: -1.3361, lng: 133.1747},
    {id: 34, name: 'Papua', lat: -4.2699, lng: 138.0804},
    {id: 35, name: 'Papua Selatan', lat: -7.0000, lng: 139.0000},
    {id: 36, name: 'Papua Tengah', lat: -4.0000, lng: 136.0000},
    {id: 37, name: 'Papua Pegunungan', lat: -4.0000, lng: 139.0000},
    {id: 38, name: 'Papua Barat Daya', lat: -1.0000, lng: 132.0000}
];

var allMarkers = [];

// Helper to get destination for a province or use default
function getMarkerData(province) {
    var match = backendDestinations.find(d => d.province && d.province.name === province.name);
    if (match) {
        return {
            id: match.id,
            name: match.name,
            lat: parseFloat(match.latitude),
            lng: parseFloat(match.longitude),
            category: match.category,
            price: match.price,
            rating: match.rating || '4.8',
            desc: match.description ? match.description.substring(0, 80) : 'Premium ecotourism destination in ' + province.name
        };
    }
    return {
        id: 'p' + province.id,
        name: 'Explore ' + province.name,
        lat: province.lat,
        lng: province.lng,
        category: 'Nature',
        price: 500000,
        rating: '4.7',
        desc: 'Beautiful nature and ecotourism spot waiting to be explored in ' + province.name + '.'
    };
}

provinces.forEach(function(prov) {
    var data = getMarkerData(prov);
    var isReal = !data.id.toString().startsWith('p');
    
    // Use active pulse for real destinations, static green for others
    var marker = L.marker([prov.lat, prov.lng], {
        icon: isReal ? activeIcon : staticIcon,
        zIndexOffset: isReal ? 1000 : 500
    }).addTo(map);
    
    var popupContent = `
        <div style="min-width: 220px; font-family: 'Outfit', sans-serif; padding: 5px;">
            <div style="position: relative; overflow: hidden; border-radius: 12px; margin-bottom: 12px;">
                <img src="https://picsum.photos/seed/prov${prov.id}/400/250" style="width: 100%; height: 130px; object-fit: cover;">
                <div style="position: absolute; top: 10px; right: 10px; background: #fff; padding: 2px 8px; border-radius: 8px; font-size: 0.7rem; font-weight: 800; color: #198754; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    ${isReal ? '⭐ ' + data.rating : '📍 ' + prov.name}
                </div>
            </div>
            <h6 style="margin: 0 0 5px 0; font-weight: 700; color: #1e293b; font-size: 1rem;">${data.name}</h6>
            <p style="font-size: 0.75rem; color: #64748b; margin-bottom: 15px; line-height: 1.5;">
                ${isReal ? data.desc : 'Discover natural beauty in ' + prov.name + '.'}
            </p>
            <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 10px; border-top: 1px solid #f1f5f9;">
                <div>
                    <small style="color: #94a3b8; font-size: 0.6rem; display: block;">Starting from</small>
                    <span style="font-weight: 800; color: #198754; font-size: 1rem;">
                        Rp ${new Intl.NumberFormat('id-ID').format(data.price)}
                    </span>
                </div>
                ${isReal ? `
                <a href="/destination/${data.id}" 
                   style="background: #198754; color: white; padding: 7px 15px; border-radius: 10px; text-decoration: none; font-size: 0.7rem; font-weight: 600; box-shadow: 0 4px 12px rgba(25, 135, 84, 0.2);">
                    Explore
                </a>` : ''}
            </div>
        </div>
    `;
    
    marker.bindPopup(popupContent, {maxWidth: 300, className: 'premium-popup'});
    marker.provName = prov.name;
    marker.category = data.category;
    allMarkers.push(marker);
});

// Fix for filtering markers that are added directly to map
function filterMarkers() {
    var selectedProvince = $('#provinceFilter').val();
    var selectedCategory = $('#categoryFilter').val();
    
    var visible = 0;
    allMarkers.forEach(function(marker) {
        var matchProvince = !selectedProvince || marker.provName === selectedProvince;
        var matchCategory = !selectedCategory || marker.category === selectedCategory;
        
        if (matchProvince && matchCategory) {
            marker.addTo(map);
            visible++;
        } else {
            map.removeLayer(marker);
        }
    });
    
    if (selectedProvince || selectedCategory) {
        var group = L.featureGroup(allMarkers.filter(m => map.hasLayer(m)));
        if (group.getLayers().length > 0) {
            map.fitBounds(group.getBounds(), {padding: [50, 50]});
        }
    }
}

// Refresh map layout
setTimeout(() => { 
    map.invalidateSize();
    if (allMarkers.length > 0) {
        var group = L.featureGroup(allMarkers);
        map.fitBounds(group.getBounds(), {padding: [50, 50]});
    }
}, 800);

// Populate province filter
provinces.forEach(function(p) {
    $('#provinceFilter').append(`<option value="${p.name}">${p.name}</option>`);
});

// Filter functionality
function filterMarkers() {
    var selectedProvince = $('#provinceFilter').val();
    var selectedCategory = $('#categoryFilter').val();
    
    markers.clearLayers();
    var filteredMarkers = allMarkers.filter(function(marker) {
        var matchProvince = !selectedProvince || marker.provName === selectedProvince;
        return matchProvince; // Category filter can be added if needed butprov list is main focus
    });
    
    filteredMarkers.forEach(function(marker) {
        markers.addLayer(marker);
    });
    
    $('#markerCount').text(filteredMarkers.length);
    
    if (filteredMarkers.length > 0) {
        map.fitBounds(markers.getBounds(), {padding: [50, 50]});
    }
}

$('#provinceFilter, #categoryFilter').on('change', filterMarkers);

// Initial marker count
$('#markerCount').text(allMarkers.length);
</script>
@endsection
