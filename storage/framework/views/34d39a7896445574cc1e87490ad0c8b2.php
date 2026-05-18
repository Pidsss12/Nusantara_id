<?php $__env->startSection('title', 'Bookings'); ?>
<?php $__env->startSection('page-title', 'Manage Bookings'); ?>
<?php $__env->startSection('page-subtitle', 'View and manage all booking requests'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 bg-success text-white">
            <div class="card-body">
                <h6 class="opacity-75">Confirmed</h6>
                <h3 class="fw-bold"><?php echo e($stats['confirmed']); ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 bg-warning text-white">
            <div class="card-body">
                <h6 class="opacity-75">Pending</h6>
                <h3 class="fw-bold"><?php echo e($stats['pending']); ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 bg-danger text-white">
            <div class="card-body">
                <h6 class="opacity-75">Cancelled</h6>
                <h3 class="fw-bold"><?php echo e($stats['cancelled']); ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 bg-info text-white">
            <div class="card-body">
                <h6 class="opacity-75">Total Revenue</h6>
                <h3 class="fw-bold">Rp <?php echo e(number_format($stats['total_revenue'] / 1000000, 1)); ?>M</h3>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-body">
        <form action="<?php echo e(route('admin.bookings')); ?>" method="GET" class="row g-3">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search booking ID or customer..." value="<?php echo e(request('search')); ?>">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="Confirmed" <?php echo e(request('status') == 'Confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                    <option value="Pending" <?php echo e(request('status') == 'Pending' ? 'selected' : ''); ?>>Pending</option>
                    <option value="Cancelled" <?php echo e(request('status') == 'Cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="destination_id" class="form-select">
                    <option value="">All Destinations</option>
                    <?php $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($dest->id); ?>" <?php echo e(request('destination_id') == $dest->id ? 'selected' : ''); ?>><?php echo e($dest->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="date_from" class="form-control" value="<?php echo e(request('date_from')); ?>">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success rounded-pill me-2"><i class="bi bi-search"></i> Filter</button>
                <a href="<?php echo e(route('admin.bookings')); ?>" class="btn btn-outline-secondary rounded-pill"><i class="bi bi-x-lg"></i> Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch; width: 100%;">
            <table class="table table-hover mb-0" style="white-space: nowrap; min-width: 1000px;">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 px-4">Booking ID</th>
                        <th class="border-0">Customer</th>
                        <th class="border-0">Destination</th>
                        <th class="border-0">Package</th>
                        <th class="border-0">Date</th>
                        <th class="border-0">Pax</th>
                        <th class="border-0">Amount</th>
                        <th class="border-0">Status</th>
                        <th class="border-0">Payment</th>
                        <th class="border-0 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4 fw-bold" style="color: #1abc9c;">#<?php echo e($booking->booking_code); ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px; font-size: 11px; flex-shrink: 0;">
                                    <?php echo e(strtoupper(substr($booking->customer_name, 0, 2))); ?>

                                </div>
                                <div>
                                    <span class="d-block fw-medium"><?php echo e($booking->customer_name); ?></span>
                                    <small class="text-muted"><?php echo e($booking->customer_email); ?></small>
                                </div>
                            </div>
                        </td>
                        <td><?php echo e($booking->destination->name ?? '-'); ?></td>
                        <td><span class="badge border-0" style="background-color: rgba(26, 188, 156, 0.15); color: #1abc9c;"><?php echo e($booking->package->name ?? 'No Package'); ?></span></td>
                        <td><?php echo e($booking->visit_date->format('d M Y')); ?></td>
                        <td><span class="badge bg-secondary"><?php echo e($booking->participants); ?></span></td>
                        <td class="fw-bold text-success">Rp <?php echo e(number_format($booking->total_amount, 0, ',', '.')); ?></td>
                        <td>
                            <span class="badge rounded-pill bg-<?php echo e($booking->status == 'Confirmed' ? 'success' : ($booking->status == 'Pending' ? 'warning text-dark' : 'danger')); ?>">
                                <?php echo e($booking->status); ?>

                            </span>
                        </td>
                        <td>
                            <span class="badge rounded-pill bg-<?php echo e($booking->payment_status == 'Paid' ? 'success' : ($booking->payment_status == 'Pending' ? 'info' : 'secondary')); ?>">
                                <?php echo e($booking->payment_status); ?>

                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm rounded-3 d-flex align-items-center justify-content-center" 
                                        style="width: 32px; height: 32px; border: 1.5px solid #1abc9c; color: #1abc9c; background: transparent;"
                                        data-bs-toggle="modal" data-bs-target="#viewBooking<?php echo e($booking->id); ?>" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>

                                <?php if($booking->status == 'Pending'): ?>
                                <form action="<?php echo e(route('admin.bookings.status', $booking)); ?>" method="POST" class="confirm-status-form">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                    <input type="hidden" name="status" value="Confirmed">
                                    <button type="button" class="btn btn-sm rounded-3 d-flex align-items-center justify-content-center btn-confirm-status" 
                                            style="width: 32px; height: 32px; border: 1.5px solid #198754; color: #198754; background: transparent;"
                                            title="Confirm">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                                <?php endif; ?>

                                <?php if($booking->status != 'Cancelled'): ?>
                                <form action="<?php echo e(route('admin.bookings.status', $booking)); ?>" method="POST" class="cancel-status-form">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                    <input type="hidden" name="status" value="Cancelled">
                                    <button type="button" class="btn btn-sm rounded-3 d-flex align-items-center justify-content-center btn-cancel-status" 
                                            style="width: 32px; height: 32px; border: 1.5px solid #dc3545; color: #dc3545; background: transparent;"
                                            title="Cancel">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </form>
                                <?php endif; ?>
                            </div>

                            <div class="modal fade" id="viewBooking<?php echo e($booking->id); ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg rounded-4">
                                        <div class="modal-header border-0 bg-light rounded-top-4 px-4">
                                            <h5 class="modal-title fw-bold">Detail Pesanan #<?php echo e($booking->booking_code); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-4 text-start" style="white-space: normal;">
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <small class="text-muted d-block">Pelanggan</small>
                                                    <span class="fw-bold"><?php echo e($booking->customer_name); ?></span>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted d-block">Destinasi</small>
                                                    <span class="fw-bold"><?php echo e($booking->destination->name ?? '-'); ?></span>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted d-block">Tanggal Kunjungan</small>
                                                    <span class="fw-bold"><?php echo e($booking->visit_date->format('d M Y')); ?></span>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted d-block">Jumlah Peserta</small>
                                                    <span class="fw-bold"><?php echo e($booking->participants); ?> Orang</span>
                                                </div>
                                                 <div class="col-12">
                                                    <hr class="my-2 opacity-10">
                                                    <small class="text-muted d-block mb-2">Informasi Pembayaran</small>
                                                    <div class="bg-light p-3 rounded-3 mt-1">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <small class="text-muted d-block">Metode</small>
                                                                <span class="fw-bold"><?php echo e($booking->payment_method ?? 'Belum dipilih'); ?></span>
                                                            </div>
                                                            <div class="col-6">
                                                                <small class="text-muted d-block">Status</small>
                                                                <span class="badge bg-<?php echo e($booking->payment_status == 'Paid' ? 'success' : 'warning text-dark'); ?>"><?php echo e($booking->payment_status); ?></span>
                                                            </div>
                                                            <?php if($booking->payment_proof): ?>
                                                            <div class="col-12 mt-3">
                                                                <small class="text-muted d-block mb-1">Bukti Transfer</small>
                                                                <a href="<?php echo e(asset('storage/' . $booking->payment_proof)); ?>" target="_blank">
                                                                    <img src="<?php echo e(asset('storage/' . $booking->payment_proof)); ?>" class="img-fluid rounded-3 border" style="max-height: 200px;">
                                                                </a>
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-4 text-center">
                                                    <h4 class="fw-bold text-success">Total: Rp <?php echo e(number_format($booking->total_amount, 0, ',', '.')); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 px-4 pb-4">
                                            <?php if($booking->payment_status == 'Pending'): ?>
                                            <form action="<?php echo e(route('admin.bookings.payment-status', $booking)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                                <input type="hidden" name="payment_status" value="Paid">
                                                <button type="submit" class="btn btn-success rounded-pill px-4">Verifikasi Pembayaran (Lunas)</button>
                                            </form>
                                            <?php endif; ?>
                                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="10" class="text-center py-5 text-muted">No bookings found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle Konfirmasi (Check)
        const confirmButtons = document.querySelectorAll('.btn-confirm-status');
        confirmButtons.forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.confirm-status-form');
                Swal.fire({
                    title: 'Konfirmasi Pesanan?',
                    text: "Pesanan akan ditandai sebagai 'Confirmed'.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Konfirmasi!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Handle Pembatalan (Silang)
        const cancelButtons = document.querySelectorAll('.btn-cancel-status');
        cancelButtons.forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.cancel-status-form');
                Swal.fire({
                    title: 'Batalkan Pesanan?',
                    text: "Apakah Anda yakin ingin membatalkan pesanan ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Batalkan!',
                    cancelButtonText: 'Kembali'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Nusantara_id\resources\views/admin/bookings.blade.php ENDPATH**/ ?>