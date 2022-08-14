<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function detail(){
        return $this->belongsToMany(Product::class, 'order_detail','order_id', 'product_id')
        ->withPivot('qty', 'price_old', 'price', 'subtotal');
    }

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ward(){
        return $this->belongsTo(Ward::class);
    }
}
