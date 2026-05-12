<?php $__env->startSection('title', 'Settings'); ?>
<?php $__env->startSection('page-title', 'Settings'); ?>
<?php $__env->startSection('page-subtitle', 'Configure system settings'); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
    <div class="d-flex align-items-center">
        <i class="bi bi-check-circle-fill fs-4 me-3"></i>
        <div><?php echo e(session('success')); ?></div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>


<?php if($errors->any()): ?>
<div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
    <div class="d-flex">
        <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="row g-4">
    
    <div class="col-lg-3">
        <div class="premium-card p-0 overflow-hidden shadow-sm border-0 rounded-4">
            <div class="list-group list-group-flush border-0">
                <a href="#profile" class="list-group-item list-group-item-action active px-4 py-3" data-bs-toggle="list">
                    <i class="bi bi-person me-2"></i> Profile
                </a>
                <a href="#security" class="list-group-item list-group-item-action px-4 py-3" data-bs-toggle="list">
                    <i class="bi bi-shield-lock me-2"></i> Security
                </a>
            </div>
        </div>
        
        <style>
            .list-group-item.active {
                background: rgba(25, 137, 84, 0.1) !important;
                color: #198754 !important;
                border-left: 4px solid #198754 !important;
                font-weight: 600;
            }
            .list-group-item {
                transition: all 0.3s ease;
                border: none !important;
                padding-left: 24px;
            }
            .list-group-item:hover:not(.active) {
                background: rgba(0, 0, 0, 0.02) !important;
                padding-left: 30px !important;
            }
            .premium-input {
                background: #f8f9fa !important;
                border: 1px solid #e9ecef !important;
                border-radius: 12px !important;
                padding: 12px 18px !important;
                transition: all 0.3s;
            }
            .premium-input:focus {
                border-color: #198754 !important;
                box-shadow: 0 0 0 4px rgba(25, 137, 84, 0.1) !important;
                background: #fff !important;
            }
            .form-label {
                font-weight: 600;
                font-size: 0.85rem;
                color: #495057;
                margin-bottom: 8px;
            }
        </style>
    </div>
    
    <div class="col-lg-9">
        <div class="tab-content">
            
            <div class="tab-pane fade show active" id="profile">
                <div class="premium-card p-4 shadow-sm border-0 rounded-4" style="background: #fff;">
                    <div class="d-flex align-items-center mb-5 pb-3 border-bottom">
                        <i class="bi bi-person-circle fs-3 text-success me-3"></i>
                        <h5 class="fw-bold mb-0">Profile Information</h5>
                    </div>
                    
                    <div class="row align-items-center mb-5">
                        <div class="col-auto">
                            <form action="<?php echo e(route('admin.settings.profile.image')); ?>" method="POST" enctype="multipart/form-data" id="avatarForm">
                                <?php echo csrf_field(); ?> 
                                <?php echo method_field('PUT'); ?>
                                <div class="position-relative">
                                    
                                    <?php
                                        $defaultAvatar = 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=198754&color=fff&size=128';
                                        $userAvatar = Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) . '?' . time() : $defaultAvatar;
                                    ?>

                                    <img src="<?php echo e($userAvatar); ?>" 
                                         class="rounded-circle shadow border border-4 border-white" 
                                         width="120" height="120" 
                                         style="object-fit: cover;"
                                         alt="Avatar" id="avatarPreview"
                                         onerror="this.onerror=null;this.src='<?php echo e($defaultAvatar); ?>';">
                                    
                                    <input type="file" name="avatar" id="avatarInput" hidden accept="image/*" onchange="document.getElementById('avatarForm').submit()">
                                    
                                    <button type="button" onclick="document.getElementById('avatarInput').click()" 
                                            class="btn btn-success rounded-circle position-absolute bottom-0 end-0 p-0 shadow-sm border border-2 border-white" 
                                            style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-camera-fill"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col">
                            <h4 class="fw-bold mb-1 text-dark"><?php echo e(Auth::user()->name); ?></h4>
                            <p class="text-muted mb-0">
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Administrator</span>
                            </p>
                        </div>
                    </div>

                    <form action="<?php echo e(route('admin.settings.profile')); ?>" method="POST">
                        <?php echo csrf_field(); ?> 
                        <?php echo method_field('PUT'); ?>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control premium-input" value="<?php echo e(Auth::user()->name); ?>" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control premium-input" value="<?php echo e(Auth::user()->email); ?>" required>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control premium-input" value="<?php echo e(Auth::user()->phone); ?>" placeholder="+62 8..." >
                            </div>
                        </div>
                        <div class="mt-2 text-end">
                            <button type="submit" class="btn btn-success px-5 py-3 rounded-pill fw-bold shadow-sm">
                                <i class="bi bi-check2-circle me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <div class="tab-pane fade" id="security">
                <div class="premium-card p-4 shadow-sm border-0 rounded-4" style="background: #fff;">
                    <div class="d-flex align-items-center mb-5 pb-3 border-bottom">
                        <i class="bi bi-shield-lock-fill fs-3 text-danger me-3"></i>
                        <h5 class="fw-bold mb-0">Account Security</h5>
                    </div>
                    <form action="<?php echo e(route('admin.settings.password')); ?>" method="POST">
                        <?php echo csrf_field(); ?> 
                        <?php echo method_field('PUT'); ?>
                        <div class="mb-4">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control premium-input" placeholder="Enter current password" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control premium-input" minlength="8" placeholder="Min. 8 characters" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control premium-input" placeholder="Repeat new password" required>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-danger px-5 py-3 rounded-pill fw-bold shadow-sm">
                                <i class="bi bi-key-fill me-2"></i>Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Nusantara_id\resources\views/admin/settings.blade.php ENDPATH**/ ?>