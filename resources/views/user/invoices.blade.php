@extends('layouts.user')

@section('title', 'My Invoices')
@section('page-title', 'My Invoices')
@section('page-subtitle', 'View and manage your invoices')

@section('content')
<!-- session success handled by layout -->

<!-- Filters -->
<div class="premium-card p-4 mb-4">
    <form action="{{ route('user.invoices') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-md-4">
            <p class="mb-2 small fw-bold text-uppercase opacity-75" style="letter-spacing: 1px; font-size: 0.7rem;">Payment Status</p>
            <select name="payment_status" class="form-select premium-card border-0 py-2 px-3 shadow-none">
                <option value="">All Status</option>
                <option value="Unpaid" {{ request('payment_status') == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="Pending" {{ request('payment_status') == 'Pending' ? 'selected' : '' }}>Pending Verification</option>
                <option value="Paid" {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>Paid</option>
                <option value="Refunded" {{ request('payment_status') == 'Refunded' ? 'selected' : '' }}>Refunded</option>
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-success px-4 rounded-pill"><i class="bi bi-search me-2"></i>Filter</button>
            <a href="{{ route('user.invoices') }}" class="btn btn-light px-4 rounded-pill ms-2 text-muted">Reset</a>
        </div>
    </form>
</div>

<!-- Invoice List -->
<div class="premium-card overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead style="background: rgba(0,0,0,0.02)">
                <tr>
                    <th class="border-0 px-4 py-3 small fw-bold text-muted text-uppercase">Invoice Code</th>
                    <th class="border-0 py-3 small fw-bold text-muted text-uppercase">Date</th>
                    <th class="border-0 py-3 small fw-bold text-muted text-uppercase">Destination</th>
                    <th class="border-0 py-3 small fw-bold text-muted text-uppercase">Amount</th>
                    <th class="border-0 py-3 small fw-bold text-muted text-uppercase">Status</th>
                    <th class="border-0 py-3 small fw-bold text-muted text-uppercase">Payment</th>
                    <th class="border-0 py-3 small fw-bold text-muted text-uppercase text-end px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoices as $invoice)
                <tr>
                    <td class="px-4 py-3 fw-bold text-success">{{ $invoice->invoice_code }}</td>
                    <td class="py-3">{{ $invoice->invoice_date ? $invoice->invoice_date->format('d M Y') : '-' }}</td>
                    <td class="py-3 fw-medium" style="color: var(--text-title)">{{ $invoice->destination->name ?? '-' }}</td>
                    <td class="py-3 fw-bold text-success">Rp {{ number_format($invoice->total_amount, 0, ',', '.') }}</td>
                    <td class="py-3">
                        <span class="badge rounded-pill px-3 py-1" style="background: {{ $invoice->status == 'Confirmed' ? 'rgba(25, 135, 84, 0.1)' : 'rgba(255, 193, 7, 0.1)' }}; color: {{ $invoice->status == 'Confirmed' ? '#198754' : '#ffc107' }}; border: 1px solid rgba(0,0,0,0.02);">
                            {{ $invoice->status }}
                        </span>
                    </td>
                    <td class="py-3">
                        <span class="badge rounded-pill px-3 py-1" style="background: rgba(25, 135, 84, 0.1); color: #198754; border: 1px solid rgba(0,0,0,0.02);">
                            {{ $invoice->payment_status }}
                        </span>
                    </td>
                    <td class="py-3 text-end px-4">
                        <a href="{{ route('user.invoices.show', $invoice) }}" class="btn btn-sm px-3 rounded-pill text-white" style="background: var(--primary-green); font-size: 0.75rem;">
                            View
                        </a>
                    </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-receipt fs-1"></i>
                            <p class="mt-3 mb-0">No invoices found</p>
                            <a href="{{ route('destinations.index') }}" class="btn btn-success btn-sm rounded-pill mt-2">
                                <i class="bi bi-compass me-1"></i>Make a Booking
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($invoices->hasPages())
    <div class="card-footer bg-white">
        {{ $invoices->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection
