<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{   
    use SoftDeletes;
    protected $table = 'pages';

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function link(){
        return $this->slug ?: '/';
    }
}
