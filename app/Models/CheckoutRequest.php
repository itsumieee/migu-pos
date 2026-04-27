<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CheckoutRequest extends Model
{
    protected $fillable = [
        'order_id', 'customer_id', 'total_amount', 'payment_method',
        'status', 'confirmed_by', 'rejection_reason', 'confirmed_at', 'expired_at'
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
        'expired_at' => 'datetime',
        'total_amount' => 'decimal:2',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function confirmedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    // Scope untuk pending requests
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope untuk not expired
    public function scopeNotExpired($query)
    {
        return $query->where('expired_at', '>', now())->orWhereNull('expired_at');
    }
}
