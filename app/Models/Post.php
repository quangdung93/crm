<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $guarded = [];

    public function links(){
        return $this->slug;
    }

    public function category(){
        return $this->belongsTo(PostCategory::class);
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function link(){
        return $this->slug;
    }
}
