<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use SoftDeletes;
    protected $table = 'brands';

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function link(){
        return $this->slug ? url($this->slug) : '';
    }
}
