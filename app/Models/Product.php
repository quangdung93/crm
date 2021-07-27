<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable')->orderBy('sequence');
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function links(){
        return $this->slug;
    }
}
