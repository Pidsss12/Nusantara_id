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
                            <th class="border-0">Status</th>
                            <th class="border-0 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $pricingOptions = config('travel_pricing.destinations');
                            $hotelOptions = $pricingOptions[$dest->name]['hotels'] ?? $pricingOptions['Default']['hotels'];
                            $restaurantOptions = $pricingOptions[$dest->name]['restaurants'] ?? $pricingOptions['Default']['restaurants'];
                            $unavailableHotels = $dest->unavailable_hotels ?? [];
                            $unavailableRestaurants = $dest->unavailable_restaurants ?? [];
                            $unavailableMenus = $dest->unavailable_menus ?? [];
                        ?>
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
                            <td>
                                <span class="badge rounded-pill px-3 bg-<?php echo e($dest->status == 'Active' ? 'success' : 'secondary'); ?>"><?php echo e($dest->status); ?></span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-light mx-1 rounded" data-bs-toggle="modal" data-bs-target="#viewModal<?php echo e($dest->id); ?>" style="color: #1abc9c;"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-sm btn-light text-success mx-1 rounded" data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($dest->id); ?>"><i class="bi bi-pencil"></i></button>
                                    <form action="<?php echo e(route('admin.destinations.destroy', $dest->id)); ?>" method="POST" style="display:inline;" class="delete-form">
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
                                                        <label class="text-muted small text-uppercase fw-bold">Seats Occupied</label>
                                                        <p class="mb-0 fw-bold text-danger"><?php echo e(is_array($dest->occupied_seats) ? implode(',', $dest->occupied_seats) : ($dest->occupied_seats ?? 'None')); ?></p>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="text-muted small text-uppercase fw-bold">Hotel</label>
                                                    <?php if(count($unavailableHotels)): ?>
                                                        <div class="d-flex flex-wrap gap-2 mt-1">
                                                            <?php $__currentLoopData = $unavailableHotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotelName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2"><?php echo e($hotelName); ?></span>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    <?php else: ?>
                                                        <p class="mb-0 fw-bold text-success">Semua hotel tersedia</p>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="text-muted small text-uppercase fw-bold">Restoran</label>
                                                    <?php if(count($unavailableRestaurants)): ?>
                                                        <div class="d-flex flex-wrap gap-2 mt-1">
                                                            <?php $__currentLoopData = $unavailableRestaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurantName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2"><?php echo e($restaurantName); ?></span>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    <?php else: ?>
                                                        <p class="mb-0 fw-bold text-success">Semua restoran tersedia</p>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="text-muted small text-uppercase fw-bold">Menu</label>
                                                    <?php if(count($unavailableMenus)): ?>
                                                        <div class="d-flex flex-wrap gap-2 mt-1">
                                                            <?php $__currentLoopData = $unavailableMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2"><?php echo e(str_replace('::', ' - ', $menuName)); ?></span>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    <?php else: ?>
                                                        <p class="mb-0 fw-bold text-success">Semua menu tersedia</p>
                                                    <?php endif; ?>
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
                                    <form action="<?php echo e(route('admin.destinations.update', $dest->id)); ?>" method="POST" enctype="multipart/form-data">
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
                                                    <label class="form-label fw-bold">Location Details</label>
                                                    <input type="text" name="location" class="form-control" value="<?php echo e($dest->location); ?>" required>
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label fw-bold">Description</label>
                                                    <textarea name="description" class="form-control" rows="3" required><?php echo e($dest->description); ?></textarea>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <label class="form-label fw-bold text-danger d-block mb-1">Set Blokir Kursi</label>
                                                    <input type="hidden" name="occupied_seats" id="edit_occupied_seats_input_<?php echo e($dest->id); ?>" value="<?php echo e(is_array($dest->occupied_seats) ? implode(',', $dest->occupied_seats) : $dest->occupied_seats); ?>">
                                                    
                                                    <?php
                                                        $currentOccupied = [];
                                                        if (!empty($dest->occupied_seats)) {
                                                            if (is_array($dest->occupied_seats)) {
                                                                $currentOccupied = $dest->occupied_seats;
                                                            } else {
                                                                $currentOccupied = array_map('intval', explode(',', str_replace(' ', '', $dest->occupied_seats)));
                                                            }
                                                        }
                                                    ?>
                                                    
                                                    <div class="admin-seat-container edit-seat-grid" data-id="<?php echo e($dest->id); ?>">
                                                        <div class="admin-seat <?php echo e(in_array(1, $currentOccupied) ? 'occupied' : ''); ?>" data-seat="1"></div>
                                                        <div class="admin-seat <?php echo e(in_array(2, $currentOccupied) ? 'occupied' : ''); ?>" data-seat="2"></div>
                                                        <div class="admin-aisle"></div>
                                                        <div class="admin-seat <?php echo e(in_array(3, $currentOccupied) ? 'occupied' : ''); ?>" data-seat="3"></div>
                                                        <div class="admin-seat <?php echo e(in_array(4, $currentOccupied) ? 'occupied' : ''); ?>" data-seat="4"></div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label fw-bold text-danger d-block mb-1">Hotel Penuh</label>
                                                    <div class="hotel-full-grid">
                                                        <?php $__currentLoopData = $hotelOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <label class="hotel-full-option <?php echo e(in_array($hotel['name'], $unavailableHotels, true) ? 'is-full' : ''); ?>">
                                                                <input type="checkbox" name="unavailable_hotels[]" value="<?php echo e($hotel['name']); ?>" <?php echo e(in_array($hotel['name'], $unavailableHotels, true) ? 'checked' : ''); ?>>
                                                                <span>
                                                                    <strong><?php echo e($hotel['name']); ?></strong>
                                                                    <small>Kisaran Rp <?php echo e(number_format($hotel['price'], 0, ',', '.')); ?>/mlm</small>
                                                                </span>
                                                            </label>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label fw-bold text-danger d-block mb-1">Restoran Tidak Tersedia</label>
                                                    <div class="hotel-full-grid">
                                                        <?php $__currentLoopData = $restaurantOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <label class="hotel-full-option <?php echo e(in_array($restaurant['name'], $unavailableRestaurants, true) ? 'is-full' : ''); ?>">
                                                                <input type="checkbox" name="unavailable_restaurants[]" value="<?php echo e($restaurant['name']); ?>" <?php echo e(in_array($restaurant['name'], $unavailableRestaurants, true) ? 'checked' : ''); ?>>
                                                                <span>
                                                                    <strong><?php echo e($restaurant['name']); ?></strong>
                                                                    <small>Tidak muncul sebagai pilihan aktif di user</small>
                                                                </span>
                                                            </label>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label class="form-label fw-bold text-danger d-block mb-1">Menu Habis</label>
                                                    <div class="hotel-full-grid">
                                                        <?php $__currentLoopData = $restaurantOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php $__currentLoopData = ($restaurant['menus'] ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php
                                                                    $menuKey = $restaurant['name'] . '::' . $menu['name'];
                                                                ?>
                                                                <label class="hotel-full-option <?php echo e(in_array($menuKey, $unavailableMenus, true) || in_array($menu['name'], $unavailableMenus, true) ? 'is-full' : ''); ?>">
                                                                    <input type="checkbox" name="unavailable_menus[]" value="<?php echo e($menuKey); ?>" <?php echo e(in_array($menuKey, $unavailableMenus, true) || in_array($menu['name'], $unavailableMenus, true) ? 'checked' : ''); ?>>
                                                                    <span>
                                                                        <strong><?php echo e($menu['name']); ?></strong>
                                                                        <small><?php echo e($restaurant['name']); ?> - Rp <?php echo e(number_format($menu['price'], 0, ',', '.')); ?></small>
                                                                    </span>
                                                                </label>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
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
                            <td colspan="8" class="text-center py-5 text-muted">
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
                        <div class="col-12">
                            <label class="form-label fw-bold">Location Details</label>
                            <input type="text" name="location" class="form-control" placeholder="Full address" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Tell about this place..." required></textarea>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label fw-bold text-danger d-block mb-1">Set Blokir Kursi</label>
                            <input type="hidden" name="occupied_seats" id="add_occupied_seats_input" value="">
                            <div class="admin-seat-container" id="addSeatGrid">
                                <div class="admin-seat" data-seat="1"></div>
                                <div class="admin-seat" data-seat="2"></div>
                                <div class="admin-aisle"></div>
                                <div class="admin-seat" data-seat="3"></div>
                                <div class="admin-seat" data-seat="4"></div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="alert alert-light border rounded-4 mb-0">
                                <i class="bi bi-info-circle text-success me-2"></i>
                                Simpan destinasi dulu, lalu klik edit untuk mengatur hotel penuh, restoran tidak tersedia, dan menu habis.
                            </div>
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

    /* CSS Khusus Admin Grid Kursi Premium Maksimal 4 Kursi */
    .admin-seat-container {
        display: grid;
        grid-template-columns: 45px 45px 25px 45px 45px;
        gap: 12px;
        justify-content: center;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 12px;
        border: 1px solid #dee2e6;
        width: fit-content;
        margin: 0 auto;
    }
    .admin-seat {
        width: 45px;
        height: 45px;
        background-color: #ffffff;
        border: 2px solid #198754;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 0 !important;
        color: transparent !important;
        text-indent: -9999px !important;
    }
    .admin-seat::before, .admin-seat::after {
        content: "" !important;
        display: none !important;
    }
    .admin-seat.occupied {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
    }
    .admin-aisle {
        width: 25px;
    }

    .hotel-full-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 10px;
    }

    .hotel-full-option {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 12px;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        background: #fff;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .hotel-full-option input {
        margin-top: 4px;
    }

    .hotel-full-option span {
        display: flex;
        flex-direction: column;
        line-height: 1.3;
    }

    .hotel-full-option small {
        color: #6c757d;
    }

    .hotel-full-option.is-full {
        border-color: #dc3545;
        background: #fff5f5;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Logika SweetAlert Delete
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

        // Logika Klik Kursi Modal Add
        const addSeats = document.querySelectorAll('#addSeatGrid .admin-seat');
        addSeats.forEach(seat => {
            seat.addEventListener('click', function() {
                this.classList.toggle('occupied');
                const occupiedArray = [];
                document.querySelectorAll('#addSeatGrid .admin-seat.occupied').forEach(s => {
                    occupiedArray.push(s.getAttribute('data-seat'));
                });
                document.getElementById('add_occupied_seats_input').value = occupiedArray.join(',');
            });
        });

        // Logika Klik Kursi Modal Edit (Looping Sejenis Aman)
        const editGrids = document.querySelectorAll('.edit-seat-grid');
        editGrids.forEach(grid => {
            const destId = grid.getAttribute('data-id');
            const seats = grid.querySelectorAll('.admin-seat');
            const hiddenInput = document.getElementById('edit_occupied_seats_input_' + destId);
            
            seats.forEach(seat => {
                seat.addEventListener('click', function() {
                    this.classList.toggle('occupied');
                    const occupiedArray = [];
                    grid.querySelectorAll('.admin-seat.occupied').forEach(s => {
                        occupiedArray.push(s.getAttribute('data-seat'));
                    });
                    hiddenInput.value = occupiedArray.join(',');
                });
            });
        });

        document.querySelectorAll('.hotel-full-option input').forEach(input => {
            input.addEventListener('change', function() {
                this.closest('.hotel-full-option').classList.toggle('is-full', this.checked);
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Nusantara_id\resources\views/admin/destinations.blade.php ENDPATH**/ ?>