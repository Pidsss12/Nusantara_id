@extends('layouts.app')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-success text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('destination.show', $destination) }}" class="text-success text-decoration-none">{{ $destination->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Booking</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Booking Form -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-success text-white py-3 rounded-top-4">
                    <h5 class="mb-0"><i class="bi bi-calendar-check me-2"></i>Form Pemesanan</h5>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                        
                        <h6 class="fw-bold mb-3 text-success"><i class="bi bi-person me-2"></i>Data Pemesan</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name', Auth::user()->name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="customer_email" class="form-control" value="{{ old('customer_email', Auth::user()->email) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone', Auth::user()->phone) }}" placeholder="+62" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Instansi/Organisasi</label>
                                <input type="text" name="institution" class="form-control" value="{{ old('institution') }}" placeholder="Opsional">
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="fw-bold mb-3 text-success"><i class="bi bi-calendar3 me-2"></i>Detail Kunjungan</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Kunjungan <span class="text-danger">*</span></label>
                                <input type="date" name="visit_date" class="form-control" value="{{ old('visit_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Peserta <span class="text-danger">*</span></label>
                                <input type="number" name="participants" id="participants" class="form-control" value="{{ old('participants', 1) }}" min="1" max="100" required>
                            </div>
                            @if($packages->count() > 0)
                            <div class="col-12">
                                <label class="form-label">Pilih Paket</label>
                                <select name="package_id" id="package_id" class="form-select">
                                    <option value="">Tanpa Paket (Tiket Masuk Saja)</option>
                                    @foreach($packages as $package)
                                    <option value="{{ $package->id }}" data-price="{{ $package->price }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                        {{ $package->name }} - Rp {{ number_format($package->price, 0, ',', '.') }}/pax
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="col-12">
                                <label class="form-label">Catatan Tambahan</label>
                                <textarea name="notes" class="form-control" rows="3" placeholder="Permintaan khusus, kebutuhan makanan, dll.">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill fw-bold">
                                <i class="bi bi-check-circle me-2"></i>Konfirmasi Pemesanan
                            </button>
                            <a href="{{ route('destination.show', $destination) }}" class="btn btn-outline-secondary rounded-pill">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                <div class="card-header bg-light py-3 rounded-top-4">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-receipt me-2"></i>Ringkasan Pesanan</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $destination->photo ?? 'https://picsum.photos/seed/' . $destination->slug . '/100/100' }}" class="rounded-3 me-3" style="width: 80px; height: 80px; object-fit: cover;">
                        <div>
                            <h6 class="fw-bold mb-1">{{ $destination->name }}</h6>
                            <small class="text-muted"><i class="bi bi-geo-alt"></i> {{ $destination->location ?? $destination->province->name ?? 'Indonesia' }}</small>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Harga per orang</span>
                            <span id="pricePerPax">Rp {{ number_format($destination->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Jumlah peserta</span>
                            <span id="displayPax">1 orang</span>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold text-success fs-4" id="totalPrice">Rp {{ number_format($destination->price, 0, ',', '.') }}</span>
                    </div>
                    
                    <input type="hidden" id="basePrice" value="{{ $destination->price }}">
                </div>
                <div class="card-footer bg-white rounded-bottom-4">
                    <small class="text-muted"><i class="bi bi-shield-check text-success me-1"></i>Pemesanan aman & terjamin</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const participantsInput = document.getElementById('participants');
    const packageSelect = document.getElementById('package_id');
    const basePrice = parseInt(document.getElementById('basePrice').value);
    const pricePerPaxEl = document.getElementById('pricePerPax');
    const displayPaxEl = document.getElementById('displayPax');
    const totalPriceEl = document.getElementById('totalPrice');
    
    function formatRupiah(num) {
        return 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    
    function calculateTotal() {
        let price = basePrice;
        const pax = parseInt(participantsInput.value) || 1;
        
        if (packageSelect) {
            const selected = packageSelect.options[packageSelect.selectedIndex];
            if (selected.value && selected.dataset.price) {
                price = parseInt(selected.dataset.price);
            }
        }
        
        const total = price * pax;
        
        pricePerPaxEl.textContent = formatRupiah(price);
        displayPaxEl.textContent = pax + ' orang';
        totalPriceEl.textContent = formatRupiah(total);
    }
    
    participantsInput.addEventListener('input', calculateTotal);
    if (packageSelect) {
        packageSelect.addEventListener('change', calculateTotal);
    }
    
    calculateTotal();
});
</script>
@endsection
