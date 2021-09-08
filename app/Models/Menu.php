<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            $model->removeMenuFromCache($model->getOriginal('name'));
        });

        static::deleted(function ($model) {
            $model->removeMenuFromCache($model->getOriginal('name'));
        });
    }

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function parent_items()
    {
        return $this->hasMany(MenuItem::class)->whereNull('parent_id');
    }

    public static function display($menuName, $type = null)
    {
        //Cache
        $menu = Cache::remember('menu_'.$menuName, Carbon::now()->addDays(30), function () use ($menuName) {
            return static::where('name', '=', $menuName)
                ->with(['parent_items.children' => function ($q) {
                    $q->orderBy('order');
                }])->first();
        });

        // Check for Menu Existence
        if (!isset($menu)) {
            return false;
        }

        $items = $menu->parent_items->sortBy('order');

        $templateMenuView = 'admin.menus.template';

        if (is_null($type)) {
            $type = $templateMenuView.'.default';
        } elseif(view()->exists($templateMenuView.'.'.$type)) {
            $type = $templateMenuView.'.'.$type;
        }

        return new \Illuminate\Support\HtmlString(
            \Illuminate\Support\Facades\View::make($type, ['items' => $items])->render()
        );
    }

    public function removeMenuFromCache($menuName = null)
    {
        if(is_null($menuName)){
            $name = $this->name;
        }
        else{
            $name = $menuName;
        }

        Cache::forget('menu_'.$name);
    }
}
