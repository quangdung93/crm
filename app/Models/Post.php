<?php

namespace App\Models;

use App\Traits\LogActivity;
use App\Helpers\ShortcodeHelper;
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

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable')->where('status', 1);
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function link(){
        return config('stableweb.prefix.post.slug') .'/'. $this->slug ?: '/';
    }

    public function handleContentPost(){
        $this->body = ShortcodeHelper::renderFromContent($this->body);
        //Lazyload image in body content 
        $this->body = str_replace('src','data-src',$this->body);
    }
}
