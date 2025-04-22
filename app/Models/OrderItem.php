<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    // An OrderItem belongs to an Order
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // An OrderItem belongs to a Product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

