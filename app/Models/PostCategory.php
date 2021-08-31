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

    public function posts(){
        return $this->belongsToMany(Post::class, 'post_category');
    }

    public function parent(){
        return $this->belongsTo(self::class, 'parent_id','id');
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function link(){
        if(!is_null($this->parent)){
            return $this->parent->slug .'/'. $this->slug;
        }
        
        return $this->slug ?: '/';
    }
}
