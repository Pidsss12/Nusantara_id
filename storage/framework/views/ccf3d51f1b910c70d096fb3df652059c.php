<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<div class="bg-success text-white py-5">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">Jelajahi Semua Destinasi</h1>
        <p class="lead">Temukan <?php echo e($destinations->count()); ?> destinasi ekowisata terbaik di seluruh Indonesia</p>
    </div>
</div>

<!-- Filters -->
<div class="container mt-4">
    <?php if(session('info')): ?>
    <div class="alert alert-info alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
        <i class="bi bi-info-circle-fill me-2"></i> <?php echo e(session('info')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
</div>

<div class="container py-4">
    <div class="row g-3">
        <div class="col-md-6">
            <div class="input-group input-group-lg">
                <span class="input-group-text bg-white"><i class="bi bi-search text-success"></i></span>
                <input type="text" class="form-control" id="searchInput" placeholder="Cari destinasi...">
                <button class="btn btn-success px-4" type="button" onclick="filterDestinations()">Cari</button>
            </div>
        </div>
        <div class="col-md-3">
            <select class="form-select form-select-lg" id="provinceFilter" onchange="filterDestinations()">
                <option value="">Semua Provinsi</option>
                <?php $__currentLoopData = $destinations->pluck('province.name')->unique()->filter()->sort(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($province); ?>"><?php echo e($province); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select form-select-lg" id="categoryFilter" onchange="filterDestinations()">
                <option value="">Semua Kategori</option>
                <?php $__currentLoopData = $destinations->pluck('category')->unique()->filter()->sort(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category); ?>"><?php echo e($category); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
</div>

<!-- Destinations Grid -->
<div class="container pb-5">
    <div class="row g-4" id="destinationsGrid">
        <?php $__empty_1 = true; $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-lg-4 col-md-6 destination-card" 
             data-province="<?php echo e($dest->province->name ?? ''); ?>" 
             data-category="<?php echo e($dest->category); ?>"
             data-name="<?php echo e(strtolower($dest->name)); ?>">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                <div class="position-relative">
                    <img src="<?php echo e($dest->photo ?? 'https://picsum.photos/seed/' . $dest->slug . '/600/400'); ?>" 
                         class="card-img-top" style="height: 250px; object-fit: cover;" alt="<?php echo e($dest->name); ?>">
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-white text-success shadow px-3 py-2 rounded-pill fw-bold">
                            <i class="bi bi-star-fill text-warning"></i> <?php echo e(number_format($dest->rating ?? 4.5, 1)); ?>

                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 mb-3"><?php echo e($dest->province->name ?? 'Indonesia'); ?></span>
                    <h5 class="card-title fw-bold mb-2"><?php echo e($dest->name); ?></h5>
                    <p class="card-text text-muted small"><?php echo e(Str::limit($dest->description, 80)); ?></p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <small class="text-muted d-block text-uppercase" style="font-size: 0.65rem;">MULAI DARI</small>
                            <h5 class="text-success fw-bold mb-0">Rp <?php echo e(number_format($dest->price, 0, ',', '.')); ?></h5>
                        </div>
                        <a href="<?php echo e(route('destination.show', $dest->id)); ?>" class="btn btn-success rounded-pill px-4 py-2 fw-bold shadow-sm">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12 text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted"></i>
            <h5 class="mt-3">Belum ada destinasi</h5>
            <p class="text-muted">Destinasi akan segera ditambahkan</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    window.filterDestinations = function() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const selectedProvince = document.getElementById('provinceFilter').value;
        const selectedCategory = document.getElementById('categoryFilter').value;
        const cards = document.querySelectorAll('.destination-card');
        let visibleCount = 0;
        
        cards.forEach(card => {
            const cardProvince = card.getAttribute('data-province');
            const cardCategory = card.getAttribute('data-category');
            const cardName = card.getAttribute('data-name');
            
            let show = true;
            
            if (selectedProvince && cardProvince !== selectedProvince) show = false;
            if (selectedCategory && cardCategory !== selectedCategory) show = false;
            if (searchTerm && !cardName.includes(searchTerm)) show = false;
            
            card.style.display = show ? 'block' : 'none';
            if (show) visibleCount++;
        });
    }
    
    document.getElementById('searchInput').addEventListener('keyup', filterDestinations);
});
</script>

<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
    }
    .bg-success-subtle {
        background-color: rgba(25, 135, 84, 0.1) !important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Nusantara_id\resources\views/destinations/index.blade.php ENDPATH**/ ?>