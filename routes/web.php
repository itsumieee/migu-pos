<?php
// Web Routes Configuration

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

// ========================================
// PUBLIC ROUTES (Customer - Tanpa Login)
// ========================================
Route::get('/', [StoreController::class, 'index'])->name('home');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Auth routes (Login/Register) - Laravel Breeze/Jetstream
require __DIR__.'/auth.php';

// ========================================
// AUTHENTICATED ROUTES (Semua user login)
// ========================================
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/api/dashboard/chart-data', [DashboardController::class, 'chartData'])->name('dashboard.chart-data');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Notifications
    Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('notifications.get');
    
    // Customer Cart & Checkout
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/waiting/{orderId}', [CheckoutController::class, 'waiting'])->name('checkout.waiting');
    Route::get('/checkout/status/{orderId}', [CheckoutController::class, 'checkStatus'])->name('checkout.status');
    Route::get('/order/success/{orderId}', [CheckoutController::class, 'success'])->name('order.success');

    // Test WhatsApp (Dev only - remove in production)
    Route::get('/test-wa', function() {
        if (!app()->isLocal()) abort(403);
        
        $whatsapp = new \App\Services\WhatsAppService();
        $product = \App\Models\Product::where('stock', '<=', 5)->first();
        
        if ($product) {
            $result = $whatsapp->sendLowStockAlert($product);
            return response()->json(['status' => $result, 'product' => $product->name]);
        }
        return response()->json(['status' => false, 'message' => 'No low stock product']);
    });

    // TEST: Create dummy checkout for debugging
    Route::get('/test-checkout', function() {
        if (!app()->isLocal()) abort(403);
        
        $user = \App\Models\User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );
        
        auth()->login($user);
        
        $order = \App\Models\Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-TEST-' . time(),
            'total_amount' => 100000,
            'status' => 'pending',
            'payment_method' => 'cash',
        ]);
        
        $checkoutRequest = \App\Models\CheckoutRequest::create([
            'order_id' => $order->id,
            'customer_id' => $user->id,
            'total_amount' => 100000,
            'payment_method' => 'cash',
            'status' => 'pending',
            'expired_at' => \Carbon\Carbon::now()->addMinutes(15),
        ]);
        
        return response()->json([
            'order' => $order,
            'checkout_request' => $checkoutRequest,
            'pending_count' => \App\Models\CheckoutRequest::where('status', 'pending')->notExpired()->count()
        ]);
    });

    // ========================================
    // POS ROUTES - Kasir & Admin Only (SIMPLE)
    // ========================================
    Route::middleware(['role:kasir,admin'])->prefix('pos')->name('pos.')->group(function () {
        
        // Main POS Page
        Route::get('/', [PosController::class, 'index'])->name('index');
        
        // Simple Form Checkout
        Route::post('/checkout', [PosController::class, 'checkout'])->name('checkout');
        
        // Receipt Print
        Route::get('/receipt/{id}', [PosController::class, 'printReceipt'])->name('receipt');
        
        // Checkout Confirmations
        Route::get('/confirmations', [App\Http\Controllers\CheckoutConfirmationController::class, 'index'])->name('confirmations.index');
        Route::get('/confirmations/{checkoutRequestId}', [App\Http\Controllers\CheckoutConfirmationController::class, 'show'])->name('confirmations.show');
        Route::post('/confirmations/{checkoutRequestId}/approve', [App\Http\Controllers\CheckoutConfirmationController::class, 'approve'])->name('confirmations.approve');
        Route::post('/confirmations/{checkoutRequestId}/reject', [App\Http\Controllers\CheckoutConfirmationController::class, 'reject'])->name('confirmations.reject');
        Route::get('/confirmations/pending-count', [App\Http\Controllers\CheckoutConfirmationController::class, 'pendingCount'])->name('confirmations.pending-count');
        
    });
    
    // ========================================
    // ADMIN ONLY ROUTES
    // ========================================
    Route::middleware(['role:admin'])->group(function () {
        
        // Export PDF (Must be BEFORE resource routes to avoid conflict)
        Route::get('/products/export-pdf', [ProductController::class, 'exportPDF'])->name('products.export.pdf');
        Route::get('/transactions/export-pdf', [TransactionController::class, 'exportPDF'])->name('transactions.export.pdf');
        Route::post('/transactions/export-pdf-by-date', [TransactionController::class, 'exportPDFByDate'])->name('transactions.export.pdf.bydate');
        Route::get('/reports/profit/export-pdf', [App\Http\Controllers\ProfitController::class, 'exportPDF'])->name('reports.profit.export.pdf');
        
        // Resource Routes
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class)->only(['index', 'store', 'destroy']);
        Route::resource('users', App\Http\Controllers\UserController::class)->except(['show']);
        Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
        
        // Transaction Print
        Route::get('/transactions/{transaction}/print', [TransactionController::class, 'print'])->name('transactions.print');
        
        // Reports
        Route::get('/reports/sales', [ReportController::class, 'sales'])->name('reports.sales');
        Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
        Route::get('/reports/profit', [App\Http\Controllers\ProfitController::class, 'index'])->name('reports.profit');
        
        // Settings
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings/general', [SettingsController::class, 'updateGeneral'])->name('settings.update.general');
        Route::post('/settings/qris', [SettingsController::class, 'updateQris'])->name('settings.update.qris');
        Route::post('/settings/ewallet', [SettingsController::class, 'updateEwallet'])->name('settings.update.ewallet');
        Route::post('/settings/system', [SettingsController::class, 'updateSystem'])->name('settings.update.system');
        Route::get('/settings/reports', [App\Http\Controllers\ReportScheduleController::class, 'index'])->name('settings.reports');
        Route::post('/settings/reports', [App\Http\Controllers\ReportScheduleController::class, 'store'])->name('settings.reports.store');
        Route::put('/settings/reports/{schedule}', [App\Http\Controllers\ReportScheduleController::class, 'update'])->name('settings.reports.update');
        Route::delete('/settings/reports/{schedule}', [App\Http\Controllers\ReportScheduleController::class, 'destroy'])->name('settings.reports.destroy');
        
        // Barcode
        Route::get('/products/{product}/barcode', [ProductController::class, 'showBarcode'])->name('products.barcode');
        Route::post('/products/barcode/print', [ProductController::class, 'printBarcode'])->name('products.barcode.print');
        
    });
});