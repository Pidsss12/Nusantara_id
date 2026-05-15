<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<div class="row g-4 mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-5 text-white h-100" style="background: #2ecc71;">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase fw-bold mb-1 opacity-75" style="letter-spacing: 1px; font-size: 0.75rem;">Total Users</p>
                    <h2 class="display-6 fw-bold mb-1" style="font-size: 2.5rem;">2,547</h2>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="badge bg-white bg-opacity-25 rounded-pill px-3 py-1 fw-bold" style="font-size: 0.75rem;">
                            <i class="bi bi-arrow-up-right"></i> +12.5%
                        </span>
                        <div class="lh-1">
                            <small class="opacity-50 d-block" style="font-size: 0.65rem;">since last</small>
                            <small class="opacity-50 d-block" style="font-size: 0.65rem;">month</small>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center" style="width: 75px; height: 95px;">
                    <i class="bi bi-people-fill text-white" style="font-size: 3rem; opacity: 0.9;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-5 text-white h-100" style="background: #7d5fff;">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase fw-bold mb-1 opacity-75" style="letter-spacing: 1px; font-size: 0.75rem;">Bookings</p>
                    <h2 class="display-6 fw-bold mb-1" style="font-size: 2.5rem;">4,892</h2>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="badge bg-white bg-opacity-25 rounded-pill px-3 py-1 fw-bold" style="font-size: 0.75rem;">
                            <i class="bi bi-arrow-up-right"></i> +22.0%
                        </span>
                        <div class="lh-1">
                            <small class="opacity-50 d-block" style="font-size: 0.65rem;">since last</small>
                            <small class="opacity-50 d-block" style="font-size: 0.65rem;">month</small>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center" style="width: 75px; height: 95px;">
                    <i class="bi bi-journal-check text-white" style="font-size: 3rem; opacity: 0.9;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-5 text-white h-100" style="background: #ffa801;">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase fw-bold mb-1 opacity-75" style="letter-spacing: 1px; font-size: 0.75rem;">Revenue</p>
                    <h2 class="display-6 fw-bold mb-1" style="font-size: 2.5rem;">45.2M</h2>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="badge bg-white bg-opacity-25 rounded-pill px-3 py-1 fw-bold" style="font-size: 0.75rem;">
                            <i class="bi bi-arrow-up-right"></i> +8.4%
                        </span>
                        <div class="lh-1">
                            <small class="opacity-50 d-block" style="font-size: 0.65rem;">vs last</small>
                            <small class="opacity-50 d-block" style="font-size: 0.65rem;">year</small>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center" style="width: 75px; height: 95px;">
                    <i class="bi bi-wallet2 text-white" style="font-size: 3rem; opacity: 0.9;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-5 text-white h-100" style="background: #1abc9c;">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase fw-bold mb-1 opacity-75" style="letter-spacing: 1px; font-size: 0.75rem;">Growth</p>
                    <h2 class="display-6 fw-bold mb-1" style="font-size: 2.5rem;">128</h2>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="badge bg-white bg-opacity-25 rounded-pill px-3 py-1 fw-bold" style="font-size: 0.75rem;">
                            <i class="bi bi-graph-up-arrow"></i> Rising
                        </span>
                        <div class="lh-1">
                            <small class="opacity-50 d-block" style="font-size: 0.65rem;">Active</small>
                            <small class="opacity-50 d-block" style="font-size: 0.65rem;">Now</small>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center" style="width: 75px; height: 95px;">
                    <i class="bi bi-lightning-charge-fill text-white" style="font-size: 3rem; opacity: 0.9;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Booking Trends</h5>
                <select class="form-select form-select-sm border-0 bg-light rounded-pill px-3 w-auto shadow-none">
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
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <h5 class="fw-bold mb-4">Popular Destinations</h5>
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
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <h5 class="fw-bold mb-4">Interactive Map</h5>
            <div id="indonesiaMap" style="height: 400px; border-radius: 20px; z-index: 1;"></div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
            <h5 class="fw-bold mb-4">Recent Activity</h5>
            <div class="pe-2" style="max-height: 400px; overflow-y: auto;">
                <div class="d-flex gap-3 mb-4">
                    <div class="flex-shrink-0">
                        <div class="rounded-3 p-2 bg-success bg-opacity-10 text-success">
                            <i class="bi bi-cart-check-fill fs-5"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold">New Booking Confirmed</h6>
                        <p class="mb-0 text-muted small">Customer #1024 paid for Bromo Sunrise Tour</p>
                        <small class="text-muted" style="font-size: 0.7rem;">2 minutes ago</small>
                    </div>
                </div>
                <div class="d-flex gap-3 mb-4">
                    <div class="flex-shrink-0">
                        <div class="rounded-3 p-2 bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-person-fill-add fs-5"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold">New User Registered</h6>
                        <p class="mb-0 text-muted small">Amanda Smith joined as a new traveler</p>
                        <small class="text-muted" style="font-size: 0.7rem;">15 minutes ago</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
let bookingChart, revenueChart;

function initCharts() {
    const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
    const textColor = isDark ? '#94a3b8' : '#64748b';
    const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';

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
                x: { grid: { display: false }, ticks: { color: textColor } },
                y: { grid: { color: gridColor }, ticks: { color: textColor } }
            }
        }
    });

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

document.addEventListener('DOMContentLoaded', function() {
    initCharts();
    var map = L.map('indonesiaMap').setView([-2.5, 118], 5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    var greenIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41]
    });

    var markers = [
        { lat: 2.6845, lng: 98.8756, name: 'Danau Toba', desc: 'World largest volcanic lake.' },
        { lat: -0.2309, lng: 130.5239, name: 'Raja Ampat', desc: 'Paradise for divers.' },
        { lat: -7.6079, lng: 110.2038, name: 'Borobudur', desc: 'World largest Buddhist temple.' },
        { lat: -8.5455, lng: 119.4892, name: 'Komodo', desc: 'Home to Komodo Dragons.' },
        { lat: -7.9425, lng: 112.9531, name: 'Bromo', desc: 'Iconic active volcano.' }
    ];

    markers.forEach(m => {
        L.marker([m.lat, m.lng], {icon: greenIcon}).addTo(map)
            .bindPopup(`<b>${m.name}</b><br>${m.desc}`);
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Nusantara_id\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>