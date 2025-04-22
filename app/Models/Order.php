<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status',
    ];

    // An Order belongs to a User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // An Order has many OrderItems
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}

