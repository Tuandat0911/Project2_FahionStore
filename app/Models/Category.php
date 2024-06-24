<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'parent_id', 'slug'];

    public function categoryChild() : HasMany {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function categoryParent() : BelongsTo {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
