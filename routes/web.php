<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\TrackingController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ShipmentController as AdminShipmentController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\TeamController as AdminTeamController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;

// =====================
// FRONTEND ROUTES
// =====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');

Route::prefix('layanan')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/{slug}', [ServiceController::class, 'show'])->name('show');
});

Route::prefix('lacak')->name('tracking.')->group(function () {
    Route::get('/', [TrackingController::class, 'index'])->name('index');
    Route::post('/', [TrackingController::class, 'track'])->name('track');
});

Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

Route::prefix('kontak')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
});

// Alias for contact route used in views
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');

// =====================
// AUTH ROUTES (Breeze)
// =====================
require __DIR__.'/auth.php';

// =====================
// ADMIN ROUTES
// =====================
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Services
    Route::resource('services', AdminServiceController::class)->names([
        'index'   => 'services.index',
        'create'  => 'services.create',
        'store'   => 'services.store',
        'edit'    => 'services.edit',
        'update'  => 'services.update',
        'destroy' => 'services.destroy',
    ]);

    // Shipments
    Route::resource('shipments', AdminShipmentController::class)->names([
        'index'   => 'shipments.index',
        'create'  => 'shipments.create',
        'store'   => 'shipments.store',
        'show'    => 'shipments.show',
        'edit'    => 'shipments.edit',
        'update'  => 'shipments.update',
        'destroy' => 'shipments.destroy',
    ]);
    Route::post('/shipments/{shipment}/history', [AdminShipmentController::class, 'addHistory'])->name('shipments.history');

    // Blog
    Route::resource('blog', AdminBlogController::class)->names([
        'index'   => 'blog.index',
        'create'  => 'blog.create',
        'store'   => 'blog.store',
        'edit'    => 'blog.edit',
        'update'  => 'blog.update',
        'destroy' => 'blog.destroy',
    ]);

    // Testimonials
    Route::resource('testimonials', AdminTestimonialController::class)->names([
        'index'   => 'testimonials.index',
        'create'  => 'testimonials.create',
        'store'   => 'testimonials.store',
        'edit'    => 'testimonials.edit',
        'update'  => 'testimonials.update',
        'destroy' => 'testimonials.destroy',
    ]);

    // Contacts (inbox)
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');

    // Team
    Route::resource('team', AdminTeamController::class)->names([
        'index'   => 'team.index',
        'create'  => 'team.create',
        'store'   => 'team.store',
        'edit'    => 'team.edit',
        'update'  => 'team.update',
        'destroy' => 'team.destroy',
    ]);

    // Settings
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
});
