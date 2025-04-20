<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product;

class Category extends Model
{
    // Allow mass‑assignment on this field
    protected $fillable = ['name'];

    /**
     * A Category has many Products.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}

