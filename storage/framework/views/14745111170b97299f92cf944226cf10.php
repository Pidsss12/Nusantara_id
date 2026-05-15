<?php $__env->startSection('content'); ?>
<div class="hero-section position-relative d-flex align-items-center justify-content-center text-white" style="height: 75vh; overflow: hidden; background-color: #064e3b;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background: url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=1600&auto=format&fit=crop') center/cover no-repeat fixed;
                animation: zoomBackground 20s infinite alternate ease-in-out;
                z-index: 1;">
    </div>

    <div class="position-absolute top-0 start-0 w-100 h-100" 
         style="background: linear-gradient(135deg, rgba(25,135,84,0.7) 0%, rgba(20,108,67,0.85) 100%);
                z-index: 2;">
    </div>

    <div class="position-absolute top-0 start-0 w-100 h-100 overlay-fog" style="z-index: 3; pointer-events: none;"></div>

    <div class="container text-center position-relative" style="z-index: 5;">
        <h1 class="display-2 fw-bold mb-4 text-white" style="text-shadow: 2px 4px 15px rgba(0,0,0,0.4);">
            Jelajahi Surga Nusantara
        </h1>
        <p class="lead fs-3 mb-5 text-white" style="text-shadow: 1px 2px 8px rgba(0,0,0,0.4);">
            Temukan keindahan ekowisata di 38 Provinsi Indonesia
        </p>
        <div class="d-flex gap-3 justify-content-center">
            <a href="<?php echo e(route('destinations.index')); ?>" class="btn btn-light btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg">
                <i class="bi bi-compass me-2"></i> Lihat Destinasi
            </a>
            <a href="#tentang" class="btn btn-outline-light btn-lg rounded-pill px-5 py-3 fw-bold smooth-scroll">
                <i class="bi bi-info-circle me-2"></i> Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
</div>

<div class="container py-5 mt-5" id="destinasi">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold text-success mb-3">Destinasi Pilihan</h2>
        <p class="text-muted fs-5">Rekomendasi wisata alam terbaik yang wajib kamu kunjungi</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                <div class="position-relative">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRS1LQb4mx-Y9VS2j0A3mD9skfW8yIUo3s_pg&s" 
                         class="card-img-top" alt="Raja Ampat" style="height: 280px; object-fit: cover;">
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-white text-success shadow px-3 py-2 rounded-pill fw-bold">
                            <i class="bi bi-star-fill text-warning"></i> 4.9
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 mb-3">Papua Barat Daya</span>
                    <h4 class="card-title fw-bold mb-3">Raja Ampat Paradise</h4>
                    <p class="card-text text-muted">Surga bawah laut dengan keanekaragaman hayati terkaya di dunia. Snorkeling dan diving di perairan kristal yang menakjubkan.</p>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>
                            <small class="text-muted d-block text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Mulai dari</small>
                            <h5 class="text-success fw-bold mb-0">Rp 5.500.000</h5>
                        </div>
                        <button class="btn btn-success rounded-pill px-4 py-2 fw-bold shadow-sm" 
                                data-bs-toggle="modal" data-bs-target="#detailModal"
                                onclick="showDetail('Raja Ampat Paradise', 'Surga bawah laut dengan keanekaragaman hayati terkaya di dunia. Snorkeling dan diving di perairan kristal yang menakjubkan. Nikmati keindahan underwater yang spektakuler.', 15, 8, 12, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRS1LQb4mx-Y9VS2j0A3mD9skfW8yIUo3s_pg&s')">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                <div class="position-relative">
                    <img src="https://www.indonesia.travel/contentassets/ea5919f254c2494c9579fa4ce3522bcb/candi-borobudur-1.jpeg" 
                         class="card-img-top" alt="Borobudur" style="height: 280px; object-fit: cover;">
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-white text-success shadow px-3 py-2 rounded-pill fw-bold">
                            <i class="bi bi-star-fill text-warning"></i> 4.8
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 mb-3">Jawa Tengah</span>
                    <h4 class="card-title fw-bold mb-3">Sunrise Borobudur</h4>
                    <p class="card-text text-muted">Menikmati kemegahan matahari terbit dari candi Buddha terbesar di dunia. Pengalaman spiritual dan budaya yang tak terlupakan.</p>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>
                            <small class="text-muted d-block text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Mulai dari</small>
                            <h5 class="text-success fw-bold mb-0">Rp 750.000</h5>
                        </div>
                        <button class="btn btn-success rounded-pill px-4 py-2 fw-bold shadow-sm"
                                data-bs-toggle="modal" data-bs-target="#detailModal"
                                onclick="showDetail('Sunrise Borobudur', 'Menikmati kemegahan matahari terbit dari candi Buddha terbesar di dunia. Pengalaman spiritual dan budaya yang tak terlupakan dengan pemandangan matahari terbit yang spektakuler.', 25, 10, 8, 'https://www.indonesia.travel/contentassets/ea5919f254c2494c9579fa4ce3522bcb/candi-borobudur-1.jpeg')">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                <div class="position-relative">
                    <img src="https://indonesiajuara.asia/wp-content/uploads/2024/12/Pulau-Padar-di-Taman-Nasional-Komodo-_-IndonesiaJuara-Trip_11zon.webp" 
                         class="card-img-top" alt="Komodo" style="height: 280px; object-fit: cover;">
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-white text-success shadow px-3 py-2 rounded-pill fw-bold">
                            <i class="bi bi-star-fill text-warning"></i> 4.9
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1 mb-3">Nusa Tenggara Timur</span>
                    <h4 class="card-title fw-bold mb-3">Taman Nasional Komodo</h4>
                    <p class="card-text text-muted">Petualangan bertemu hewan purba komodo di habitat aslinya. Trekking di savana dan pantai pink yang eksotis.</p>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>
                            <small class="text-muted d-block text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">Mulai dari</small>
                            <h5 class="text-success fw-bold mb-0">Rp 2.100.000</h5>
                        </div>
                        <button class="btn btn-success rounded-pill px-4 py-2 fw-bold shadow-sm"
                                data-bs-toggle="modal" data-bs-target="#detailModal"
                                onclick="showDetail('Taman Nasional Komodo', 'Petualangan bertemu hewan purba komodo di habitat aslinya. Trekking di savana dan pantai pink yang eksotis. Pengalaman unik bertemu hewan prasejarah yang masih hidup.', 18, 12, 15, 'https://indonesiajuara.asia/wp-content/uploads/2024/12/Pulau-Padar-di-Taman-Nasional-Komodo-_-IndonesiaJuara-Trip_11zon.webp')">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                <img src="https://images.unsplash.com/photo-1605640840605-14ac1855827b?w=400" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="fw-bold mb-2">Gunung Bromo</h5>
                    <p class="text-muted small">Sunrise spektakuler di lautan pasir</p>
                    <span class="badge bg-success-subtle text-success">Jawa Timur</span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?w=400" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="fw-bold mb-2">Danau Toba</h5>
                    <p class="text-muted small">Danau vulkanik terbesar di dunia</p>
                    <span class="badge bg-success-subtle text-success">Sumatera Utara</span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=400" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="fw-bold mb-2">Labuan Bajo</h5>
                    <p class="text-muted small">Gerbang menuju Pulau Komodo</p>
                    <span class="badge bg-success-subtle text-success">NTT</span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift">
                <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400" class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="fw-bold mb-2">Wakatobi</h5>
                    <p class="text-muted small">Surga diving kelas dunia</p>
                    <span class="badge bg-success-subtle text-success">Sulawesi Tenggara</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-light py-5" id="tentang">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="display-6 fw-bold text-success mb-4">Tentang NusantaraGreen</h2>
                <p class="text-muted mb-3">
                    <strong>NusantaraGreen</strong> adalah platform ekowisata terpercaya yang menghubungkan wisatawan dengan keindahan alam Indonesia yang luar biasa.
                </p>
                <p class="text-muted mb-3">
                    Kami berkomitmen untuk mempromosikan pariwisata berkelanjutan yang menghormati lingkungan dan budaya lokal, sambil memberikan pengalaman tak terlupakan bagi setiap pengunjung.
                </p>
                <div class="row mt-4">
                    <div class="col-4 text-center">
                        <h3 class="text-success fw-bold">38</h3>
                        <small class="text-muted">Provinsi</small>
                    </div>
                    <div class="col-4 text-center">
                        <h3 class="text-success fw-bold">100+</h3>
                        <small class="text-muted">Destinasi</small>
                    </div>
                    <div class="col-4 text-center">
                        <h3 class="text-success fw-bold">4.9</h3>
                        <small class="text-muted">Rating</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <img src="<?php echo e(asset('img/logo.png')); ?>" class="img-fluid" style="max-width: 400px;" alt="NusantaraGreen Logo">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-success text-white py-5">
    <div class="container text-center">
        <h2 class="display-6 fw-bold mb-3">Siap Memulai Petualangan Anda?</h2>
        <p class="lead mb-4">Jelajahi lebih dari 100+ destinasi ekowisata pilihan di seluruh Indonesia</p>
        <a href="#" class="btn btn-light btn-lg rounded-pill px-5 py-3 fw-bold shadow">
            <i class="bi bi-grid-3x3-gap me-2"></i> Lihat Semua Destinasi
        </a>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 overflow-hidden">
            <div class="modal-header bg-success text-white border-0">
                <h5 class="modal-title fw-bold" id="modalTitle">Detail Destinasi</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" class="w-100 rounded-3 mb-3" style="height: 300px; object-fit: cover;">
                <p id="modalDescription" class="text-muted mb-4"></p>
                
                <h6 class="fw-bold text-success mb-3"><i class="bi bi-building"></i> Fasilitas Tersedia:</h6>
                <div class="row text-center">
                    <div class="col-4">
                        <div class="p-3 bg-light rounded-3">
                            <i class="bi bi-shop text-success fs-3"></i>
                            <p class="mb-0 mt-2 fw-bold" id="modalRestaurant">0</p>
                            <small class="text-muted">Restoran</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 bg-light rounded-3">
                            <i class="bi bi-building text-success fs-3"></i>
                            <p class="mb-0 mt-2 fw-bold" id="modalResort">0</p>
                            <small class="text-muted">Resort</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 bg-light rounded-3">
                            <i class="bi bi-house-fill text-success fs-3"></i>
                            <p class="mb-0 mt-2 fw-bold" id="modalVilla">0</p>
                            <small class="text-muted">Villa</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-success rounded-pill px-4">
                        <i class="bi bi-lock-fill me-2"></i>Login untuk Pesan
                    </a>
                <?php else: ?>
                    <a href="#" class="btn btn-success rounded-pill px-4">
                        <i class="bi bi-cart-check me-2"></i>Pesan Sekarang
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
function showDetail(title, description, restaurant, resort, villa, image) {
    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalDescription').innerText = description;
    document.getElementById('modalRestaurant').innerText = restaurant;
    document.getElementById('modalResort').innerText = resort;
    document.getElementById('modalVilla').innerText = villa;
    document.getElementById('modalImage').src = image;
}
</script>

<style>
    html {
        scroll-behavior: smooth;
    }
    
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
    }
    
    .bg-success-subtle {
        background-color: rgba(25, 135, 84, 0.1) !important;
    }

    /* Animasi Zoom Background Utama */
    @keyframes zoomBackground {
        from { transform: scale(1); }
        to { transform: scale(1.15); }
    }

    /* Layer Kabut Bergerak untuk Efek Realistik */
    .overlay-fog {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: url('https://www.transparenttextures.com/patterns/fog.png');
        opacity: 0.4;
        animation: moveFog 40s linear infinite;
    }

    @keyframes moveFog {
        from { background-position: 0 0; }
        to { background-position: 1000px 0; }
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Nusantara_id\resources\views/welcome.blade.php ENDPATH**/ ?>