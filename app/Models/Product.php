<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'sku', 'price', 'cost_price', 'stock', 'image'];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'stock' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }

    // Accessor untuk menghitung profit
    public function getProfitAttribute()
    {
        return $this->price - $this->cost_price;
    }

    // Accessor untuk menghitung profit margin (dalam persen)
    public function getProfitMarginAttribute()
    {
        if ($this->price == 0) return 0;
        return round((($this->price - $this->cost_price) / $this->price) * 100, 2);
    }
}