<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home.index');

Auth::routes();

Route::get('/destinations', [App\Http\Controllers\DestinationController::class, 'index'])->name('destinations.index');

Route::get('/destination/{id}', [App\Http\Controllers\DestinationController::class, 'show'])->name('destination.show');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/education', function () {
    return view('education');
})->name('education');

Route::get('/invoice', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoice.check');
Route::post('/invoice/check', [App\Http\Controllers\InvoiceController::class, 'check'])->name('invoice.check.process');

// Booking Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/booking/education/{package}', function($package) {
        return redirect()->route('destinations.index')->with('info', 'Silakan pilih destinasi wisata yang ingin Anda kunjungi untuk Program Edukasi Paket ' . ucfirst($package) . '. Kami akan menyesuaikan kurikulumnya!');
    })->name('booking.education');
    Route::get('/booking/{destination}', [App\Http\Controllers\BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{booking}/success', [App\Http\Controllers\BookingController::class, 'success'])->name('booking.success');
});

// User Dashboard Routes
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/bookings', [App\Http\Controllers\UserDashboardController::class, 'bookings'])->name('bookings');
    Route::get('/profile', [App\Http\Controllers\UserDashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\UserDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password', [App\Http\Controllers\UserDashboardController::class, 'updatePassword'])->name('password.update');
    Route::patch('/bookings/{booking}/cancel', [App\Http\Controllers\UserDashboardController::class, 'cancelBooking'])->name('bookings.cancel');
    
    // Invoice routes
    Route::get('/invoices', [App\Http\Controllers\UserDashboardController::class, 'invoices'])->name('invoices');
    Route::get('/invoices/{booking}', [App\Http\Controllers\UserDashboardController::class, 'invoiceDetail'])->name('invoices.show');
    Route::get('/invoices/{booking}/download-pdf', [App\Http\Controllers\UserDashboardController::class, 'downloadInvoicePdf'])->name('invoices.download-pdf');
    Route::post('/invoices/{booking}/resend-email', [App\Http\Controllers\UserDashboardController::class, 'resendInvoiceEmail'])->name('invoices.resend-email');
    Route::post('/invoices/{booking}/confirm-payment', [App\Http\Controllers\UserDashboardController::class, 'confirmPayment'])->name('invoices.confirm-payment');
});

// Admin Routes
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    // Destinations CRUD
    Route::get('/destinations', [\App\Http\Controllers\Admin\DestinationController::class, 'index'])->name('destinations');
    // ... (rute destinations lainnya tetap sama)
    Route::post('/destinations', [\App\Http\Controllers\Admin\DestinationController::class, 'store'])->name('destinations.store');
    Route::get('/destinations/{destination}', [\App\Http\Controllers\Admin\DestinationController::class, 'show'])->name('destinations.show');
    Route::get('/destinations/{destination}/edit', [\App\Http\Controllers\Admin\DestinationController::class, 'edit'])->name('destinations.edit');
    Route::put('/destinations/{destination}', [\App\Http\Controllers\Admin\DestinationController::class, 'update'])->name('destinations.update');
    Route::delete('/destinations/{destination}', [\App\Http\Controllers\Admin\DestinationController::class, 'destroy'])->name('destinations.destroy');
    
    // Bookings CRUD
    Route::get('/bookings', [\App\Http\Controllers\Admin\BookingController::class, 'index'])->name('bookings');
    Route::get('/bookings/{booking}', [\App\Http\Controllers\Admin\BookingController::class, 'show'])->name('bookings.show');
    Route::put('/bookings/{booking}', [\App\Http\Controllers\Admin\BookingController::class, 'update'])->name('bookings.update');
    Route::patch('/bookings/{booking}/status', [\App\Http\Controllers\Admin\BookingController::class, 'updateStatus'])->name('bookings.status');
    Route::delete('/bookings/{booking}', [\App\Http\Controllers\Admin\BookingController::class, 'destroy'])->name('bookings.destroy');
    
    // Users CRUD
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users');
    Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
    Route::put('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    
    // Packages CRUD
    Route::get('/packages', [\App\Http\Controllers\Admin\PackageController::class, 'index'])->name('packages');
    Route::post('/packages', [\App\Http\Controllers\Admin\PackageController::class, 'store'])->name('packages.store');
    Route::get('/packages/{package}', [\App\Http\Controllers\Admin\PackageController::class, 'show'])->name('packages.show');
    Route::put('/packages/{package}', [\App\Http\Controllers\Admin\PackageController::class, 'update'])->name('packages.update');
    Route::delete('/packages/{package}', [\App\Http\Controllers\Admin\PackageController::class, 'destroy'])->name('packages.destroy');
    
    // Reports
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports');
    
    // Settings
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings');
    Route::put('/settings/profile', [\App\Http\Controllers\Admin\SettingController::class, 'updateProfile'])->name('settings.profile');
    Route::put('/settings/profile/image', [\App\Http\Controllers\Admin\SettingController::class, 'updateImage'])->name('settings.profile.image'); // Baris Baru
    Route::put('/settings/password', [\App\Http\Controllers\Admin\SettingController::class, 'updatePassword'])->name('settings.password');
});