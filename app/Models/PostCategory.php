<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use SoftDeletes;

    protected $table = 'categories_posts';
    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function link(){
        return $this->slug;
    }
}
