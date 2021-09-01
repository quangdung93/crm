<?php

namespace App\Models;

use App\Traits\LogActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use LogActivity;
    use SoftDeletes;
    protected $table = 'posts';

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function categories(){
        return $this->belongsToMany(PostCategory::class, 'post_category');
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function link(){
        return 'tin-tuc/' . $this->slug ?: '/';
    }

    public function handleContentPost(){
        //Lazyload image in body content 
        $this->body = str_replace('src','data-src',$this->body);
    }
}
