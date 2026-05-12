<?php $__env->startSection('title', 'Users'); ?>
<?php $__env->startSection('page-title', 'Manage Users'); ?>
<?php $__env->startSection('page-subtitle', 'View and manage user accounts'); ?>

<?php $__env->startSection('content'); ?>
<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-body">
        <div class="row g-3 align-items-center">
            <div class="col-lg-9">
                <form action="<?php echo e(route('admin.users')); ?>" method="GET" class="row g-2">
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0" placeholder="Search name or email..." value="<?php echo e(request('search')); ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="role" class="form-select">
                            <option value="">All Roles</option>
                            <option value="admin" <?php echo e(request('role') == 'admin' ? 'selected' : ''); ?>>Admin</option>
                            <option value="user" <?php echo e(request('role') == 'user' ? 'selected' : ''); ?>>User</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success rounded-pill px-3">Filter</button>
                        <a href="<?php echo e(route('admin.users')); ?>" class="btn btn-outline-secondary rounded-pill px-3">Reset</a>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 text-lg-end text-start">
                <button class="btn btn-success rounded-pill w-100 w-lg-auto" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="bi bi-person-plus me-2"></i>New User
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body text-center">
                <div class="bg-<?php echo e($user->role == 'admin' ? 'danger' : 'success'); ?> text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; font-size: 28px;">
                    <?php echo e(strtoupper(substr($user->name, 0, 2))); ?>

                </div>
                <h6 class="fw-bold mb-1"><?php echo e($user->name); ?></h6>
                <small class="text-muted d-block mb-2"><?php echo e($user->email); ?></small>
                <span class="badge bg-<?php echo e($user->role == 'admin' ? 'danger' : 'primary'); ?> mb-2"><?php echo e(ucfirst($user->role)); ?></span>
                <div class="d-flex justify-content-around text-center mt-3 pt-3 border-top">
                    <div>
                        <h6 class="fw-bold text-success mb-0"><?php echo e($user->bookings_count ?? 0); ?></h6>
                        <small class="text-muted">Bookings</small>
                    </div>
                    <div>
                        <small class="text-muted d-block">Joined</small>
                        <small><?php echo e($user->created_at->format('d M Y')); ?></small>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="btn btn-sm btn-outline-primary rounded-pill me-1" data-bs-toggle="modal" data-bs-target="#editUser<?php echo e($user->id); ?>"><i class="bi bi-pencil"></i></button>
                    <?php if($user->role != 'admin' || \App\Models\User::where('role', 'admin')->count() > 1): ?>
                    <form action="<?php echo e(route('admin.users.destroy', $user)); ?>" method="POST" style="display:inline;" class="delete-form">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill btn-delete"><i class="bi bi-trash"></i></button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUser<?php echo e($user->id); ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content rounded-4">
                <form action="<?php echo e(route('admin.users.update', $user)); ?>" method="POST">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Edit User</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo e($user->name); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo e($user->email); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="user" <?php echo e($user->role == 'user' ? 'selected' : ''); ?>>User</option>
                                <option value="admin" <?php echo e($user->role == 'admin' ? 'selected' : ''); ?>>Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password <small class="text-muted">(leave empty to keep current)</small></label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-12">
        <div class="text-center py-5 text-muted">
            <i class="bi bi-people fs-1"></i>
            <p class="mt-3">No users found</p>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php if($users->hasPages()): ?>
<div class="mt-4">
    <?php echo e($users->appends(request()->query())->links()); ?>

</div>
<?php endif; ?>

<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <form action="<?php echo e(route('admin.users.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="bi bi-person-plus me-2"></i>Add New User</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" minlength="8" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Delete this user?',
                    text: "This action cannot be undone!",
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
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Nusantara_id\resources\views/admin/users.blade.php ENDPATH**/ ?>