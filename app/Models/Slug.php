<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{   
    protected $table = 'slugs';

    protected $guarded = [];

    public function slugable(){
        return $this->morphTo();
    }
}
