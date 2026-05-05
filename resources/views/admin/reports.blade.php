@extends('layouts.admin')

@section('title', 'Reports')
@section('page-title', 'Reports & Analytics')
@section('page-subtitle', 'View detailed reports and analytics')

@section('content')
<!-- Date Range Filter -->
<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-body">
        <form action="{{ route('admin.reports') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label mb-1">From Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ $startDate->format('Y-m-d') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label mb-1">To Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ $endDate->format('Y-m-d') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-success rounded-pill w-100"><i class="bi bi-filter me-2"></i>Generate Report</button>
            </div>
        </form>
    </div>
</div>

<!-- Summary Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted">Total Bookings</small>
                        <h3 class="fw-bold text-primary">{{ number_format($stats['total_bookings']) }}</h3>
                    </div>
                    <div class="bg-primary-subtle p-3 rounded-3">
                        <i class="bi bi-calendar-check text-primary fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted">Total Revenue</small>
                        <h4 class="fw-bold text-success">Rp {{ number_format($stats['total_revenue'] / 1000000, 1) }}M</h4>
                    </div>
                    <div class="bg-success-subtle p-3 rounded-3">
                        <i class="bi bi-currency-dollar text-success fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted">New Users</small>
                        <h3 class="fw-bold text-info">{{ number_format($stats['new_users']) }}</h3>
                    </div>
                    <div class="bg-info-subtle p-3 rounded-3">
                        <i class="bi bi-people text-info fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted">Avg. Booking</small>
                        <h4 class="fw-bold text-warning">Rp {{ number_format($stats['avg_booking_value'] / 1000, 0) }}k</h4>
                    </div>
                    <div class="bg-warning-subtle p-3 rounded-3">
                        <i class="bi bi-graph-up text-warning fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-trophy text-success me-2"></i>Top Performing Destinations</h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 px-4">Rank</th>
                            <th class="border-0">Destination</th>
                            <th class="border-0">Province</th>
                            <th class="border-0 text-center">Bookings</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topDestinations as $index => $dest)
                        <tr>
                            <td class="px-4">
                                @if($index == 0) <span class="badge bg-warning text-dark">🥇 1</span>
                                @elseif($index == 1) <span class="badge bg-secondary">🥈 2</span>
                                @elseif($index == 2) <span class="badge bg-warning-subtle text-warning">🥉 3</span>
                                @else <span class="badge bg-light text-dark">{{ $index + 1 }}</span>
                                @endif
                            </td>
                            <td class="fw-bold">{{ $dest->name }}</td>
                            <td>{{ $dest->province->name }}</td>
                            <td class="text-center fw-bold text-success">{{ $dest->bookings_count }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">No data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0"><i class="bi bi-pie-chart text-success me-2"></i>Status Breakdown</h6>
            </div>
            <div class="card-body">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Status Chart
const ctx = document.getElementById('statusChart').getContext('2d');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Confirmed', 'Pending', 'Cancelled'],
        datasets: [{
            data: [
                {{ \App\Models\Booking::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Confirmed')->count() }},
                {{ \App\Models\Booking::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Pending')->count() }},
                {{ \App\Models\Booking::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Cancelled')->count() }}
            ],
            backgroundColor: ['#198754', '#ffc107', '#dc3545']
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'bottom' } }
    }
});
</script>
@endsection
