

<?php $__env->startSection('title', 'Invoice ' . $booking->invoice_code); ?>
<?php $__env->startSection('page-title', 'Invoice'); ?>
<?php $__env->startSection('page-subtitle', $booking->invoice_code); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
    <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<?php if(session('error')): ?>
<div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
    <i class="bi bi-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="row g-4">
    <!-- Invoice Card -->
    <div class="col-lg-8">
        <div class="premium-card overflow-hidden" id="invoice-printable">
            <!-- Header -->
            <div class="p-5" style="background: linear-gradient(135deg, #198754 0%, #115e3b 100%);">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="bg-white rounded-4 p-2 shadow-sm">
                            <img src="<?php echo e(asset('img/logo.png')); ?>" alt="Logo" style="width: 50px; height: 50px;">
                        </div>
                    </div>
                    <div class="col text-white">
                        <h3 class="fw-bold mb-0">INVOICE</h3>
                        <p class="opacity-75 mb-0" style="letter-spacing: 2px;"><?php echo e($booking->invoice_code); ?></p>
                    </div>
                    <div class="col-auto">
                        <div class="bg-white bg-opacity-10 backdrop-blur rounded-pill px-4 py-2 border border-white border-opacity-20 text-white">
                            <?php echo e($booking->payment_status == 'Unpaid' ? 'Belum Bayar' : ($booking->payment_status == 'Pending' ? 'Menunggu' : 'Lunas')); ?>

                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Body -->
            <div class="p-4">
                <!-- From & To -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="bg-light rounded-3 p-3 h-100">
                            <small class="text-success fw-bold">DARI</small>
                            <h6 class="fw-bold mt-1 mb-1">NusantaraGreen</h6>
                            <small class="text-muted">
                                Jl. Kebon Jeruk No. 123<br>
                                Jakarta Selatan 12210<br>
                                info@nusantaragreen.com
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light rounded-3 p-3 h-100">
                            <small class="text-success fw-bold">KEPADA</small>
                            <h6 class="fw-bold mt-1 mb-1"><?php echo e($booking->customer_name); ?></h6>
                            <small class="text-muted">
                                <?php echo e($booking->customer_email); ?><br>
                                <?php echo e($booking->customer_phone ?? '-'); ?>

                                <?php if($booking->institution): ?><br><?php echo e($booking->institution); ?><?php endif; ?>
                            </small>
                        </div>
                    </div>
                </div>
                
                <!-- Info Grid -->
                <div class="row g-2 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="border rounded-3 p-2 text-center">
                            <small class="text-muted d-block">Invoice</small>
                            <small class="fw-bold"><?php echo e($booking->invoice_date ? $booking->invoice_date->format('d/m/Y') : now()->format('d/m/Y')); ?></small>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="border rounded-3 p-2 text-center">
                            <small class="text-muted d-block">Booking</small>
                            <small class="fw-bold"><?php echo e($booking->booking_code); ?></small>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="border rounded-3 p-2 text-center">
                            <small class="text-muted d-block">Kunjungan</small>
                            <small class="fw-bold"><?php echo e($booking->visit_date->format('d/m/Y')); ?></small>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="border rounded-3 p-2 text-center">
                            <small class="text-muted d-block">Peserta</small>
                            <small class="fw-bold"><?php echo e($booking->participants); ?> orang</small>
                        </div>
                    </div>
                </div>
                
                <!-- Items -->
                <table class="table table-bordered mb-4">
                    <thead class="table-success">
                        <tr>
                            <th>Deskripsi</th>
                            <th class="text-center" width="80">Qty</th>
                            <th class="text-end" width="130">Harga</th>
                            <th class="text-end" width="130">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong><?php echo e($booking->destination->name ?? 'Destinasi'); ?></strong><br>
                                <small class="text-muted">
                                    <?php if($booking->package): ?> Paket: <?php echo e($booking->package->name); ?> | <?php endif; ?>
                                    <?php echo e($booking->visit_date->format('d M Y')); ?>

                                </small>
                            </td>
                            <td class="text-center align-middle"><?php echo e($booking->participants); ?></td>
                            <td class="text-end align-middle">Rp <?php echo e(number_format($booking->total_amount / $booking->participants, 0, ',', '.')); ?></td>
                            <td class="text-end align-middle fw-bold">Rp <?php echo e(number_format($booking->total_amount, 0, ',', '.')); ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="table-light">
                            <th colspan="3" class="text-end">Subtotal</th>
                            <th class="text-end">Rp <?php echo e(number_format($booking->total_amount, 0, ',', '.')); ?></th>
                        </tr>
                        <tr class="table-success">
                            <th colspan="3" class="text-end fs-6">TOTAL</th>
                            <th class="text-end fs-5">Rp <?php echo e(number_format($booking->total_amount, 0, ',', '.')); ?></th>
                        </tr>
                    </tfoot>
                </table>
                
                <!-- Payment Section with QR -->
                <?php if($booking->payment_status == 'Unpaid'): ?>
                <div class="rounded-4 p-4 mt-4" style="background: rgba(255, 193, 7, 0.05); border: 1px solid rgba(255, 193, 7, 0.2);">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="fw-bold mb-3" style="color: var(--text-title)"><i class="bi bi-credit-card-fill text-warning me-2"></i>Instruksi Pembayaran</h6>
                            <div class="row g-3">
                                <div class="col-6">
                                    <small class="text-muted d-block text-uppercase small fw-bold" style="font-size: 0.6rem;">Bank BCA</small>
                                    <strong class="fs-5" style="color: var(--text-title)">1234567890</strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block text-uppercase small fw-bold" style="font-size: 0.6rem;">Bank Mandiri</small>
                                    <strong class="fs-5" style="color: var(--text-title)">0987654321</strong>
                                </div>
                            </div>
                            <p class="text-muted small mt-2 mb-0">a.n. PT Nusantara Green Eco</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="bg-white p-2 rounded-3 shadow-sm d-inline-block">
                                <img src="<?php echo e(asset('img/qr-payment.png')); ?>" alt="QR Payment" class="img-fluid" style="max-width: 100px;">
                            </div>
                            <small class="text-muted d-block mt-2">Scan QRIS</small>
                        </div>
                    </div>
                </div>
                <?php elseif($booking->payment_status == 'Pending'): ?>
                <div class="bg-info bg-opacity-10 border border-info rounded-3 p-3 text-center">
                    <i class="bi bi-hourglass-split text-info fs-3"></i>
                    <h6 class="fw-bold mt-2 mb-1">Menunggu Verifikasi</h6>
                    <small class="text-muted">Pembayaran sedang diverifikasi (1x24 jam)</small>
                </div>
                <?php elseif($booking->payment_status == 'Paid'): ?>
                <div class="bg-success bg-opacity-10 border border-success rounded-3 p-3">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="bg-success rounded-circle p-2">
                                <i class="bi bi-check-lg text-white fs-4"></i>
                            </div>
                        </div>
                        <div class="col">
                            <h6 class="fw-bold text-success mb-0">Pembayaran Lunas</h6>
                            <small class="text-muted"><?php echo e($booking->payment_date ? $booking->payment_date->format('d M Y H:i') : ''); ?> | <?php echo e($booking->payment_method ?? ''); ?></small>
                        </div>
                        <div class="col-auto">
                            <img src="<?php echo e(asset('img/qr-payment.png')); ?>" alt="QR" style="width: 60px;">
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Footer -->
                <div class="text-center mt-4 pt-3 border-top">
                    <small class="text-muted">Terima kasih telah memesan di <strong class="text-success">NusantaraGreen</strong></small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="col-lg-4">
        <?php if($booking->payment_status == 'Unpaid'): ?>
        <div class="premium-card p-4 mb-4">
            <h6 class="fw-bold mb-4" style="color: var(--text-title)"><i class="bi bi-upload text-success me-2"></i>Konfirmasi Pembayaran</h6>
            <form action="<?php echo e(route('user.invoices.confirm-payment', $booking)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
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
        <?php endif; ?>
        
        <div class="premium-card p-4">
            <a href="<?php echo e(route('user.invoices.download-pdf', $booking)); ?>" class="btn btn-success w-100 rounded-pill mb-3 py-2 shadow-sm">
                <i class="bi bi-file-earmark-pdf me-2"></i>Download PDF
            </a>
            <form action="<?php echo e(route('user.invoices.resend-email', $booking)); ?>" method="POST" class="mb-3">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-light w-100 rounded-pill py-2 text-primary border-primary border-opacity-25">
                    <i class="bi bi-envelope me-2"></i>Kirim ke Email
                </button>
            </form>
            <button onclick="window.print()" class="btn btn-light w-100 rounded-pill mb-3 py-2 text-muted">
                <i class="bi bi-printer me-2"></i>Cetak Invoice
            </button>
            <a href="<?php echo e(route('user.invoices')); ?>" class="btn btn-light w-100 rounded-pill py-2 text-muted">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ekowisataID\resources\views/user/invoice-detail.blade.php ENDPATH**/ ?>