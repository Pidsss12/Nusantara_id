

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<div class="bg-success text-white py-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">Tentang NusantaraGreen</h1>
        <p class="lead">Solusi Terpadu untuk Ekowisata Berkelanjutan di Indonesia</p>
    </div>
</div>

<!-- About Section -->
<div class="container py-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-6">
            <h2 class="fw-bold text-success mb-4">Visi & Misi Kami</h2>
            <p class="text-muted mb-4">
                NusantaraGreen adalah platform inovatif yang didedikasikan untuk mempromosikan dan memfasilitasi ekowisata di seluruh penjuru Indonesia. Kami percaya bahwa pariwisata yang bertanggung jawab dapat menjadi motor penggerak pelestarian alam dan pemberdayaan masyarakat lokal.
            </p>
            <div class="row g-4">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-heart-fill text-success fs-3 me-3"></i>
                        <div>
                            <h5 class="fw-bold mb-0">Pelestarian</h5>
                            <small class="text-muted">Menjaga keanekaragaman hayati</small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-people-fill text-success fs-3 me-3"></i>
                        <div>
                            <h5 class="fw-bold mb-0">Komunitas</h5>
                            <small class="text-muted">Pemberdayaan warga lokal</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="bg-light p-5 text-center">
                    <i class="bi bi-globe-asia-australia text-success" style="font-size: 5rem;"></i>
                    <h4 class="mt-3 fw-bold">Ekowisata Indonesia</h4>
                    <p class="text-muted">Menjelajahi keindahan alam tanpa merusaknya.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <h2 class="fw-bold text-success">50+</h2>
                <p class="text-muted mb-0">Destinasi Pilihan</p>
            </div>
            <div class="col-md-3">
                <h2 class="fw-bold text-success">10k+</h2>
                <p class="text-muted mb-0">Wisatawan Puas</p>
            </div>
            <div class="col-md-3">
                <h2 class="fw-bold text-success">15+</h2>
                <p class="text-muted mb-0">Provinsi Terjangkau</p>
            </div>
            <div class="col-md-3">
                <h2 class="fw-bold text-success">100%</h2>
                <p class="text-muted mb-0">Ramah Lingkungan</p>
            </div>
        </div>
    </div>
</div>

<!-- Team/Contact CTA Section -->
<div class="container py-5 text-center">
    <h3 class="fw-bold mb-3">Siap untuk Berpetualang?</h3>
    <p class="text-muted mb-4">Mari berkontribusi pada pelestarian alam sambil menikmati keindahan Nusantara.</p>
    <div class="d-flex justify-content-center gap-3">
        <a href="<?php echo e(route('destinations.index')); ?>" class="btn btn-success btn-lg rounded-pill px-5">Lihat Destinasi</a>
        <a href="#" class="btn btn-outline-success btn-lg rounded-pill px-5">Hubungi Kami</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ekowisataID\resources\views/about.blade.php ENDPATH**/ ?>