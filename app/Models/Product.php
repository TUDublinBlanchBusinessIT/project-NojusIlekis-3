<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;

class Product extends Model
{
    // Allow mass‑assignment on these fields
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

    /**
     * A Product belongs to one Category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

