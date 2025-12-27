<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\PageController::class, 'home'])->name('home');
Route::get('posts', [App\Http\Controllers\PageController::class, 'posts'])->name('posts');
Route::get('posts/{post:slug}', [App\Http\Controllers\PageController::class, 'detailPost'])->name('posts.show');
Route::get('paket-travel', [App\Http\Controllers\PageController::class, 'package'])->name('package');
Route::get('detail/{travelPackage:slug}', [App\Http\Controllers\PageController::class, 'detail'])->name('detail');

Route::get('kontak-kami', [App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::get('kirim-wa', [App\Http\Controllers\PageController::class, 'getWhatsapp'])->name('getWhatsapp');
Route::post('kontak-kami', [App\Http\Controllers\PageController::class, 'getEmail'])->name('contact.email');

Route::group(['middleware' => 'auth'], function() {
    // Profile Routes
    Route::get('profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
    Route::get('profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/orders', [App\Http\Controllers\ProfileController::class, 'orders'])->name('profile.orders');
    Route::delete('order/{order}/cancel', [App\Http\Controllers\ProfileController::class, 'cancelOrder'])->name('order.cancel');
    Route::get('payment/check-status/{orderId}', [App\Http\Controllers\ProfileController::class, 'checkPaymentStatus'])->name('payment.check-status');

    // Order routes
    Route::get('order/{travelPackage:slug}', [App\Http\Controllers\PageController::class, 'order'])->name('order');

    // Payment callback routes - GET untuk Midtrans
    Route::get('payment/finish', [App\Http\Controllers\PageController::class, 'paymentFinish'])->name('payment.finish');
    Route::get('payment/error', [App\Http\Controllers\PageController::class, 'paymentError'])->name('payment.error');
    Route::get('payment/pending', [App\Http\Controllers\PageController::class, 'paymentPending'])->name('payment.pending');

    // Webhook notification
    Route::post('payment/notification', [App\Http\Controllers\PageController::class, 'paymentNotification'])->name('payment.notification');

    // Payment status pages
    Route::get('payment/success', [App\Http\Controllers\PageController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('payment/failed', [App\Http\Controllers\PageController::class, 'paymentFailed'])->name('payment.failed');
    Route::get('payment/pending-page', [App\Http\Controllers\PageController::class, 'paymentPendingPage'])->name('payment.pending-page');

    Route::group(['middleware' => 'isAdmin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('posts', \App\Http\Controllers\Admin\PostController::class)->except(['show']);
        Route::get('posts/datatables', [App\Http\Controllers\Admin\PostController::class, 'datatables'])->name('posts.datatables');
        Route::resource('cars', \App\Http\Controllers\Admin\CarController::class);
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('travel-packages', \App\Http\Controllers\Admin\TravelPackageController::class)->except(['show']);
        Route::get('travel-packages/datatables', [\App\Http\Controllers\Admin\TravelPackageController::class, 'datatables'])->name('travel-packages.datatables');
        Route::resource('travel-packages.galleries', \App\Http\Controllers\Admin\GalleryController::class);
        Route::get('transactions', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('transactions.index');
        Route::get('transactions/datatables', [\App\Http\Controllers\Admin\TransactionController::class, 'datatables'])->name('transactions.datatables');
        Route::get('transactions/statistics', [\App\Http\Controllers\Admin\TransactionController::class, 'statistics'])->name('transactions.statistics');
        Route::get('transactions/{transaction}', [\App\Http\Controllers\Admin\TransactionController::class, 'show'])->name('transactions.show');
        Route::put('transactions/{transaction}/update-status', [\App\Http\Controllers\Admin\TransactionController::class, 'updateStatus'])->name('transactions.update-status');
        Route::delete('transactions/{transaction}', [\App\Http\Controllers\Admin\TransactionController::class, 'destroy'])->name('transactions.destroy');
        Route::post('transactions/export', [\App\Http\Controllers\Admin\TransactionController::class, 'export'])->name('transactions.export');
    });
});
