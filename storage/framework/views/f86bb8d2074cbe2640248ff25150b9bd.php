

<?php $__env->startSection('title', 'Bookings'); ?>
<?php $__env->startSection('page-title', 'Manage Bookings'); ?>
<?php $__env->startSection('page-subtitle', 'View and manage all booking requests'); ?>

<?php $__env->startSection('content'); ?>
<!-- session success handled by layout -->

<!-- Stats Cards -->
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

<!-- Filters -->
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
                <input type="date" name="date_from" class="form-control" value="<?php echo e(request('date_from')); ?>" placeholder="From Date">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success rounded-pill me-2"><i class="bi bi-search"></i> Filter</button>
                <a href="<?php echo e(route('admin.bookings')); ?>" class="btn btn-outline-secondary rounded-pill"><i class="bi bi-x-lg"></i> Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Bookings Table -->
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
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
                        <th class="border-0">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4 fw-bold text-primary">#<?php echo e($booking->booking_code); ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px; font-size: 12px;">
                                    <?php echo e(strtoupper(substr($booking->customer_name, 0, 2))); ?>

                                </div>
                                <div>
                                    <span class="d-block fw-medium"><?php echo e($booking->customer_name); ?></span>
                                    <small class="text-muted"><?php echo e($booking->customer_email); ?></small>
                                </div>
                            </div>
                        </td>
                        <td><?php echo e($booking->destination->name ?? '-'); ?></td>
                        <td><span class="badge bg-primary-subtle text-primary"><?php echo e($booking->package->name ?? 'No Package'); ?></span></td>
                        <td><?php echo e($booking->visit_date->format('d M Y')); ?></td>
                        <td><span class="badge bg-secondary"><?php echo e($booking->participants); ?></span></td>
                        <td class="fw-bold text-success">Rp <?php echo e(number_format($booking->total_amount, 0, ',', '.')); ?></td>
                        <td><span class="badge bg-<?php echo e($booking->status == 'Confirmed' ? 'success' : ($booking->status == 'Pending' ? 'warning' : 'danger')); ?>"><?php echo e($booking->status); ?></span></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewBooking<?php echo e($booking->id); ?>" title="View"><i class="bi bi-eye"></i></button>
                                <?php if($booking->status == 'Pending'): ?>
                                <form action="<?php echo e(route('admin.bookings.status', $booking)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                    <input type="hidden" name="status" value="Confirmed">
                                    <button type="submit" class="btn btn-outline-success btn-sm" title="Confirm"><i class="bi bi-check"></i></button>
                                </form>
                                <?php endif; ?>
                                <?php if($booking->status != 'Cancelled'): ?>
                                <form action="<?php echo e(route('admin.bookings.status', $booking)); ?>" method="POST" style="display:inline;" class="action-form">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                    <input type="hidden" name="status" value="Cancelled">
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-action-confirm" title="Cancel"><i class="bi bi-x"></i></button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">No bookings found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($bookings->hasPages()): ?>
    <div class="card-footer">
        <?php echo e($bookings->appends(request()->query())->links()); ?>

    </div>
    <?php endif; ?>
</div>

<!-- View Booking Modals -->
<?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="viewBooking<?php echo e($booking->id); ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="bi bi-eye me-2"></i>Booking #<?php echo e($booking->booking_code); ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless">
                    <tr><th width="40%">Customer</th><td><?php echo e($booking->customer_name); ?></td></tr>
                    <tr><th>Email</th><td><?php echo e($booking->customer_email); ?></td></tr>
                    <tr><th>Phone</th><td><?php echo e($booking->customer_phone ?? '-'); ?></td></tr>
                    <tr><th>Institution</th><td><?php echo e($booking->institution ?? '-'); ?></td></tr>
                    <tr><th>Destination</th><td><?php echo e($booking->destination->name ?? '-'); ?></td></tr>
                    <tr><th>Package</th><td><?php echo e($booking->package->name ?? 'No Package'); ?></td></tr>
                    <tr><th>Visit Date</th><td><?php echo e($booking->visit_date->format('d M Y')); ?></td></tr>
                    <tr><th>Participants</th><td><?php echo e($booking->participants); ?> orang</td></tr>
                    <tr><th>Total Amount</th><td class="fw-bold text-success">Rp <?php echo e(number_format($booking->total_amount, 0, ',', '.')); ?></td></tr>
                    <tr><th>Status</th><td><span class="badge bg-<?php echo e($booking->status == 'Confirmed' ? 'success' : ($booking->status == 'Pending' ? 'warning' : 'danger')); ?>"><?php echo e($booking->status); ?></span></td></tr>
                    <tr><th>Notes</th><td><?php echo e($booking->notes ?? '-'); ?></td></tr>
                    <tr><th>Created</th><td><?php echo e($booking->created_at->format('d M Y H:i')); ?></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const confirmButtons = document.querySelectorAll('.btn-action-confirm');
        confirmButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('.action-form');
                const action = this.title || 'perform this action';
                
                Swal.fire({
                    title: action + '?',
                    text: "Are you sure you want to " + action.toLowerCase() + " this booking?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, ' + action.toLowerCase() + '!',
                    cancelButtonText: 'Cancel',
                    background: 'rgba(255, 255, 255, 0.95)',
                    customClass: {
                        popup: 'premium-card',
                        title: 'fw-bold text-danger',
                        confirmButton: 'rounded-pill px-4',
                        cancelButton: 'rounded-pill px-4'
                    }
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ekowisataID\resources\views/admin/bookings.blade.php ENDPATH**/ ?>