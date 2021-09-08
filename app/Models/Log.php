<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';

    protected $guarded = [];

    protected $casts = [
        'new' => 'array',
        'old' => 'array',
        'changed' => 'array',
    ];

    const HIDDEN_LOG = ['created_at','updated_at', 'deleted_at'];

    public function logable(){
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
