

<?php $__env->startSection('title', 'Destinations'); ?>
<?php $__env->startSection('page-title', 'Manage Destinations'); ?>
<?php $__env->startSection('page-subtitle', 'Add, edit, and manage ecotourism destinations'); ?>

<?php $__env->startSection('content'); ?>
<!-- session success handled by layout -->

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <button class="btn btn-success rounded-pill" data-bs-toggle="modal" data-bs-target="#addDestinationModal">
            <i class="bi bi-plus-circle me-2"></i>Add New Destination
        </button>
    </div>
    <form action="<?php echo e(route('admin.destinations')); ?>" method="GET" class="d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Search destinations..." value="<?php echo e(request('search')); ?>">
        <select name="province_id" class="form-select" style="width: 180px;">
            <option value="">All Provinces</option>
            <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($province->id); ?>" <?php echo e(request('province_id') == $province->id ? 'selected' : ''); ?>><?php echo e($province->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <select name="category" class="form-select" style="width: 150px;">
            <option value="">All Categories</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($cat); ?>" <?php echo e(request('category') == $cat ? 'selected' : ''); ?>><?php echo e($cat); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <select name="status" class="form-select" style="width: 130px;">
            <option value="">All Status</option>
            <option value="Active" <?php echo e(request('status') == 'Active' ? 'selected' : ''); ?>>Active</option>
            <option value="Inactive" <?php echo e(request('status') == 'Inactive' ? 'selected' : ''); ?>>Inactive</option>
        </select>
        <button type="submit" class="btn btn-outline-success"><i class="bi bi-search"></i></button>
        <a href="<?php echo e(route('admin.destinations')); ?>" class="btn btn-outline-secondary"><i class="bi bi-x-lg"></i></a>
    </form>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
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
                        <th class="border-0">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4">
                            <img src="<?php echo e($dest->photo ? asset($dest->photo) : 'https://picsum.photos/seed/' . $dest->slug . '/60/60'); ?>" class="rounded" width="50" height="50" style="object-fit: cover;">
                        </td>
                        <td class="fw-bold"><?php echo e($dest->name); ?></td>
                        <td><?php echo e($dest->province->name ?? '-'); ?></td>
                        <td><span class="badge bg-info-subtle text-info"><?php echo e($dest->category); ?></span></td>
                        <td>Rp <?php echo e(number_format($dest->price, 0, ',', '.')); ?></td>
                        <td><span class="text-warning">⭐</span> <?php echo e($dest->rating); ?></td>
                        <td><?php echo e($dest->bookings_count); ?></td>
                        <td>
                            <span class="badge bg-<?php echo e($dest->status == 'Active' ? 'success' : 'secondary'); ?>"><?php echo e($dest->status); ?></span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo e($dest->id); ?>"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($dest->id); ?>"><i class="bi bi-pencil"></i></button>
                                <form action="<?php echo e(route('admin.destinations.destroy', $dest)); ?>" method="POST" style="display:inline;" class="delete-form">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- View Modal -->
                    <div class="modal fade" id="viewModal<?php echo e($dest->id); ?>" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content rounded-4">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title"><i class="bi bi-eye me-2"></i><?php echo e($dest->name); ?></h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="<?php echo e($dest->photo ? asset($dest->photo) : 'https://picsum.photos/seed/' . $dest->slug . '/400/300'); ?>" class="img-fluid rounded mb-3">
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Province:</strong> <?php echo e($dest->province->name ?? '-'); ?></p>
                                            <p><strong>Category:</strong> <?php echo e($dest->category); ?></p>
                                            <p><strong>Location:</strong> <?php echo e($dest->location); ?></p>
                                            <p><strong>Price:</strong> Rp <?php echo e(number_format($dest->price, 0, ',', '.')); ?></p>
                                            <p><strong>Quota/Day:</strong> <?php echo e($dest->quota_per_day); ?></p>
                                            <p><strong>Rating:</strong> ⭐ <?php echo e($dest->rating); ?></p>
                                            <p><strong>Total Bookings:</strong> <?php echo e($dest->bookings_count); ?></p>
                                            <p><strong>Status:</strong> <span class="badge bg-<?php echo e($dest->status == 'Active' ? 'success' : 'secondary'); ?>"><?php echo e($dest->status); ?></span></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <p><strong>Description:</strong></p>
                                    <p><?php echo e($dest->description); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal<?php echo e($dest->id); ?>" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content rounded-4">
                                <form action="<?php echo e(route('admin.destinations.update', $dest)); ?>" method="POST" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Edit <?php echo e($dest->name); ?></h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Destination Name</label>
                                                <input type="text" name="name" class="form-control" value="<?php echo e($dest->name); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Province</label>
                                                <select name="province_id" class="form-select" required>
                                                    <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($province->id); ?>" <?php echo e($dest->province_id == $province->id ? 'selected' : ''); ?>><?php echo e($province->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Category</label>
                                                <select name="category" class="form-select" required>
                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($cat); ?>" <?php echo e($dest->category == $cat ? 'selected' : ''); ?>><?php echo e($cat); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Price (Rp)</label>
                                                <input type="number" name="price" class="form-control" value="<?php echo e($dest->price); ?>" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-select">
                                                    <option value="Active" <?php echo e($dest->status == 'Active' ? 'selected' : ''); ?>>Active</option>
                                                    <option value="Inactive" <?php echo e($dest->status == 'Inactive' ? 'selected' : ''); ?>>Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Location</label>
                                                <input type="text" name="location" class="form-control" value="<?php echo e($dest->location); ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Quota/Day</label>
                                                <input type="number" name="quota_per_day" class="form-control" value="<?php echo e($dest->quota_per_day); ?>">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Description</label>
                                                <textarea name="description" class="form-control" rows="3" required><?php echo e($dest->description); ?></textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Photo</label>
                                                <input type="file" name="photo" class="form-control" accept="image/*">
                                                <small class="text-muted">Leave empty to keep current photo</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary rounded-pill">Update Destination</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="text-center py-4 text-muted">No destinations found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($destinations->hasPages()): ?>
    <div class="card-footer">
        <?php echo e($destinations->appends(request()->query())->links()); ?>

    </div>
    <?php endif; ?>
</div>

<!-- Add Destination Modal -->
<div class="modal fade" id="addDestinationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4">
            <form action="<?php echo e(route('admin.destinations.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Add New Destination</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Destination Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Province</label>
                            <select name="province_id" class="form-select" required>
                                <option value="">Select Province</option>
                                <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($province->id); ?>"><?php echo e($province->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select" required>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat); ?>"><?php echo e($cat); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Price (Rp)</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Quota/Day</label>
                            <input type="number" name="quota_per_day" class="form-control" value="50">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Upload Photo</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill">Save Destination</button>
                </div>
            </form>
        </div>
    </div>
</div>
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\ekowisataID\resources\views/admin/destinations.blade.php ENDPATH**/ ?>