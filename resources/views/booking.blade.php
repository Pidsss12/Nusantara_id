@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Package Info -->
            <div class="card border-0 shadow-lg rounded-4 mb-4">
                <div class="card-header bg-success text-white py-4">
                    <h4 class="mb-0"><i class="bi bi-cart-check me-2"></i>Form Pemesanan Paket Edukasi</h4>
                </div>
                <div class="card-body p-4">
                    @php
                        $packages = [
                            'pelajar' => ['name' => 'Paket Pelajar', 'price' => 250000, 'min' => 20],
                            'mahasiswa' => ['name' => 'Paket Mahasiswa', 'price' => 450000, 'min' => 15],
                            'umum' => ['name' => 'Paket Umum', 'price' => 600000, 'min' => 10]
                        ];
                        $selectedPackage = $packages[request('package', 'pelajar')];
                    @endphp

                    <div class="alert alert-success">
                        <h5 class="fw-bold mb-2">{{ $selectedPackage['name'] }}</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Harga: <strong>Rp {{ number_format($selectedPackage['price'], 0, ',', '.') }}</strong> / peserta</span>
                            <span class="badge bg-white text-success">Min. {{ $selectedPackage['min'] }} orang</span>
                        </div>
                    </div>

                    <form action="#" method="POST">
                        @csrf
                        <input type="hidden" name="package_type" value="{{ request('package', 'pelajar') }}">

                        <h6 class="fw-bold mb-3">Informasi Pemesan</h6>
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="phone" placeholder="08123456789" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Instansi/Sekolah <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="institution" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="fw-bold mb-3">Detail Pesanan</h6>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Jumlah Peserta <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="participants" id="participants" 
                                       min="{{ $selectedPackage['min'] }}" value="{{ $selectedPackage['min'] }}" required>
                                <small class="text-muted">Minimal {{ $selectedPackage['min'] }} peserta</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Kunjungan <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="visit_date" 
                                       min="{{ date('Y-m-d', strtotime('+7 days')) }}" required>
                                <small class="text-muted">Minimal booking 7 hari sebelumnya</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pilih Destinasi <span class="text-danger">*</span></label>
                            <select class="form-select" name="destination" required>
                                <option value="">-- Pilih Destinasi --</option>
                                <option value="raja-ampat">Raja Ampat - Papua</option>
                                <option value="borobudur">Candi Borobudur - Jawa Tengah</option>
                                <option value="komodo">Taman Nasional Komodo - NTT</option>
                                <option value="bromo">Gunung Bromo - Jawa Timur</option>
                                <option value="toba">Danau Toba - Sumatera Utara</option>
                                <option value="bali">Nusa Dua - Bali</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catatan Tambahan</label>
                            <textarea class="form-control" name="notes" rows="3" 
                                      placeholder="Contoh: Ada peserta dengan kebutuhan khusus, permintaan khusus menu makanan, dll"></textarea>
                        </div>

                        <hr class="my-4">

                        <div class="bg-light p-4 rounded-3 mb-4">
                            <h6 class="fw-bold mb-3">Ringkasan</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Harga per peserta</span>
                                <span class="fw-bold">Rp {{ number_format($selectedPackage['price'], 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Jumlah peserta</span>
                                <span class="fw-bold" id="displayParticipants">{{ $selectedPackage['min'] }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold fs-5">Total</span>
                                <span class="fw-bold fs-5 text-success" id="totalPrice">Rp {{ number_format($selectedPackage['price'] * $selectedPackage['min'], 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="agree" required>
                            <label class="form-check-label" for="agree">
                                Saya setuju dengan <a href="#" class="text-success">syarat dan ketentuan</a> yang berlaku
                            </label>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg rounded-pill fw-bold">
                                <i class="bi bi-check-circle me-2"></i>Konfirmasi Pemesanan
                            </button>
                            <a href="{{ route('education') }}" class="btn btn-outline-secondary rounded-pill">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('participants').addEventListener('input', function() {
    const participants = parseInt(this.value) || {{ $selectedPackage['min'] }};
    const pricePerPerson = {{ $selectedPackage['price'] }};
    const total = participants * pricePerPerson;
    
    document.getElementById('displayParticipants').textContent = participants;
    document.getElementById('totalPrice').textContent = 'Rp ' + total.toLocaleString('id-ID');
});
</script>
@endsection
