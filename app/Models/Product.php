<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function productDetails(): HasMany {
        return $this->hasMany(ProductDetails::class, 'product_id');
    }

    public function images(): HasMany {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function index() {
        $data = DB::table('products')->paginate(5);
        return $data;
    }

    public function category() : BelongsTo {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags() : BelongsToMany {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
        // many to many                       table          bang trung gian              table
    }

    public function sizes() : BelongsToMany {
        return $this->belongsToMany(Size::class, 'product_size', 'product_id', 'size_id');
    }

    public function productImages() {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
