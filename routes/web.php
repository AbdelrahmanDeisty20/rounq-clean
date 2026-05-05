<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;

// Site Routes
Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::post('/book', [SiteController::class, 'storeBooking'])->name('booking.store');
Route::post('/contact', [SiteController::class, 'storeContact'])->name('contact.store');
Route::post('/track-click', [SiteController::class, 'trackClick'])->name('track.click');

// Admin Auth
Route::get('/admin/login', function() { return view('admin.login'); })->name('login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin Panel (Multi-page Dashboard)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // Content Manager
    Route::get('/home-manager', [AdminController::class, 'homeManager'])->name('admin.home-manager')->middleware('permission:manage home settings');
    
    Route::middleware('permission:manage services')->group(function() {
        Route::get('/services', [AdminController::class, 'services'])->name('admin.services');
        Route::post('/services', [AdminController::class, 'storeService']);
        Route::post('/services/{id}', [AdminController::class, 'updateService']);
        Route::delete('/services/{id}', [AdminController::class, 'deleteService']);
    });
    
    Route::middleware('permission:manage bookings')->group(function() {
        Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
        Route::post('/bookings/{id}/status', [AdminController::class, 'updateBookingStatus']);
        Route::delete('/bookings/{id}', [AdminController::class, 'deleteBooking']);
    });
    
    Route::middleware('permission:manage offers')->group(function() {
        Route::get('/offers', [AdminController::class, 'offers'])->name('admin.offers');
        Route::post('/offers', [AdminController::class, 'storeOffer']);
        Route::post('/offers/{id}', [AdminController::class, 'updateOffer']);
        Route::delete('/offers/{id}', [AdminController::class, 'deleteOffer']);
    });
    
    Route::middleware('permission:manage testimonials')->group(function() {
        Route::get('/testimonials', [AdminController::class, 'testimonials'])->name('admin.testimonials');
        Route::post('/testimonials', [AdminController::class, 'storeTestimonial']);
        Route::post('/testimonials/{id}', [AdminController::class, 'updateTestimonial']);
        Route::delete('/testimonials/{id}', [AdminController::class, 'deleteTestimonial']);
    });
    
    Route::middleware('permission:manage faqs')->group(function() {
        Route::get('/faqs', [AdminController::class, 'faqs'])->name('admin.faqs');
        Route::post('/faqs', [AdminController::class, 'storeFaq']);
        Route::post('/faqs/{id}', [AdminController::class, 'updateFaq']);
        Route::delete('/faqs/{id}', [AdminController::class, 'deleteFaq']);
    });
    
    Route::middleware('permission:manage blogs')->group(function() {
        Route::get('/blogs', [AdminController::class, 'blogs'])->name('admin.blogs');
        Route::post('/blogs', [AdminController::class, 'storeBlog']);
        Route::post('/blogs/{id}', [AdminController::class, 'updateBlog']);
        Route::delete('/blogs/{id}', [AdminController::class, 'deleteBlog']);
    });
    
    Route::middleware('permission:manage messages')->group(function() {
        Route::get('/messages', [AdminController::class, 'messages'])->name('admin.messages');
        Route::post('/messages/{id}/reply', [AdminController::class, 'markMessageReplied']);
        Route::delete('/messages/{id}', [AdminController::class, 'deleteMessage']);
    });
    
    Route::middleware('permission:manage gallery')->group(function() {
        Route::get('/gallery', [AdminController::class, 'gallery'])->name('admin.gallery');
        Route::post('/gallery', [AdminController::class, 'storeGallery']);
        Route::put('/gallery/{id}', [AdminController::class, 'updateGallery']);
        Route::delete('/gallery/{id}', [AdminController::class, 'deleteGallery']);
    });

    // Settings & Others
    Route::get('/contact-settings', [AdminController::class, 'contactSettings'])->name('admin.contact_settings')->middleware('permission:manage contact settings');
    Route::get('/seo', [AdminController::class, 'seo'])->name('admin.seo')->middleware('permission:manage seo');
    Route::middleware('permission:manage users')->group(function() {
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    });
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('admin.analytics')->middleware('permission:view analytics');
    Route::get('/change-password', [AdminController::class, 'changePassword'])->name('admin.change_password');
    Route::post('/change-password', [AdminController::class, 'updatePassword'])->name('admin.update_password');
    
    Route::post('/home-settings', [AdminController::class, 'updateHomeSettings']);
    Route::post('/contact-settings', [AdminController::class, 'updateContactSettings']);
    Route::post('/seo', [AdminController::class, 'updateSeoSettings']);
    Route::post('/upload-image', [AdminController::class, 'uploadImage']);
});

// كشاف للمسارات (عشان نعرف الصور بتروح فين بالظبط على Hostinger)
Route::get('/check-files', function() {
    $path = public_path('uploads/gallery');
    return [
        'public_path' => public_path(),
        'gallery_path' => $path,
        'exists' => file_exists($path),
        'is_writable' => is_writable($path),
        'files' => file_exists($path) ? array_diff(scandir($path), ['.', '..']) : 'Folder not found'
    ];
});
