<?php

namespace App\Models;

use App\Helpers\ShortcodeHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{   
    use SoftDeletes;
    protected $table = 'pages';

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable')->where('status', 1);
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function link(){
        return $this->slug ?: '/';
    }

    public function handleContent(){
        //Lazyload image in body content 
        $this->body = ShortcodeHelper::renderFromContent($this->body);
        $this->body = str_replace('src','data-src',$this->body);
    }
}
