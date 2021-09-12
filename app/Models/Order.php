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
    const TYPE_ORDER = 'order';
    const TYPE_REGISTER = 'register';
    const TYPE_INSTALLMENT = 'installment';

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

    public function ward(){
        return $this->belongsTo(Ward::class);
    }

    public function scopeType($query, $type){
        return $query->where('order_type', $type);
    }
}
