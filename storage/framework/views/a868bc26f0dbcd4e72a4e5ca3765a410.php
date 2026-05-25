<?php $__env->startSection('content'); ?>
<style>
    .error-bubble {
        position: absolute;
        background: #dc3545;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        z-index: 1000;
        margin-top: 4px;
        display: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        pointer-events: none;
    }

    .error-bubble::after {
        content: '';
        position: absolute;
        top: -8px;
        left: 15px;
        border-width: 4px;
        border-style: solid;
        border-color: transparent transparent #dc3545 transparent;
    }

    .is-invalid-custom {
        border-color: #dc3545 !important;
        background-color: #fff8f8 !important;
    }

    .input-wrapper {
        position: relative;
    }

    .transition-hover { transition: all 0.3s ease; }
    .transition-hover:hover { transform: translateY(-2px); filter: brightness(1.1); }

    /* Denah Kursi 4 Kursi (2-2) */
    .seat-container {
        display: grid;
        grid-template-columns: repeat(2, auto) 25px repeat(2, auto);
        gap: 8px;
        justify-content: center;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 12px;
    }
    .seat {
        width: 35px;
        height: 35px;
        background-color: #ffffff;
        border: 2px solid #dee2e6;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        color: #ccc;
    }
    .seat.selected { background-color: #198754 !important; border-color: #198754 !important; color: white;}
    .seat.occupied { background-color: #dc3545 !important; border-color: #dc3545 !important; cursor: not-allowed; color: white; }
    .aisle { width: 25px; }
</style>

<?php
    $occupiedSeats = [];
    if (!empty($destination->occupied_seats)) {
        if (is_array($destination->occupied_seats)) {
            $occupiedSeats = array_map('intval', $destination->occupied_seats);
        } else {
            $occupiedSeats = array_filter(
                array_map('intval', explode(',', str_replace(' ', '', $destination->occupied_seats)))
            );
        }
    }
    $totalSeats = 4;
?>

<div class="container py-5">
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>" class="text-success text-decoration-none">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e($destination->name); ?></li>
        </ol>
    </nav>

    <div class="row">
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
                <p class="text-muted" style="line-height: 1.8;"><?php echo e($destination->description); ?></p>

                <h4 class="fw-bold mt-4">Fasilitas</h4>
                <div class="row g-3 mt-1 text-muted">
                    <div class="col-md-4"><i class="bi bi-check-circle-fill text-success me-2"></i> Guide Lokal</div>
                    <div class="col-md-4"><i class="bi bi-check-circle-fill text-success me-2"></i> Restoran & Menu Pilihan</div>
                    <div class="col-md-4"><i class="bi bi-check-circle-fill text-success me-2"></i> Transportasi</div>
                    <div class="col-md-4"><i class="bi bi-check-circle-fill text-success me-2"></i> Tiket Masuk</div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-lg rounded-4 sticky-top" style="top: 100px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Pesan Sekarang</h5>
                    <h2 class="text-success fw-bold mb-4">
                        Rp <?php echo e(number_format($destination->price, 0, ',', '.')); ?> 
                        <small class="fs-6 text-muted fw-normal">/ paket dasar</small>
                    </h2>
                    
                    <?php if(auth()->guard()->check()): ?>
                    <form action="<?php echo e(route('booking.store')); ?>" method="POST" id="bookingForm" novalidate>
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="destination_id" value="<?php echo e($destination->id); ?>">
                        
                        <div class="mb-4 input-wrapper">
                            <label class="form-label small fw-bold text-muted">JUMLAH PESERTA</label>
                            <input type="number" name="participants" id="participants" class="form-control rounded-3" value="1" min="1" required>
                            <div class="error-bubble" id="err-participants">✖ Masukkan jumlah peserta</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4 input-wrapper">
                                <label class="form-label small fw-bold text-muted">TANGGAL MULAI</label>
                                <input type="date" name="start_date" id="startDate" class="form-control rounded-3" min="<?php echo e(date('Y-m-d')); ?>" required>
                                <div class="error-bubble" id="err-startDate">✖ Pilih tanggal</div>
                            </div>
                            <div class="col-md-6 mb-4 input-wrapper">
                                <label class="form-label small fw-bold text-muted">TANGGAL AKHIR</label>
                                <input type="date" name="end_date" id="endDate" class="form-control rounded-3" min="<?php echo e(date('Y-m-d')); ?>" required>
                                <div class="error-bubble" id="err-endDate">✖ Pilih tanggal</div>
                            </div>
                        </div>

                        <div class="mb-4 input-wrapper">
                            <label class="form-label small fw-bold text-muted">PILIH HOTEL / PENGINAPAN</label>
                            <select class="form-select rounded-3" id="hotelSelect" name="hotel" required>
                                <option value="">-- Pilih Hotel --</option>
                                </select>
                            <div class="error-bubble" id="err-hotelSelect">✖ Pilih hotel</div>
                        </div>

                        <div class="mb-4 input-wrapper">
                            <label class="form-label small fw-bold text-muted">PILIH RESTORAN</label>
                            <select class="form-select rounded-3" id="restaurantSelect" name="restaurant" required>
                                <option value="">-- Pilih Restoran --</option>
                                </select>
                            <div class="error-bubble" id="err-restaurantSelect">✖ Pilih restoran</div>
                        </div>

                        <div id="menuSection" class="mb-4 d-none">
                            <div class="mb-3 input-wrapper">
                                <label class="form-label small fw-bold text-muted">PILIH MENU</label>
                                <select class="form-select rounded-3" id="menuSelect" name="menu" required></select>
                                <div class="error-bubble" id="err-menuSelect">✖ Pilih menu makanan</div>
                            </div>
                            <div class="input-wrapper">
                                <label class="form-label small fw-bold text-muted">FREKUENSI MAKAN (PER HARI)</label>
                                <select class="form-select rounded-3" id="mealFrequency" name="meal_frequency" required>
                                    <option value="">-- Pilih Frekuensi --</option>
                                    <option value="1">1x Sehari</option>
                                    <option value="2">2x Sehari</option>
                                    <option value="3">3x Sehari</option>
                                </select>
                                <div class="error-bubble" id="err-mealFrequency">✖ Pilih frekuensi makan</div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">TRANSPORTASI (Bayar 1x)</label>
                            <div class="d-flex gap-2 mb-2">
                                <input type="radio" class="btn-check" name="transport" id="darat" value="Darat" data-price="150000" checked>
                                <label class="btn btn-outline-success w-100 rounded-3 py-2" for="darat">
                                    <i class="bi bi-bus-front"></i> Darat<br><small>Rp 150rb</small>
                                </label>

                                <input type="radio" class="btn-check" name="transport" id="udara" value="Udara" data-price="850000">
                                <label class="btn btn-outline-success w-100 rounded-3 py-2" for="udara">
                                    <i class="bi bi-airplane"></i> Udara<br><small>Rp 850rb</small>
                                </label>
                            </div>
                            <div id="taxiInfo" class="alert alert-info py-2 px-3 rounded-3 d-none mb-0" style="font-size: 0.8rem;">
                                <i class="bi bi-info-circle-fill me-1"></i> Bonus: <strong>Free Taxi ke Hotel!</strong>
                            </div>
                        </div>

                        <div id="seatSection" class="mb-4 d-none">
                            <label class="form-label small fw-bold text-muted d-block text-center mb-2">PILIH KURSI (2 - 2)</label>
                            
                            <div class="seat-container">
                                <div class="seat <?php echo e(in_array(1, $occupiedSeats, true) ? 'occupied' : ''); ?>" data-seat="1"></div>
                                <div class="seat <?php echo e(in_array(2, $occupiedSeats, true) ? 'occupied' : ''); ?>" data-seat="2"></div>
                                
                                <div class="aisle"></div>
                                
                                <div class="seat <?php echo e(in_array(3, $occupiedSeats, true) ? 'occupied' : ''); ?>" data-seat="3"></div>
                                <div class="seat <?php echo e(in_array(4, $occupiedSeats, true) ? 'occupied' : ''); ?>" data-seat="4"></div>
                            </div>
                        </div>

                        <div class="bg-light rounded-3 p-3 mb-3">
                            <div class="text-center mb-2">
                                <span class="badge bg-secondary mb-2" id="durationBadge">Durasi: 1 Hari</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1 small text-muted">
                                <span>Paket dasar wisata (x<span class="pax-count">1</span> pax)</span>
                                <span id="destPriceText">Rp 0</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1 small text-muted">
                                <span>Hotel (<span class="day-count">1</span> hr x <span class="pax-count">1</span> pax)</span>
                                <span id="hotelPriceText">Rp 0</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1 small text-muted">
                                <span>Makan (<span id="freqText">0</span>x/hr x <span class="pax-count">1</span> pax x <span class="day-count">1</span> hr)</span>
                                <span id="mealPriceText">Rp 0</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 small text-muted">
                                <span>Trans (Sekali Bayar x <span class="pax-count">1</span> pax)</span>
                                <span id="transPriceText">Rp 0</span>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">Total</span>
                                <span class="fw-bold text-success fs-4" id="totalPrice">Rp 0</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold py-3 shadow-sm border-0 transition-hover">
                            <i class="bi bi-cart-check me-2"></i>Pesan Sekarang
                        </button>
                    </form>
                    <?php else: ?>
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-person-lock fs-1 mb-3 d-block"></i>
                        <p>Silakan login untuk memesan</p>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-success w-100 rounded-pill fw-bold">Login</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('bookingForm');
    const participantsInput = document.getElementById('participants');
    const startDateInput = document.getElementById('startDate');
    const endDateInput = document.getElementById('endDate');
    const hotelSelect = document.getElementById('hotelSelect');
    const restaurantSelect = document.getElementById('restaurantSelect');
    const menuSelect = document.getElementById('menuSelect');
    const mealFrequency = document.getElementById('mealFrequency');
    const menuSection = document.getElementById('menuSection');
    const seatSection = document.getElementById('seatSection');
    const taxiInfo = document.getElementById('taxiInfo');
    const transportRadios = document.querySelectorAll('input[name="transport"]');
    const durationBadge = document.getElementById('durationBadge');
    const seats = document.querySelectorAll('.seat:not(.occupied)');
    
    // NAMA DESTINASI DARI BACKEND
    const currentDestination = <?php echo json_encode($destination->name ?? 'Default', 15, 512) ?>;

    // DATA DINAMIS BERDASARKAN DESTINASI
    const locationData = <?php echo json_encode(config('travel_pricing.destinations'), 15, 512) ?>;
    const unavailableHotels = <?php echo json_encode($destination->unavailable_hotels ?? [], 15, 512) ?>;
    const unavailableRestaurants = <?php echo json_encode($destination->unavailable_restaurants ?? [], 15, 512) ?>;
    const unavailableMenus = <?php echo json_encode($destination->unavailable_menus ?? [], 15, 512) ?>;

    const destData = locationData[currentDestination] || locationData["Default"];
    const basePrice = <?php echo e($destination->price ?? 0); ?>;

    function formatRupiah(num) {
        return 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // INIT DATA HOTEL & RESTORAN
    if(hotelSelect && restaurantSelect) {
        destData.hotels.forEach(hotel => {
            const opt = document.createElement('option');
            opt.value = hotel.name;
            opt.setAttribute('data-price', hotel.price);
            if (unavailableHotels.includes(hotel.name)) {
                opt.disabled = true;
                opt.textContent = `${hotel.name} - Penuh`;
            } else {
                opt.textContent = `${hotel.name} (kisaran ${formatRupiah(hotel.price)}/mlm)`;
            }
            hotelSelect.appendChild(opt);
        });

        destData.restaurants.forEach(resto => {
            const opt = document.createElement('option');
            opt.value = resto.name;
            if (unavailableRestaurants.includes(resto.name)) {
                opt.disabled = true;
                opt.textContent = `${resto.name} - Tidak tersedia`;
            } else {
                opt.textContent = resto.name;
            }
            restaurantSelect.appendChild(opt);
        });
    }

    seats.forEach(seat => {
        seat.addEventListener('click', function() {
            const max = parseInt(participantsInput.value) || 1;
            const selectedCount = document.querySelectorAll('.seat.selected').length;
            if (this.classList.contains('selected')) {
                this.classList.remove('selected');
            } else if (selectedCount < max) {
                this.classList.add('selected');
            }
        });
    });

    if(form) {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            let firstField = null;
            const requiredFields = form.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                const bubble = document.getElementById('err-' + field.id);
                if (!field.value || field.value === "") {
                    field.classList.add('is-invalid-custom');
                    if(bubble) bubble.style.display = 'block';
                    isValid = false;
                    if(!firstField) firstField = field;
                } else {
                    field.classList.remove('is-invalid-custom');
                    if(bubble) bubble.style.display = 'none';
                }
            });

            // VALIDASI & OPER DATA KURSI KHUSUS OPSI UDARA
            const udaraRadio = document.getElementById('udara');
            if (udaraRadio && udaraRadio.checked) {
                const max = parseInt(participantsInput.value) || 1;
                const selectedSeats = document.querySelectorAll('.seat.selected');
                
                if (selectedSeats.length !== max) {
                    alert(`Silakan pilih tepat ${max} kursi sesuai dengan jumlah peserta.`);
                    isValid = false;
                    if(!firstField) firstField = seatSection;
                } else {
                    // Membersihkan input kursi lama jika ada sebelum form dikirim
                    form.querySelectorAll('input[name="seats[]"]').forEach(el => el.remove());
                    
                    // Membuat input hidden dinamis agar data kursi terkirim ke Laravel Backend
                    selectedSeats.forEach(s => {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'seats[]';
                        hiddenInput.value = s.getAttribute('data-seat');
                        form.appendChild(hiddenInput);
                    });
                }
            }

            if(!isValid) { e.preventDefault(); if(firstField && firstField.focus) firstField.focus(); }
        });

        form.querySelectorAll('input, select').forEach(el => {
            el.addEventListener('input', function() {
                this.classList.remove('is-invalid-custom');
                const bubble = document.getElementById('err-' + this.id);
                if(bubble) bubble.style.display = 'none';
            });
        });
    }

    function calculateTotal() {
        const pax = parseInt(participantsInput.value) || 1;
        let days = 1;

        // Otomatis reset kursi jika jumlah peserta dikurangi di tengah jalan
        const selectedSeats = document.querySelectorAll('.seat.selected');
        if (selectedSeats.length > pax) {
            selectedSeats.forEach(s => s.classList.remove('selected'));
        }

        if (startDateInput.value) {
            const startLimit = new Date(startDateInput.value);
            const maxDate = new Date(startLimit);
            maxDate.setDate(maxDate.getDate() + 4); 
            endDateInput.min = startDateInput.value;
            endDateInput.max = maxDate.toISOString().split('T')[0];
        }

        if (startDateInput.value && endDateInput.value) {
            const start = new Date(startDateInput.value);
            const end = new Date(endDateInput.value);
            const diffDays = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
            
            if(diffDays > 5) {
                alert("Maksimal waktu wisata adalah 5 Hari.");
                endDateInput.value = "";
                days = 1;
            } else {
                days = diffDays > 0 ? diffDays : 1;
            }
        }
        
        durationBadge.textContent = `Durasi: ${days} Hari`;
        document.querySelectorAll('.day-count').forEach(el => el.textContent = days);
        document.querySelectorAll('.pax-count').forEach(el => el.textContent = pax);

        const totalDest = basePrice * pax;

        const hotelPrice = parseInt(hotelSelect.options[hotelSelect.selectedIndex]?.getAttribute('data-price')) || 0;
        const totalHotel = hotelPrice * pax * days;
        
        const freq = parseInt(mealFrequency.value) || 0;
        document.getElementById('freqText').textContent = freq;
        const mealPrice = parseInt(menuSelect.options[menuSelect.selectedIndex]?.getAttribute('data-price')) || 0;
        const totalMeal = (mealPrice * freq) * pax * days;

        let transPrice = 0;
        transportRadios.forEach(r => {
            if (r.checked) {
                transPrice = parseInt(r.getAttribute('data-price'));
                if(r.id === 'udara') {
                    seatSection.classList.remove('d-none');
                    taxiInfo.classList.remove('d-none');
                } else {
                    seatSection.classList.add('d-none');
                    taxiInfo.classList.add('d-none');
                    document.querySelectorAll('.seat.selected').forEach(s => s.classList.remove('selected'));
                }
            }
        });
        
        const totalTrans = transPrice * pax;

        document.getElementById('destPriceText').textContent = formatRupiah(totalDest);
        document.getElementById('hotelPriceText').textContent = formatRupiah(totalHotel);
        document.getElementById('mealPriceText').textContent = formatRupiah(totalMeal);
        document.getElementById('transPriceText').textContent = formatRupiah(totalTrans);
        document.getElementById('totalPrice').textContent = formatRupiah(totalDest + totalHotel + totalMeal + totalTrans);
    }

    restaurantSelect.addEventListener('change', function() {
        menuSelect.innerHTML = '<option value="">-- Pilih Menu --</option>';
        if (this.value) {
            const selectedResto = destData.restaurants.find(r => r.name === this.value);
            if(selectedResto) {
                menuSection.classList.remove('d-none');
                selectedResto.menus.forEach(item => {
                    const menuKey = `${selectedResto.name}::${item.name}`;
                    const isUnavailable = unavailableMenus.includes(menuKey) || unavailableMenus.includes(item.name);
                    const opt = document.createElement('option');
                    opt.value = item.name;
                    opt.setAttribute('data-price', item.price);
                    if (isUnavailable) {
                        opt.disabled = true;
                        opt.textContent = `${item.name} - Habis`;
                    } else {
                        opt.textContent = `${item.name} (kisaran ${formatRupiah(item.price)})`;
                    }
                    menuSelect.appendChild(opt);
                });
            }
        } else { menuSection.classList.add('d-none'); }
        calculateTotal();
    });

    [participantsInput, startDateInput, endDateInput, hotelSelect, menuSelect, mealFrequency].forEach(el => el.addEventListener('input', calculateTotal));
    transportRadios.forEach(r => r.addEventListener('change', calculateTotal));
    calculateTotal();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Nusantara_id\resources\views/destinations/show.blade.php ENDPATH**/ ?>