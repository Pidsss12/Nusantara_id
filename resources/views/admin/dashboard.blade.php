@extends('layouts.admin')

@section('title', 'Dashboard')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin-dashboard-map.css') }}?v={{ filemtime(public_path('css/admin-dashboard-map.css')) }}">
@endsection

@section('content')

<div class="row g-4 mb-5">
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm rounded-5 text-white h-100" style="background: #2ecc71;">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-uppercase fw-bold mb-1 opacity-75" style="letter-spacing: 1px; font-size: 0.75rem;">Total Users</p>
                    <h2 class="display-6 fw-bold mb-1" id="totalUsersCount" style="font-size: 2.5rem;">
                        {{ isset($users) && count($users) > 0 ? number_format(count($users)) : '0' }}
                    </h2>
                    <div class="d-flex align-items-center gap-2 mt-2">
                        <span class="badge bg-white bg-opacity-25 rounded-pill px-3 py-1 fw-bold" style="font-size: 0.75rem;">
                            Live Maps
                        </span>
                        <div class="lh-1">
                            <small class="opacity-75 d-block" style="font-size: 0.65rem;">detected</small>
                            <small class="opacity-75 d-block" style="font-size: 0.65rem;">users</small>
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
            <div class="live-map-header d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold mb-1">Interactive Map</h5>
                    <div class="live-map-subtitle">User location monitoring</div>
                </div>
                <span class="badge rounded-pill px-3 py-2 map-status-badge">
                    <i class="bi bi-broadcast me-1"></i>Live Ready
                </span>
            </div>

            <div class="map-toolbar">
                <div class="map-stat">
                    <span>Total Pins</span>
                    <strong id="mapTotalPins">0</strong>
                </div>
                <div class="map-stat">
                    <span>Online</span>
                    <strong id="mapOnlineCount">0</strong>
                </div>
                <div class="map-stat">
                    <span>Offline</span>
                    <strong id="mapOfflineCount">0</strong>
                </div>
                <div class="map-legend">
                    <span><i class="map-dot online"></i>Online</span>
                    <span><i class="map-dot offline"></i>Offline</span>
                </div>
            </div>

            <div class="position-relative">
                <div id="indonesiaMap"></div>
                <div id="mapEmptyState" class="map-empty-state">
                    <div>
                        <i class="bi bi-geo-alt fs-3 d-block mb-2"></i>
                        <strong class="d-block">Belum ada koordinat user</strong>
                        <small>Map siap menampilkan data saat backend mengirim latitude dan longitude.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 p-4 h-100 location-feed-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold mb-1">User Location Feed</h5>
                    <small class="text-muted" id="mapFeedSummary">Synced with map markers</small>
                </div>
                <small class="text-muted" id="mapLastUpdated">--</small>
            </div>
            <div id="mapUserFeed" class="map-user-feed"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    window.NusantaraUserMapData = @json($users ?? []);
</script>
<script src="{{ asset('js/admin-dashboard.js') }}?v={{ filemtime(public_path('js/admin-dashboard.js')) }}"></script>
@endsection
