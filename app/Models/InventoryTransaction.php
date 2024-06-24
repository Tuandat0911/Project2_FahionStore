<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InventoryTransaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transactionDetail() : HasMany {
        return $this->hasMany(InventoryTransactionDetail::class, 'inventory_transaction_id');
    }

    public function productDetail() : BelongsTo {
        return $this->belongsTo(ProductDetails::class, 'product_detail_id');
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}
