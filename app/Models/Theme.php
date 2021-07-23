<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'themes';

    protected $guarded = [];

    public function options(){
        return $this->hasMany(ThemeOption::class, 'theme_id');
    }

    public function scopeActive($query){
        return $query->where('active', 1);
    }
}
