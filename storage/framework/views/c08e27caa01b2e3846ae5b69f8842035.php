<?php $__env->startSection('content'); ?>
<div class="bg-success text-white py-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">Paket Edukasi Ekowisata</h1>
        <p class="lead">Program edukatif untuk siswa, mahasiswa, dan umum tentang kelestarian alam Indonesia</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-success text-white text-center py-4">
                    <span class="badge rounded-pill mb-2 px-3" style="background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.4);">
                        <i class="bi bi-clock me-1"></i> 1 Hari
                    </span>
                    <div class="d-block mt-2">
                        <i class="bi bi-backpack fs-1"></i>
                    </div>
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
                    <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-success w-100 rounded-pill py-2 fw-bold mt-3">
                            <i class="bi bi-lock-fill me-2"></i>Login untuk Pesan
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('booking.education', ['package' => 'pelajar'])); ?>" class="btn btn-success w-100 rounded-pill py-2 fw-bold mt-3">Pesan Sekarang</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-success text-white text-center py-4 position-relative">
                    <span class="badge bg-warning text-dark px-3 py-2 position-absolute top-0 start-50 translate-middle-x mt-2 fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">POPULER</span>
                    
                    <div class="mt-4 mb-2">
                        <span class="badge rounded-pill px-3" style="background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.4);">
                            <i class="bi bi-clock me-1"></i> 2 Hari 1 Malam
                        </span>
                    </div>
                    
                    <i class="bi bi-mortarboard fs-1"></i>
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
                    </ul>
                    <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-success w-100 rounded-pill py-2 fw-bold mt-3">
                            <i class="bi bi-lock-fill me-2"></i>Login untuk Pesan
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('booking.education', ['package' => 'mahasiswa'])); ?>" class="btn btn-success w-100 rounded-pill py-2 fw-bold mt-3">Pesan Sekarang</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-success text-white text-center py-4">
                    <span class="badge rounded-pill mb-2 px-3" style="background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.4);">
                        <i class="bi bi-clock me-1"></i> 3 Hari 2 Malam
                    </span>
                    <div class="d-block mt-2">
                        <i class="bi bi-people fs-1"></i>
                    </div>
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
                    </ul>
                    <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-success w-100 rounded-pill py-2 fw-bold mt-3">
                            <i class="bi bi-lock-fill me-2"></i>Login untuk Pesan
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('booking.education', ['package' => 'umum'])); ?>" class="btn btn-success w-100 rounded-pill py-2 fw-bold mt-3">Pesan Sekarang</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Nusantara_id\resources\views/education.blade.php ENDPATH**/ ?>