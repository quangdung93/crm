<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'menu_items';

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->menu->removeMenuFromCache();
        });

        static::saved(function ($model) {
            $model->menu->removeMenuFromCache();
        });

        static::deleted(function ($model) {
            $model->menu->removeMenuFromCache();
        });
    }

    public function children(){
        return $this->hasMany(self::class, 'parent_id', 'id')->with('children');
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public static function highestOrderMenuItem($parent = null){
        $order = 1;
        $item = self::where('parent_id', '=', $parent)
                    ->orderBy('order', 'DESC')
                    ->first();

        if (!is_null($item)) {
            $order = intval($item->order) + 1;
        }

        return $order;
    }

}
