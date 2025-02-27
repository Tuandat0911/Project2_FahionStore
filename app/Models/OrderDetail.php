<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function product(): BelongsTo {
        return $this->belongsTo(ProductDetails::class,'product_id');
    }
}
