@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<!-- Quick Stats -->
<div class="row g-4 mb-5 position-relative" style="z-index: 10;">
    <div class="col-xl-3 col-sm-6">
        <div class="premium-card p-4" style="background: linear-gradient(135deg, rgba(25, 135, 84, 0.8) 0%, rgba(32, 201, 151, 0.8) 100%); border: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 1px;">Total Users</p>
                    <h2 class="mb-0 fw-bold text-white mt-1">2,547</h2>
                    <div class="mt-2">
                        <span class="badge rounded-pill text-white small" style="background: rgba(255, 255, 255, 0.2) !important; backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.1);">
                            <i class="bi bi-arrow-up-right me-1"></i> +12.5%
                        </span>
                        <small class="ms-1 text-white-50" style="font-size: 0.7rem;">since last month</small>
                    </div>
                </div>
                <div class="rounded-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.1);">
                    <i class="bi bi-people-fill fs-2 text-white"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6">
        <div class="premium-card p-4" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.8) 0%, rgba(139, 92, 246, 0.8) 100%); border: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 1px;">Bookings</p>
                    <h2 class="mb-0 fw-bold text-white mt-1">4,892</h2>
                    <div class="mt-2">
                        <span class="badge rounded-pill text-white small" style="background: rgba(255, 255, 255, 0.2) !important; backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.1);">
                            <i class="bi bi-arrow-up-right me-1"></i> +22.0%
                        </span>
                        <small class="ms-1 text-white-50" style="font-size: 0.7rem;">since last month</small>
                    </div>
                </div>
                <div class="rounded-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.1);">
                    <i class="bi bi-journal-check fs-2 text-white"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6">
        <div class="premium-card p-4" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.8) 0%, rgba(251, 191, 36, 0.8) 100%); border: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 1px;">Revenue</p>
                    <h2 class="mb-0 fw-bold text-white mt-1">45.2M</h2>
                    <div class="mt-2">
                        <span class="badge rounded-pill text-white small" style="background: rgba(255, 255, 255, 0.2) !important; backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.1);">
                            <i class="bi bi-arrow-up-right me-1"></i> +8.4%
                        </span>
                        <small class="ms-1 text-white-50" style="font-size: 0.7rem;">vs last year</small>
                    </div>
                </div>
                <div class="rounded-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.1);">
                    <i class="bi bi-wallet2 fs-2 text-white"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-sm-6">
        <div class="premium-card p-4" style="background: linear-gradient(135deg, rgba(20, 184, 166, 0.8) 0%, rgba(13, 148, 136, 0.8) 100%); border: none;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-0 text-white-50 small fw-bold text-uppercase" style="letter-spacing: 1px;">Growth</p>
                    <h2 class="mb-0 fw-bold text-white mt-1">128</h2>
                        <span class="badge rounded-pill text-white small" style="background: rgba(255, 255, 255, 0.2) !important; backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.1);">
                            <i class="bi bi-graph-up-arrow me-1"></i> Rising
                        </span>
                        <small class="ms-1 text-white-50" style="font-size: 0.7rem;">Active Now</small>
                </div>
                <div class="rounded-4 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); border: 1px solid rgba(255, 255, 255, 0.1);">
                    <i class="bi bi-lightning-charge-fill fs-2 text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row g-4 mb-5">
    <div class="col-lg-8">
        <div class="premium-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0" style="color: var(--text-title)">Booking Trends</h5>
                <select class="form-select form-select-sm border-0 premium-card py-1 px-3" style="width: auto;">
                    <option>Last 6 Months</option>
                    <option>Last Year</option>
                </select>
            </div>
            <div style="height: 300px;">
                <canvas id="bookingChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="premium-card p-4 h-100">
            <h5 class="fw-bold mb-4" style="color: var(--text-title)">Popular Destinations</h5>
            <div style="height: 250px;">
                <canvas id="revenueChart"></canvas>
            </div>
            <div class="mt-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small class="text-muted">Raja Ampat</small>
                    <small class="fw-bold">45%</small>
                </div>
                <div class="progress rounded-pill" style="height: 6px;">
                    <div class="progress-bar bg-success" style="width: 45%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Map Section -->
    <div class="col-lg-7">
        <div class="premium-card p-4 h-100">
            <h5 class="fw-bold mb-4" style="color: var(--text-title)">Interactive Map</h5>
            <div id="indonesiaMap" style="height: 400px; border-radius: 20px; z-index: 1;"></div>
        </div>
    </div>
    
    <!-- Table Section -->
    <div class="col-lg-5">
        <div class="premium-card p-4 h-100">
            <h5 class="fw-bold mb-4" style="color: var(--text-title)">Recent Activity</h5>
            <div class="pe-2" style="max-height: 400px; overflow-y: auto;">
                <div class="d-flex gap-3 mb-4">
                    <div class="flex-shrink-0">
                        <div class="rounded-3 p-2 bg-success bg-opacity-10 text-success">
                            <i class="bi bi-cart-check-fill fs-5"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold" style="color: var(--text-title)">New Booking Confirmed</h6>
                        <p class="mb-0 text-muted small">Customer #1024 paid for Bromo Sunrise Tour</p>
                        <small class="text-muted-emphasis" style="font-size: 0.7rem;">2 minutes ago</small>
                    </div>
                </div>
                <div class="d-flex gap-3 mb-4">
                    <div class="flex-shrink-0">
                        <div class="rounded-3 p-2 bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-person-fill-add fs-5"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold" style="color: var(--text-title)">New User Registered</h6>
                        <p class="mb-0 text-muted small">Amanda Smith joined as a new traveler</p>
                        <small class="text-muted-emphasis" style="font-size: 0.7rem;">15 minutes ago</small>
                    </div>
                </div>
                <div class="d-flex gap-3 mb-4">
                    <div class="flex-shrink-0">
                        <div class="rounded-3 p-2 bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-star-fill fs-5"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold" style="color: var(--text-title)">New Review Received</h6>
                        <p class="mb-0 text-muted small">"Amazing trip to Raja Ampat!" - 5 Stars</p>
                        <small class="text-muted-emphasis" style="font-size: 0.7rem;">1 hour ago</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let bookingChart, revenueChart;

function initCharts() {
    const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
    const textColor = isDark ? '#94a3b8' : '#64748b';
    const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';

    // Booking Chart
    const bookingCtx = document.getElementById('bookingChart').getContext('2d');
    bookingChart = new Chart(bookingCtx, {
        type: 'line',
        data: {
            labels: ['Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan'],
            datasets: [{
                label: 'Bookings',
                data: [420, 550, 680, 720, 890, 1020],
                borderColor: '#198754',
                backgroundColor: 'rgba(25, 135, 84, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#198754',
                pointBorderWidth: 2,
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { 
                    grid: { display: false },
                    ticks: { color: textColor }
                },
                y: { 
                    grid: { color: gridColor },
                    ticks: { color: textColor }
                }
            }
        }
    });

    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    revenueChart = new Chart(revenueCtx, {
        type: 'doughnut',
        data: {
            labels: ['Wisata', 'Edukasi', 'Package'],
            datasets: [{
                data: [45, 30, 25],
                backgroundColor: ['#198754', '#f59e0b', '#6366f1'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: textColor, padding: 20, usePointStyle: true }
                }
            }
        }
    });
}

function updateChartsTheme(theme) {
    if (!bookingChart) return;
    const isDark = theme === 'dark';
    const textColor = isDark ? '#94a3b8' : '#64748b';
    const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';

    bookingChart.options.scales.x.ticks.color = textColor;
    bookingChart.options.scales.y.ticks.color = textColor;
    bookingChart.options.scales.y.grid.color = gridColor;
    bookingChart.update();

    revenueChart.options.plugins.legend.labels.color = textColor;
    revenueChart.update();
}

document.addEventListener('DOMContentLoaded', initCharts);

// Indonesia Map with Leaflet - Most Vibrant Colors
var map = L.map('indonesiaMap').setView([-2.5, 118], 5);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '©OpenStreetMap contributors'
}).addTo(map);

var greenIcon = L.icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41]
});

var markers = [
    {
        lat: 2.6845, 
        lng: 98.8756, 
        name: 'Danau Toba', 
        img: 'https://picsum.photos/seed/toba/400/250',
        desc: 'World largest volcanic lake with breathtaking sunrise views and Samosir island.'
    },
    {
        lat: -0.2309, 
        lng: 130.5239, 
        name: 'Raja Ampat', 
        img: 'https://picsum.photos/seed/raja/400/250',
        desc: 'Paradise for divers with rich marine biodiversity and karst islands.'
    },
    {
        lat: -7.6079, 
        lng: 110.2038, 
        name: 'Borobudur', 
        img: 'https://picsum.photos/seed/borobudur/400/250',
        desc: 'World largest Buddhist temple and UNESCO site in central Java.'
    },
    {
        lat: -8.5455, 
        lng: 119.4892, 
        name: 'Komodo', 
        img: 'https://picsum.photos/seed/komodo/400/250',
        desc: 'Home to the famous Komodo Dragons and pink sand beaches.'
    },
    {
        lat: -7.9425, 
        lng: 112.9531, 
        name: 'Bromo', 
        img: 'https://picsum.photos/seed/bromo/400/250',
        desc: 'Iconic active volcano with caldera basin and majestic views.'
    }
];

markers.forEach(m => {
    let popupContent = `
        <div style="width: 200px; font-family: 'Outfit', sans-serif;">
            ${m.img ? `<img src="${m.img}" style="width: 100%; border-radius: 12px; margin-bottom: 10px;">` : ''}
            <h6 style="font-weight: 700; color: #1e293b; margin-bottom: 5px;">${m.name}</h6>
            <p style="font-size: 0.75rem; color: #64748b; margin-bottom: 0;">${m.desc || 'Beautiful Indonesian destination.'}</p>
        </div>
    `;
    L.marker([m.lat, m.lng], {icon: greenIcon}).addTo(map).bindPopup(popupContent);
});
</script>
@endsection
