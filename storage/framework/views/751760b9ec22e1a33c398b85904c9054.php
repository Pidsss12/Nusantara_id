<?php $__env->startSection('title', 'Destinations'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="premium-card p-4 bg-white shadow-sm d-flex justify-content-between align-items-center" style="border-radius: 20px;">
                <div>
                    <h3 class="fw-bold mb-1">Manage Destinations</h3>
                    <p class="text-muted mb-0">Add, edit, and manage ecotourism destinations</p>
                </div>
                <div>
                    <button class="btn btn-success rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addDestinationModal">
                        <i class="bi bi-plus-circle me-2"></i>Add New Destination
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="premium-card p-3 bg-white shadow-sm" style="border-radius: 20px;">
                <form action="<?php echo e(route('admin.destinations')); ?>" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control border-0 bg-light" placeholder="Search destinations..." value="<?php echo e(request('search')); ?>" style="border-radius: 10px;">
                    </div>
                    <div class="col-md-2">
                        <select name="province_id" class="form-select border-0 bg-light" style="border-radius: 10px;">
                            <option value="">All Provinces</option>
                            <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($province->id); ?>" <?php echo e(request('province_id') == $province->id ? 'selected' : ''); ?>><?php echo e($province->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="category" class="form-select border-0 bg-light custom-filter-select" style="border-radius: 10px;">
                            <option value="">All Categories</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat); ?>" <?php echo e(request('category') == $cat ? 'selected' : ''); ?>><?php echo e($cat); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select border-0 bg-light" style="border-radius: 10px;">
                            <option value="">All Status</option>
                            <option value="Active" <?php echo e(request('status') == 'Active' ? 'selected' : ''); ?>>Active</option>
                            <option value="Inactive" <?php echo e(request('status') == 'Inactive' ? 'selected' : ''); ?>>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-success flex-grow-1" style="border-radius: 10px;"><i class="bi bi-search"></i></button>
                        <a href="<?php echo e(route('admin.destinations')); ?>" class="btn btn-outline-secondary" style="border-radius: 10px;"><i class="bi bi-arrow-clockwise"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 px-4">Image</th>
                            <th class="border-0">Name</th>
                            <th class="border-0">Province</th>
                            <th class="border-0">Category</th>
                            <th class="border-0">Price</th>
                            <th class="border-0">Rating</th>
                            <th class="border-0">Bookings</th>
                            <th class="border-0">Status</th>
                            <th class="border-0 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-4">
                                <img src="<?php echo e($dest->photo ? asset($dest->photo) : 'https://picsum.photos/seed/' . $dest->slug . '/60/60'); ?>" class="rounded-3" width="50" height="50" style="object-fit: cover;">
                            </td>
                            <td class="fw-bold"><?php echo e($dest->name); ?></td>
                            <td><?php echo e($dest->province->name ?? '-'); ?></td>
                            
                            <td>
                                <span class="badge border-0" style="background-color: rgba(26, 188, 156, 0.15); color: #1abc9c; font-weight: 600; padding: 0.5em 1em; border-radius: 50px;">
                                    <?php echo e($dest->category); ?>

                                </span>
                            </td>
                            
                            <td class="fw-medium">Rp <?php echo e(number_format($dest->price, 0, ',', '.')); ?></td>
                            <td><span class="text-warning">⭐</span> <?php echo e($dest->rating); ?></td>
                            <td><?php echo e($dest->bookings_count); ?></td>
                            <td>
                                <span class="badge rounded-pill px-3 bg-<?php echo e($dest->status == 'Active' ? 'success' : 'secondary'); ?>"><?php echo e($dest->status); ?></span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-light mx-1 rounded" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo e($dest->id); ?>" style="color: #1abc9c;"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-sm btn-light text-success mx-1 rounded" data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($dest->id); ?>"><i class="bi bi-pencil"></i></button>
                                    <form action="<?php echo e(route('admin.destinations.destroy', $dest)); ?>" method="POST" style="display:inline;" class="delete-form">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="button" class="btn btn-sm btn-light text-danger mx-1 rounded btn-delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="viewModal<?php echo e($dest->id); ?>" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content rounded-4 border-0">
                                    <div class="modal-header bg-success text-white border-0">
                                        <h5 class="modal-title fw-bold"><?php echo e($dest->name); ?></h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <img src="<?php echo e($dest->photo ? asset($dest->photo) : 'https://picsum.photos/seed/' . $dest->slug . '/400/300'); ?>" class="img-fluid rounded-4 shadow-sm">
                                            </div>
                                            <div class="col-md-7">
                                                <div class="mb-3">
                                                    <label class="text-muted small text-uppercase fw-bold">Location</label>
                                                    <p class="mb-0 fw-medium"><?php echo e($dest->location); ?>, <?php echo e($dest->province->name ?? '-'); ?></p>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-6">
                                                        <label class="text-muted small text-uppercase fw-bold">Price</label>
                                                        <p class="mb-0 fw-bold text-success">Rp <?php echo e(number_format($dest->price, 0, ',', '.')); ?></p>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="text-muted small text-uppercase fw-bold">Quota</label>
                                                        <p class="mb-0 fw-medium"><?php echo e($dest->quota_per_day); ?> / day</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="text-muted small text-uppercase fw-bold">Description</label>
                                                    <p class="mb-0 text-muted small" style="text-align: justify;"><?php echo e($dest->description); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="editModal<?php echo e($dest->id); ?>" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content rounded-4 border-0">
                                    <form action="<?php echo e(route('admin.destinations.update', $dest)); ?>" method="POST" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                        <div class="modal-header bg-primary text-white border-0">
                                            <h5 class="modal-title fw-bold">Edit Destination</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Destination Name</label>
                                                    <input type="text" name="name" class="form-control" value="<?php echo e($dest->name); ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Province</label>
                                                    <select name="province_id" class="form-select" required>
                                                        <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($province->id); ?>" <?php echo e($dest->province_id == $province->id ? 'selected' : ''); ?>><?php echo e($province->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label fw-bold">Category</label>
                                                    <select name="category" class="form-select" required>
                                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($cat); ?>" <?php echo e($dest->category == $cat ? 'selected' : ''); ?>><?php echo e($cat); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label fw-bold">Price (Rp)</label>
                                                    <input type="number" name="price" class="form-control" value="<?php echo e($dest->price); ?>" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label fw-bold">Status</label>
                                                    <select name="status" class="form-select">
                                                        <option value="Active" <?php echo e($dest->status == 'Active' ? 'selected' : ''); ?>>Active</option>
                                                        <option value="Inactive" <?php echo e($dest->status == 'Inactive' ? 'selected' : ''); ?>>Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-bold">Description</label>
                                                    <textarea name="description" class="form-control" rows="3" required><?php echo e($dest->description); ?></textarea>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-bold">Update Photo</label>
                                                    <input type="file" name="photo" class="form-control" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary rounded-pill px-4">Update Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="bi bi-folder-x fs-1 d-block mb-2"></i>
                                No destinations found
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if($destinations->hasPages()): ?>
        <div class="card-footer bg-white border-0 py-3">
            <?php echo e($destinations->appends(request()->query())->links()); ?>

        </div>
        <?php endif; ?>
    </div>
</div>

<div class="modal fade" id="addDestinationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 border-0">
            <form action="<?php echo e(route('admin.destinations.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header bg-success text-white border-0">
                    <h5 class="modal-title fw-bold">Add New Destination</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Destination Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Raja Ampat" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Province</label>
                            <select name="province_id" class="form-select" required>
                                <option value="">Select Province</option>
                                <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($province->id); ?>"><?php echo e($province->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Category</label>
                            <select name="category" class="form-select" required>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat); ?>"><?php echo e($cat); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Price (Rp)</label>
                            <input type="number" name="price" class="form-control" placeholder="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Quota/Day</label>
                            <input type="number" name="quota_per_day" class="form-control" value="50">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Location Details</label>
                            <input type="text" name="location" class="form-control" placeholder="Full address or district" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Tell about this place..." required></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Destination Photo</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4">Save Destination</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .custom-filter-select:focus {
        border-color: #1abc9c !important;
        box-shadow: 0 0 0 0.25rem rgba(26, 188, 156, 0.25) !important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Delete destination?',
                    text: "All associated packages and bookings might be affected!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete!',
                    cancelButtonText: 'Cancel',
                    background: '#fff',
                    customClass: {
                        popup: 'rounded-4',
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
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Nusantara_id\resources\views/admin/destinations.blade.php ENDPATH**/ ?>