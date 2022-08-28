<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function detail(){
        return $this->belongsToMany(Product::class, 'order_detail','order_id', 'product_id')
        ->withPivot('qty', 'price_old', 'price', 'subtotal', 'discount');
    }

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function ward(){
        return $this->belongsTo(Ward::class);
    }
}
