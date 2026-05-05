@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-success text-white py-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">Paket Edukasi Ekowisata</h1>
        <p class="lead">Program edukatif untuk siswa, mahasiswa, dan umum tentang kelestarian alam Indonesia</p>
    </div>
</div>

<!-- Packages Section -->
<div class="container py-5">
    <div class="row g-4">
        <!-- Paket Pelajar -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-success text-white text-center py-4">
                    <i class="bi bi-backpack fs-1"></i>
                    <h3 class="mt-3 mb-0">Paket Pelajar</h3>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="text-success fw-bold">Rp 250.000</h2>
                        <small class="text-muted">per siswa (min. 20 orang)</small>
                    </div>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Kunjungan destinasi selama 1 hari</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Pemandu wisata profesional</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Materi edukasi konservasi alam</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Sertifikat partisipasi</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Transportasi lokal</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Makan siang</li>
                    </ul>
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-success w-100 rounded-pill py-2 fw-bold mt-3">
                            <i class="bi bi-lock-fill me-2"></i>Login untuk Pesan
                        </a>
                    @else
                        <a href="{{ route('booking.education', ['package' => 'pelajar']) }}" class="btn btn-success w-100 rounded-pill py-2 fw-bold mt-3">Pesan Sekarang</a>
                    @endguest
                </div>
            </div>
        </div>

        <!-- Paket Mahasiswa -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-success text-white text-center py-4 position-relative">
                    <span class="badge bg-warning text-dark px-3 py-2 position-absolute top-0 start-50 translate-middle-x mt-2">POPULER</span>
                    <i class="bi bi-mortarboard fs-1 mt-3"></i>
                    <h3 class="mt-3 mb-0">Paket Mahasiswa</h3>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="text-success fw-bold">Rp 450.000</h2>
                        <small class="text-muted">per mahasiswa (min. 15 orang)</small>
                    </div>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Kunjungan destinasi selama 2 hari</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Pemandu ahli konservasi</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Workshop ekosistem & biodiversitas</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Penelitian lapangan terpandu</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Sertifikat & laporan penelitian</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Akomodasi & 3x makan</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Transportasi PP</li>
                    </ul>
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-success w-100 rounded-pill py-2 fw-bold mt-3">
                            <i class="bi bi-lock-fill me-2"></i>Login untuk Pesan
                        </a>
                    @else
                        <a href="{{ route('booking.education', ['package' => 'mahasiswa']) }}" class="btn btn-success w-100 rounded-pill py-2 fw-bold mt-3">Pesan Sekarang</a>
                    @endguest
                </div>
            </div>
        </div>

        <!-- Paket Umum -->
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-success text-white text-center py-4">
                    <i class="bi bi-people fs-1"></i>
                    <h3 class="mt-3 mb-0">Paket Umum</h3>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="text-success fw-bold">Rp 600.000</h2>
                        <small class="text-muted">per peserta (min. 10 orang)</small>
                    </div>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Program 3 hari 2 malam</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Expert guide & instruktur</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Pelatihan sustainable tourism</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Aktivitas outdoor edukatif</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> E-certificate & merchandise</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Penginapan & full board</li>
                        <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i> Dokumentasi profesional</li>
                    </ul>
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-success w-100 rounded-pill py-2 fw-bold mt-3">
                            <i class="bi bi-lock-fill me-2"></i>Login untuk Pesan
                        </a>
                    @else
                        <a href="{{ route('booking.education', ['package' => 'umum']) }}" class="btn btn-success w-100 rounded-pill py-2 fw-bold mt-3">Pesan Sekarang</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Benefits Section -->
<div class="bg-light py-5">
    <div class="container">
        <h2 class="text-center fw-bold text-success mb-5">Mengapa Memilih Program Edukasi Kami?</h2>
        <div class="row g-4">
            <div class="col-md-3 text-center">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <i class="bi bi-award text-success fs-1 mb-3"></i>
                    <h5 class="fw-bold">Bersertifikat</h5>
                    <p class="text-muted small">Sertifikat resmi untuk semua peserta</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <i class="bi bi-person-check text-success fs-1 mb-3"></i>
                    <h5 class="fw-bold">Instruktur Ahli</h5>
                    <p class="text-muted small">Tim profesional berpengalaman</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <i class="bi bi-clipboard-data text-success fs-1 mb-3"></i>
                    <h5 class="fw-bold">Materi Lengkap</h5>
                    <p class="text-muted small">Kurikulum terstruktur & komprehensif</p>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="bg-white p-4 rounded-4 shadow-sm h-100">
                    <i class="bi bi-shield-check text-success fs-1 mb-3"></i>
                    <h5 class="fw-bold">Aman & Nyaman</h5>
                    <p class="text-muted small">Keamanan peserta prioritas utama</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="container py-5 text-center">
    <h3 class="fw-bold mb-3">Tertarik dengan Program Kami?</h3>
    <p class="text-muted mb-4">Hubungi kami untuk informasi lebih lanjut dan booking</p>
    <a href="#" class="btn btn-success btn-lg rounded-pill px-5">Hubungi Kami</a>
</div>
@endsection
