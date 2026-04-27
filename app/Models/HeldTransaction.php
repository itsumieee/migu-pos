<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeldTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'cart_data',
        'total_amount',
        'notes',
        'expires_at'
    ];
    
    protected $casts = [
        'cart_data' => 'array',
        'expires_at' => 'datetime'
    ];
    
    // Scope for active (non-expired) holds
    public function scopeActive($query)
    {
        return $query->where('expires_at', '>', now());
    }
}