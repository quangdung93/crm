<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shortcode extends Model
{
    use SoftDeletes;

    protected $table = 'shortcodes';

    protected $guarded = [];

    public function scopeActive($query){
        return $query->where('status', 1);
    }
}
