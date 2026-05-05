

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>" class="text-success text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e($destination->name); ?></li>
        </ol>
    </nav>

    <div class="row">
        <!-- Image Gallery (Simplified) -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <img src="<?php echo e($destination->photo ?? 'https://picsum.photos/seed/' . $destination->slug . '/1200/600'); ?>" class="img-fluid w-100" style="object-fit: cover; height: 500px;" alt="<?php echo e($destination->name); ?>">
            </div>
            
            <div class="mt-4">
                <h1 class="fw-bold text-success"><?php echo e($destination->name); ?></h1>
                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-success me-2"><i class="bi bi-geo-alt-fill"></i> <?php echo e($destination->location ?? 'Indonesia'); ?></span>
                    <span class="text-warning"><i class="bi bi-star-fill"></i> <?php echo e($destination->rating ?? 4.5); ?> / 5.0</span>
                </div>
                
                <h4 class="fw-bold mt-4">Deskripsi</h4>
                <p class="text-muted" style="line-height: 1.8;">
                    <?php echo e($destination->description); ?>

                </p>

                <h4 class="fw-bold mt-4">Fasilitas</h4>
                <div class="row g-3 mt-1">
                    <div class="col-md-4">
                        <div class="d-flex align-items-center text-muted">
                            <i class="bi bi-check-circle-fill text-success me-2"></i> Guide Lokal
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center text-muted">
                            <i class="bi bi-check-circle-fill text-success me-2"></i> Makan Siang
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center text-muted">
                            <i class="bi bi-check-circle-fill text-success me-2"></i> Transportasi
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center text-muted">
                            <i class="bi bi-check-circle-fill text-success me-2"></i> Tiket Masuk
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow rounded-4 sticky-top" style="top: 100px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Pesan Sekarang</h5>
                    <h2 class="text-success fw-bold mb-4">Rp <?php echo e(number_format($destination->price, 0, ',', '.')); ?> <small class="fs-6 text-muted fw-normal">/ pax</small></h2>
                    
                    <?php if(auth()->guard()->check()): ?>
                    <!-- Quick Booking Form -->
                    <form action="<?php echo e(route('booking.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="destination_id" value="<?php echo e($destination->id); ?>">
                        <input type="hidden" name="customer_name" value="<?php echo e(Auth::user()->name); ?>">
                        <input type="hidden" name="customer_email" value="<?php echo e(Auth::user()->email); ?>">
                        <input type="hidden" name="customer_phone" value="<?php echo e(Auth::user()->phone ?? '08123456789'); ?>">
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">TANGGAL KUNJUNGAN</label>
                            <input type="date" name="visit_date" class="form-control rounded-3" min="<?php echo e(date('Y-m-d', strtotime('+1 day'))); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">JUMLAH PESERTA</label>
                            <input type="number" name="participants" id="participants" class="form-control rounded-3" value="1" min="1" max="50" required>
                        </div>
                        
                        <div class="bg-light rounded-3 p-3 mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Harga per orang</span>
                                <span>Rp <?php echo e(number_format($destination->price, 0, ',', '.')); ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total</span>
                                <span class="fw-bold text-success" id="totalPrice">Rp <?php echo e(number_format($destination->price, 0, ',', '.')); ?></span>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold py-3 shadow-sm">
                            <i class="bi bi-check-circle me-2"></i>Pesan & Lihat Invoice
                        </button>
                    </form>
                    <?php else: ?>
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span>Termasuk tiket masuk</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span>Guide lokal berpengalaman</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                            <span>Asuransi perjalanan</span>
                        </div>
                    </div>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-success w-100 rounded-pill fw-bold py-3 shadow-sm">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login untuk Memesan
                    </a>
                    <?php endif; ?>
                    
                    <hr class="my-4">
                    <small class="text-muted d-block text-center"><i class="bi bi-shield-check text-success"></i> Jaminan Harga Terbaik</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const participantsInput = document.getElementById('participants');
    const totalPriceEl = document.getElementById('totalPrice');
    const basePrice = <?php echo e($destination->price); ?>;
    
    function formatRupiah(num) {
        return 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    
    if (participantsInput) {
        participantsInput.addEventListener('input', function() {
            const pax = parseInt(this.value) || 1;
            const total = basePrice * pax;
            totalPriceEl.textContent = formatRupiah(total);
        });
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ekowisataID\resources\views/destinations/show.blade.php ENDPATH**/ ?>