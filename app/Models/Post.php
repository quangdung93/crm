<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $table = 'posts';

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function category(){
        return $this->belongsTo(PostCategory::class);
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function link(){
        return $this->slug ? url($this->slug) : '';
    }
}
