<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';

    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function children(){
        return $this->hasMany(self::class, 'father_id', 'id');
    }

    public function childrens(){
        return $this->children()->with('childrens');
    }

    public function parent(){
        return $this->belongsTo(self::class, 'father_id','id');
    }

    public function parents(){
        return $this->parent()->with('parents');
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'product_category');
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function link(){
        return $this->slug ?: '/';
    }

    public function getCategory($category_id){
        return self::where('id', $category_id)->with('products')->first();
    }
}
