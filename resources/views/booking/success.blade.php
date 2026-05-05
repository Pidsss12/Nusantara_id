@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Success Card -->
            <div class="card border-0 shadow-sm rounded-4 text-center overflow-hidden">
                <!-- Success Header -->
                <div class="bg-success text-white py-5">
                    <div class="mb-3">
                        <i class="bi bi-check-circle-fill" style="font-size: 80px;"></i>
                    </div>
                    <h2 class="fw-bold mb-2">Booking Berhasil!</h2>
                    <p class="opacity-75 mb-0">Terima kasih telah melakukan pemesanan</p>
                </div>
                
                <div class="card-body p-4">
                    <!-- Booking Info -->
                    <div class="bg-light rounded-4 p-4 mb-4">
                        <div class="row text-start">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Kode Booking</small>
                                <h5 class="fw-bold text-success mb-0">{{ $booking->booking_code }}</h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Kode Invoice</small>
                                <h5 class="fw-bold text-primary mb-0">{{ $booking->invoice_code }}</h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Destinasi</small>
                                <strong>{{ $booking->destination->name }}</strong>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Tanggal Kunjungan</small>
                                <strong>{{ $booking->visit_date->format('d M Y') }}</strong>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Jumlah Peserta</small>
                                <strong>{{ $booking->participants }} orang</strong>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block">Total Pembayaran</small>
                                <h5 class="fw-bold text-success mb-0">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Instructions -->
                    <div class="alert alert-warning rounded-3 text-start">
                        <h6 class="fw-bold"><i class="bi bi-exclamation-triangle me-2"></i>Instruksi Pembayaran</h6>
                        <p class="mb-2">Silahkan lakukan pembayaran ke salah satu rekening berikut:</p>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <strong>Bank BCA</strong><br>
                                <span class="text-muted">1234567890</span><br>
                                <small>a.n. PT Nusantara Green</small>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Bank Mandiri</strong><br>
                                <span class="text-muted">0987654321</span><br>
                                <small>a.n. PT Nusantara Green</small>
                            </div>
                        </div>
                        <hr>
                        <small class="text-muted">Setelah transfer, konfirmasi pembayaran melalui halaman Invoice di dashboard Anda.</small>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-grid gap-2 mt-4">
                        <a href="{{ route('user.invoices.show', $booking) }}" class="btn btn-success btn-lg rounded-pill fw-bold">
                            <i class="bi bi-receipt me-2"></i>Lihat Invoice & Konfirmasi Pembayaran
                        </a>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-success rounded-pill">
                            <i class="bi bi-grid me-2"></i>Ke Dashboard
                        </a>
                        <a href="{{ route('destinations.index') }}" class="btn btn-outline-secondary rounded-pill">
                            <i class="bi bi-compass me-2"></i>Jelajahi Destinasi Lain
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Next Steps -->
            <div class="card border-0 shadow-sm rounded-4 mt-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-list-check text-success me-2"></i>Langkah Selanjutnya</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="d-flex">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">1</div>
                                <div>
                                    <strong>Transfer</strong>
                                    <p class="small text-muted mb-0">Lakukan pembayaran</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">2</div>
                                <div>
                                    <strong>Konfirmasi</strong>
                                    <p class="small text-muted mb-0">Upload bukti transfer</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">3</div>
                                <div>
                                    <strong>Selesai</strong>
                                    <p class="small text-muted mb-0">Terima e-ticket</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
