<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductDetails extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sizes(): BelongsTo {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function products(): BelongsTo {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
