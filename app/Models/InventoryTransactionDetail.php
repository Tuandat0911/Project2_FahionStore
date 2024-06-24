<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryTransactionDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function productDetail() : BelongsTo {
        return $this->belongsTo(ProductDetails::class, 'product_detail_id');
    }
}
