@extends('layouts.user')

@section('title', 'Invoice ' . $booking->invoice_code)
@section('page-title', 'Invoice')
@section('page-subtitle', $booking->invoice_code)

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row g-4">
    <!-- Invoice Card -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden" id="invoice-printable">
            <!-- Header Section with Curved Design (Like Screenshot) -->
            <div style="position: relative; background: #fff; height: 160px;">
                <!-- Right Side Curve (Blue/Grey) -->
                <div style="position: absolute; top: 0; right: 0; width: 60%; height: 140px; background: #2d3436; border-bottom-left-radius: 80% 100%; z-index: 1;"></div>
                <div style="position: absolute; top: 0; right: 0; width: 55%; height: 120px; background: #198754; border-bottom-left-radius: 80% 100%; z-index: 2;"></div>
                
                <!-- Logo area in the curve -->
                <div style="position: absolute; top: 30px; right: 40px; z-index: 3; text-align: right; color: white;">
                    <div style="display: flex; align-items: center; justify-content: flex-end; gap: 10px;">
                        <div style="background: white; width: 45px; height: 45px; border-radius: 8px; display: flex; align-items: center; justify-content: center; padding: 5px;">
                            <img src="{{ asset('img/logo.png') }}" style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                        <div style="text-align: left;">
                            <h4 class="fw-bold mb-0" style="letter-spacing: 1px;">EKOWISATA</h4>
                            <small style="font-size: 10px; opacity: 0.9; text-transform: uppercase;">Portal Wisata Indonesia</small>
                        </div>
                    </div>
                </div>

                <!-- Left Side: Invoice Label -->
                <div style="position: absolute; top: 40px; left: 40px; z-index: 3;">
                    <h1 class="fw-bold mb-0" style="color: #2d3436; font-size: 2.5rem;">INVOICE</h1>
                    <div class="mt-2">
                        <table style="font-size: 13px; color: #636e72;">
                            <tr>
                                <td width="100">Account No</td>
                                <td width="15">:</td>
                                <td class="fw-bold">{{ Auth::id() }}</td>
                            </tr>
                            <tr>
                                <td>Invoice No</td>
                                <td>:</td>
                                <td class="fw-bold text-success">{{ $booking->invoice_code }}</td>
                            </tr>
                            <tr>
                                <td>Invoice Date</td>
                                <td>:</td>
                                <td class="fw-bold">{{ $booking->invoice_date ? $booking->invoice_date->format('d M Y') : now()->format('d M Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Body Content -->
            <div class="card-body px-5 pb-5">
                <!-- User Info -->
                <div class="row mb-5">
                    <div class="col-md-6">
                        <small class="text-uppercase fw-bold text-muted mb-2 d-block" style="font-size: 11px;">Pelanggan:</small>
                        <h5 class="fw-bold mb-1">{{ $booking->customer_name }}</h5>
                        <p class="text-muted small mb-0">{{ $booking->customer_email }}</p>
                        <p class="text-muted small">{{ $booking->customer_phone ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="d-inline-block text-start p-3 rounded-4 bg-light">
                            <small class="text-uppercase fw-bold text-muted mb-2 d-block" style="font-size: 11px;">Status Pembayaran:</small>
                            <span class="badge rounded-pill {{ $booking->payment_status == 'Paid' ? 'bg-success' : 'bg-warning text-dark' }} px-3 py-2">
                                {{ $booking->payment_status == 'Unpaid' ? 'BELUM BAYAR' : ($booking->payment_status == 'Pending' ? 'MENUNGGU VERIFIKASI' : 'LUNAS') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Table Header Styled like Screenshot -->
                <div class="table-responsive">
                    <table class="table mb-4">
                        <thead>
                            <tr style="background: #198754; color: white;">
                                <th class="py-3 ps-4 border-0 rounded-start" width="60">SL</th>
                                <th class="py-3 border-0">Item Description</th>
                                <th class="py-3 border-0 text-center">Price</th>
                                <th class="py-3 border-0 text-center">Qty</th>
                                <th class="py-3 pe-4 border-0 text-end rounded-end">Total</th>
                            </tr>
                        </thead>
                        <tbody class="border-top-0">
                            <tr>
                                <td class="ps-4 py-4 text-center">1</td>
                                <td class="py-4">
                                    <h6 class="fw-bold mb-1">{{ $booking->destination->name }}</h6>
                                    <small class="text-muted d-block">{{ $booking->visit_date->format('d F Y') }}</small>
                                    @if($booking->notes)
                                        <div class="mt-2 p-2 bg-light rounded-3 small text-muted" style="font-size: 11px; white-space: pre-line;">
                                            {{ $booking->notes }}
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4 text-center align-middle">Rp {{ number_format($booking->total_amount / $booking->participants, 0, ',', '.') }}</td>
                                <td class="py-4 text-center align-middle">{{ $booking->participants }}</td>
                                <td class="pe-4 py-4 text-end align-middle fw-bold">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Summary Section -->
                <div class="row justify-content-end">
                    <div class="col-md-5">
                        <table class="table table-borderless">
                            <tr>
                                <td class="text-end text-muted">Subtotal</td>
                                <td class="text-end fw-bold" width="150">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td class="text-end text-muted">Tax Rate (0%)</td>
                                <td class="text-end fw-bold">Rp 0</td>
                            </tr>
                            <tr class="border-top">
                                <td class="text-end text-success fw-bold fs-5">TOTAL</td>
                                <td class="text-end text-success fw-bold fs-5">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </table>

                        <!-- Signature simulation from screenshot -->
                        <div class="text-center mt-5 pt-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/3/3a/Jon_Snow_Signature.png" style="height: 40px; opacity: 0.6; filter: grayscale(1) brightness(0.5);">
                            <h6 class="fw-bold mb-0 mt-2">Admin Ekowisata</h6>
                            <small class="text-muted">Manager</small>
                        </div>
                    </div>
                </div>

                <!-- Footer area styled like screenshot -->
                <div class="mt-5 pt-4 border-top">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <div class="d-flex align-items-start gap-3">
                                <div class="bg-success p-2 rounded-3">
                                    <img src="{{ asset('img/qr-payment.png') }}" style="width: 60px; filter: brightness(0) invert(1);">
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-success">GET IN TOUCH</h6>
                                    <small class="text-muted d-block">Jl. Kebon Jeruk No. 123, Jakarta Selatan</small>
                                    <small class="text-muted d-block">+62 812-3456-7890</small>
                                    <small class="text-muted d-block">info@ekowisata.id</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 text-md-end">
                            <p class="text-muted small mb-0">Note: Harap simpan invoice ini sebagai bukti pemesanan yang sah.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Curve (Like Screenshot) -->
            <div style="position: relative; height: 60px; background: #fff;">
                <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 60px; background: #2d3436; z-index: 1;"></div>
                <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 45px; background: #198754; border-top-right-radius: 50% 100%; z-index: 2;"></div>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="col-lg-4">
        @if($booking->payment_status == 'Unpaid')
        <div class="premium-card p-4 mb-4">
            <h6 class="fw-bold mb-4" style="color: var(--text-title)"><i class="bi bi-upload text-success me-2"></i>Konfirmasi Pembayaran</h6>
            <form action="{{ route('user.invoices.confirm-payment', $booking) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">Metode Pembayaran</label>
                    <select name="payment_method" class="form-select premium-card border-0 py-2 px-3 shadow-none" required>
                        <option value="">Pilih...</option>
                        <option value="Bank BCA">Bank BCA</option>
                        <option value="Bank Mandiri">Bank Mandiri</option>
                        <option value="Bank BNI">Bank BNI</option>
                        <option value="QRIS">QRIS</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted">Bukti Transfer</label>
                    <input type="file" name="payment_proof" class="form-control premium-card border-0 py-2 px-3 shadow-none" accept="image/*">
                </div>
                <button type="submit" class="btn btn-success w-100 rounded-pill py-2 shadow-sm">
                    Konfirmasi Sekarang
                </button>
            </form>
        </div>
        @endif
        
        <div class="premium-card p-4">
            <a href="{{ route('user.invoices.download-pdf', $booking) }}" class="btn btn-success w-100 rounded-pill mb-3 py-2 shadow-sm">
                <i class="bi bi-file-earmark-pdf me-2"></i>Download PDF
            </a>
            <form action="{{ route('user.invoices.resend-email', $booking) }}" method="POST" class="mb-3">
                @csrf
                <button type="submit" class="btn btn-light w-100 rounded-pill py-2 text-primary border-primary border-opacity-25">
                    <i class="bi bi-envelope me-2"></i>Kirim ke Email
                </button>
            </form>
            <button onclick="window.print()" class="btn btn-light w-100 rounded-pill mb-3 py-2 text-muted">
                <i class="bi bi-printer me-2"></i>Cetak Invoice
            </button>
            <a href="{{ route('user.invoices') }}" class="btn btn-light w-100 rounded-pill py-2 text-muted">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>
        
        <div class="premium-card p-4 mt-4">
            <h6 class="fw-bold mb-3" style="color: var(--text-title)"><i class="bi bi-headset text-success me-2"></i>Bantuan</h6>
            <div class="d-flex align-items-center mb-3">
                <div class="rounded-circle bg-success bg-opacity-10 p-2 me-3 text-success">
                    <i class="bi bi-whatsapp"></i>
                </div>
                <small class="fw-medium">+62 812-3456-7890</small>
            </div>
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-success bg-opacity-10 p-2 me-3 text-success">
                    <i class="bi bi-envelope"></i>
                </div>
                <small class="fw-medium">support@nusantaragreen.com</small>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .sidebar, .top-bar, .col-lg-4 { display: none !important; }
    .col-lg-8 { width: 100% !important; max-width: 100% !important; }
    .main-content { margin-left: 0 !important; }
    .card { box-shadow: none !important; }
    .p-4 { padding: 1rem !important; }
}
</style>
@endsection
