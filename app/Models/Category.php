<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
 
    protected $guarded = ['id'];
    protected $appends = ['parentCategoryName'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function getParentCategoryNameAttribute()
    {
        $parentCategoryName = $this->parentCategory()->value('name');

        return $parentCategoryName ?: '';
    }
}