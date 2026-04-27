<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 
        'total_amount', 
        'payment_amount', 
        'change_amount', 
        'payment_method' // ← PASTIKAN ADA INI
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'payment_amount' => 'decimal:2',
        'change_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }

    // Alias for transactionItems()
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}