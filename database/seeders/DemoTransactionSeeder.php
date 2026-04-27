<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class DemoTransactionSeeder extends Seeder
{
    public function run(): void
    {
        // Get admin user
        $admin = User::first();
        if (!$admin) {
            $this->command->error('No users found! Run UserFactory first.');
            return;
        }

        // Get some products
        $products = Product::limit(5)->get();
        if ($products->isEmpty()) {
            $this->command->error('No products found! Run MiguInitialDataSeeder first.');
            return;
        }

        // Create transactions for last 7 days
        $now = now();
        for ($day = 6; $day >= 0; $day--) {
            $date = $now->copy()->subDays($day);
            
            // 2-4 transactions per day
            $txCount = rand(2, 4);
            for ($tx = 0; $tx < $txCount; $tx++) {
                // Random time in that day
                $time = $date->copy()->addHours(rand(8, 22))->addMinutes(rand(0, 59));
                
                $transaction = Transaction::create([
                    'user_id' => $admin->id,
                    'total_amount' => 0, // Will be calculated
                    'payment_amount' => 0,
                    'change_amount' => 0,
                    'payment_method' => ['cash', 'card', 'transfer'][rand(0, 2)],
                    'created_at' => $time,
                    'updated_at' => $time,
                ]);

                // Add 1-3 items per transaction
                $itemCount = rand(1, 3);
                $total = 0;
                
                for ($item = 0; $item < $itemCount; $item++) {
                    $product = $products->random();
                    $qty = rand(1, 3);
                    $subtotal = $product->price * $qty;
                    
                    TransactionItem::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $product->id,
                        'qty' => $qty,
                        'price' => $product->price,
                        'subtotal' => $subtotal,
                    ]);
                    
                    $total += $subtotal;
                }

                // Update transaction totals
                $transaction->update([
                    'total_amount' => $total,
                    'payment_amount' => $total,
                    'change_amount' => 0,
                ]);
            }
        }

        $this->command->info('✅ Demo transactions created for last 7 days!');
    }
}
