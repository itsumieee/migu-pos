<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\UserApiController;
use App\Http\Controllers\SettingsApiController;
use App\Http\Controllers\ReportScheduleApiController;
use App\Http\Controllers\ProfitApiController;
use App\Http\Controllers\ReportApiController;
use App\Http\Controllers\TransactionApiController;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API jalan 🚀'
    ]);
});

// API Kategori
Route::apiResource('categories', CategoryApiController::class)->names([
    'index' => 'api.categories.index',
    'show' => 'api.categories.show',
    'store' => 'api.categories.store',
    'update' => 'api.categories.update',
    'destroy' => 'api.categories.destroy',
]);

// API Produk
Route::apiResource('products', ProductApiController::class)->names([
    'index' => 'api.products.index',
    'show' => 'api.products.show',
    'store' => 'api.products.store',
    'update' => 'api.products.update',
    'destroy' => 'api.products.destroy',
]);

// API User
Route::apiResource('users', UserApiController::class)->names([
    'index' => 'api.users.index',
    'show' => 'api.users.show',
    'store' => 'api.users.store',
    'update' => 'api.users.update',
    'destroy' => 'api.users.destroy',
]);

// API Settings
Route::apiResource('settings', SettingsApiController::class)->names([
    'index' => 'api.settings.index',
    'show' => 'api.settings.show',
    'store' => 'api.settings.store',
    'update' => 'api.settings.update',
    'destroy' => 'api.settings.destroy',
]);

// API Report Schedule (Jadwal)
Route::apiResource('schedules', ReportScheduleApiController::class)->names([
    'index' => 'api.schedules.index',
    'show' => 'api.schedules.show',
    'store' => 'api.schedules.store',
    'update' => 'api.schedules.update',
    'destroy' => 'api.schedules.destroy',
]);

// API Profit (Laporan Keuntungan)
Route::get('/profits', [ProfitApiController::class, 'index']);
Route::get('/profits/{id}', [ProfitApiController::class, 'show']);

// API Reports (Laporan)
Route::get('/reports/sales', [ReportApiController::class, 'sales']);
Route::get('/reports/inventory', [ReportApiController::class, 'inventory']);
Route::get('/reports/summary', [ReportApiController::class, 'summary']);

// API Transactions (Riwayat Transaksi)
Route::apiResource('transactions', TransactionApiController::class)->names([
    'index' => 'api.transactions.index',
    'show' => 'api.transactions.show',
    'store' => 'api.transactions.store',
    'update' => 'api.transactions.update',
    'destroy' => 'api.transactions.destroy',
]);