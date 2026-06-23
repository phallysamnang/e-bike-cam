<?php

use App\Http\Controllers\Admin\ChatController as AdminChatController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/language/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'km'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('language.switch');

Route::get('/', [FrontController::class, 'index']);

Route::get('/category/{category}', [FrontController::class, 'category'])->name('category.show');

Route::get('/product/{product}', [FrontController::class, 'show'])->name('product.show');

Route::middleware('auth')->group(function () {
    Route::get('/chat/messages', [ChatController::class, 'messages'])->name('chat.messages');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
    Route::get('/chat/unread', [ChatController::class, 'unreadCount'])->name('chat.unread');
    Route::get('/product/{product}/order', [OrderController::class, 'create'])->name('order.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('order.store');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
    Route::patch('/orders/{order}/accept', [OrderController::class, 'acceptDelivery'])->name('orders.accept');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/my-orders/{order}/payment', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/my-orders/{order}/payment/upload', [PaymentController::class, 'uploadProof'])->name('payment.upload');
});

Route::get('/dashboard', [ProductController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index')->middleware('permission:view-products');
        Route::get('/create', [ProductController::class, 'create'])->name('create')->middleware('permission:create-products');
        Route::post('/', [ProductController::class, 'store'])->name('store')->middleware('permission:create-products');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit')->middleware('permission:edit-products');
        Route::match(['put', 'patch'], '/{product}', [ProductController::class, 'update'])->name('update')->middleware('permission:edit-products');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy')->middleware('permission:delete-products');
    });

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index')->middleware('permission:view-categories');
        Route::get('/create', [CategoryController::class, 'create'])->name('create')->middleware('permission:create-categories');
        Route::post('/', [CategoryController::class, 'store'])->name('store')->middleware('permission:create-categories');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit')->middleware('permission:edit-categories');
        Route::match(['put', 'patch'], '/{category}', [CategoryController::class, 'update'])->name('update')->middleware('permission:edit-categories');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy')->middleware('permission:delete-categories');
    });

    Route::prefix('slides')->name('slides.')->group(function () {
        Route::get('/', [SlideController::class, 'index'])->name('index')->middleware('permission:view-slides');
        Route::get('/create', [SlideController::class, 'create'])->name('create')->middleware('permission:create-slides');
        Route::post('/', [SlideController::class, 'store'])->name('store')->middleware('permission:create-slides');
        Route::get('/{slide}/edit', [SlideController::class, 'edit'])->name('edit')->middleware('permission:edit-slides');
        Route::match(['put', 'patch'], '/{slide}', [SlideController::class, 'update'])->name('update')->middleware('permission:edit-slides');
        Route::delete('/{slide}', [SlideController::class, 'destroy'])->name('destroy')->middleware('permission:delete-slides');
    });
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index')->middleware('permission:view-orders');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show')->middleware('permission:view-orders');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.status')->middleware('permission:update-orders');
    Route::patch('/orders/{order}/confirm-payment', [AdminOrderController::class, 'confirmPayment'])->name('orders.confirm-payment')->middleware('permission:update-orders');
    Route::get('/orders/pending-payments/count', [AdminOrderController::class, 'pendingPayments'])->name('orders.pending-payments')->middleware('permission:view-orders');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [ReportController::class, 'exportCsv'])->name('reports.export');
    Route::get('/reports/export-stock', [ReportController::class, 'exportStockCsv'])->name('reports.export-stock');
    Route::get('/chat', [AdminChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{user}', [AdminChatController::class, 'conversation'])->name('chat.conversation');
    Route::post('/chat/{user}/reply', [AdminChatController::class, 'reply'])->name('chat.reply');
    Route::get('/chat/{user}/messages', [AdminChatController::class, 'fetchMessages'])->name('chat.messages');
    Route::post('/chat/{user}/send-reply', [AdminChatController::class, 'sendReply'])->name('chat.send-reply');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class)->except(['create', 'store', 'show']);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});

require __DIR__.'/auth.php';
