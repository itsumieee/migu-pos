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

// Test endpoint untuk debug update dengan JSON
Route::put('/test-simple-update/{id}', function ($id) {
    $product = \App\Models\Product::find($id);
    if (!$product) {
        return response()->json(['error' => 'Product not found']);
    }
    
    // Update dengan value yang fix
    $product->update([
        'price' => 77777,
        'stock' => 777
    ]);
    
    // Reload
    $product->refresh();
    
    return response()->json([
        'success' => true,
        'message' => 'Simple update test',
        'data' => [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock,
            'updated_at' => $product->updated_at
        ]
    ]);
});

// Test endpoint untuk debug request body
Route::put('/test-debug-update/{id}', function ($id) {
    $product = \App\Models\Product::find($id);
    if (!$product) {
        return response()->json(['error' => 'Product not found']);
    }
    
    $req = request();
    
    return response()->json([
        'debug' => [
            'content_type' => $req->header('Content-Type'),
            'method' => $req->method(),
            'all' => $req->all(),
            'input' => $req->input(),
            'json' => $req->json()->all() ?? [],
            'is_json' => $req->isJson(),
            'raw_content' => substr($req->getContent(), 0, 500)
        ]
    ]);
});

// Test endpoint untuk form-data update
Route::put('/test-form-update/{id}', function ($id) {
    $product = \App\Models\Product::find($id);
    if (!$product) {
        return response()->json(['error' => 'Product not found']);
    }
    
    $req = request();
    
    // Debug detail
    $allData = $req->all();
    $price = $req->input('price');
    $stock = $req->input('stock');
    
    \Log::info('=== FORM UPDATE DEBUG ===', [
        'content_type' => $req->header('Content-Type'),
        'method' => $req->method(),
        'all_request' => $allData,
        'price_from_input' => $price,
        'stock_from_input' => $stock,
        'has_price' => isset($allData['price']),
        'has_stock' => isset($allData['stock']),
    ]);
    
    // Jika ada data, update
    if (!empty($allData)) {
        $update = [];
        if (isset($allData['price'])) $update['price'] = $allData['price'];
        if (isset($allData['stock'])) $update['stock'] = $allData['stock'];
        
        if (!empty($update)) {
            $product->update($update);
            $product->refresh();
        }
    }
    
    return response()->json([
        'success' => true,
        'message' => 'Form-data update test',
        'request_debug' => [
            'all_data_received' => $allData,
            'price' => $price,
            'stock' => $stock
        ],
        'data' => [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock,
            'updated_at' => $product->updated_at
        ]
    ]);
});

// Test endpoint untuk lihat product di database
Route::get('/test-show/{id}', function ($id) {
    $product = \App\Models\Product::find($id);
    if (!$product) {
        return response()->json(['error' => 'Product not found']);
    }
    
    return response()->json([
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'cost_price' => $product->cost_price,
        'stock' => $product->stock,
        'image' => $product->image,
        'created_at' => $product->created_at,
        'updated_at' => $product->updated_at
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