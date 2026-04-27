<?php

namespace App\Http\Controllers;

use App\Models\CheckoutRequest;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckoutConfirmationController extends Controller
{
    // Halaman list pending checkouts untuk cashier
    public function index()
    {
        $pendingCheckouts = CheckoutRequest::where('status', 'pending')
            ->notExpired()
            ->with(['order.items.product', 'customer'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pos.checkout-confirmations', compact('pendingCheckouts'));
    }

    // Detail checkout untuk approval/rejection
    public function show(CheckoutRequest $checkoutRequest)
    {
        if ($checkoutRequest->status !== 'pending') {
            return back()->with('error', 'Checkout request sudah diproses');
        }

        $checkoutRequest->load(['order.items.product', 'customer']);

        return view('pos.checkout-confirmation-detail', compact('checkoutRequest'));
    }

    // Approve checkout dari kasir
    public function approve(CheckoutRequest $checkoutRequest)
    {
        if ($checkoutRequest->status !== 'pending') {
            return response()->json(['error' => 'Checkout request sudah diproses'], 422);
        }

        if ($checkoutRequest->expired_at && $checkoutRequest->expired_at < now()) {
            $checkoutRequest->update(['status' => 'expired']);
            return response()->json(['error' => 'Checkout request telah kadaluarsa'], 422);
        }

        DB::beginTransaction();
        try {
            $order = $checkoutRequest->order;

            // Reduce stock
            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->decrement('stock', $item->quantity);
                }
            }

            // Create Transaction (kasirnya)
            $transaction = Transaction::create([
                'user_id' => $order->user_id,
                'payment_method' => $checkoutRequest->payment_method,
                'total_amount' => $order->total_amount,
                'status' => 'completed',
            ]);

            // Create Transaction Items
            foreach ($order->items as $item) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item->product_id,
                    'qty' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->subtotal,
                ]);
            }

            // Update checkout request
            $checkoutRequest->update([
                'status' => 'confirmed',
                'confirmed_by' => auth()->id(),
                'confirmed_at' => now(),
            ]);

            // Update order status
            $order->update(['status' => 'paid']);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Checkout approved!',
                'redirect' => route('pos.index'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Gagal approve checkout: ' . $e->getMessage()], 500);
        }
    }

    // Reject checkout dari kasir
    public function reject(CheckoutRequest $checkoutRequest, Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        if ($checkoutRequest->status !== 'pending') {
            return response()->json(['error' => 'Checkout request sudah diproses'], 422);
        }

        DB::beginTransaction();
        try {
            $order = $checkoutRequest->order;

            // Update checkout request
            $checkoutRequest->update([
                'status' => 'rejected',
                'rejection_reason' => $request->reason,
                'confirmed_by' => auth()->id(),
                'confirmed_at' => now(),
            ]);

            // Update order status
            $order->update(['status' => 'cancelled']);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Checkout rejected!',
                'redirect' => route('pos.confirmations.index'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Gagal reject checkout: ' . $e->getMessage()], 500);
        }
    }

    // API untuk get pending count
    public function pendingCount()
    {
        $count = CheckoutRequest::where('status', 'pending')
            ->notExpired()
            ->count();

        return response()->json(['count' => $count]);
    }
}
