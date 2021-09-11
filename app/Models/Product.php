<?php

namespace App\Models;

use App\Traits\LogActivity;
use App\Helpers\ShortcodeHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use LogActivity;
    protected $table = 'products';

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function category(){
        return $this->categories()->where('is_primary', 1);
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable')->orderBy('sequence');
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function link(){
        return config('stableweb.prefix.product.slug') .'/'. $this->slug ?: '/';
    }

    public function handleContent(){
        $this->body = ShortcodeHelper::renderFromContent($this->body);
        //Lazyload image in body content 
        $this->content = str_replace('src','data-src',$this->content);
    }
}
