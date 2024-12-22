<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Page extends Model
{
    use HasFactory;
    // use HasRecursiveRelationships;
    protected $fillable = ['parent_id', 'slug', 'title', 'content'];


    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function children()
    {

        return $this->hasMany(Page::class, 'parent_id');
    }

    public function scopeWithChildren($query)
    {
        return $query->with('children');
    }
}
