<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionApiController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->get('limit', 15);
        $transactions = Transaction::with(['user', 'transactionItems.product'])
            ->latest()
            ->paginate($limit);

        return response()->json(['success' => true, 'data' => $transactions]);
    }

    public function show($id)
    {
        $transaction = Transaction::with(['user', 'transactionItems.product'])->find($id);
        if (!$transaction) {
            return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
        }
        return response()->json(['success' => true, 'data' => $transaction]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $transaction = Transaction::create([
            'user_id' => $validated['user_id'],
            'total_amount' => $validated['total_amount'],
            'payment_method' => $validated['payment_method'],
        ]);

        foreach ($validated['items'] as $item) {
            $transaction->transactionItems()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return response()->json(['success' => true, 'data' => $transaction->load('transactionItems')], 201);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
        }

        $validated = $request->validate([
            'total_amount' => 'numeric|min:0',
            'payment_method' => 'string',
        ]);

        $transaction->update($validated);
        return response()->json(['success' => true, 'data' => $transaction]);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
        }
        
        $transaction->transactionItems()->delete();
        $transaction->delete();
        
        return response()->json(['success' => true, 'message' => 'Transaction deleted successfully']);
    }
}
