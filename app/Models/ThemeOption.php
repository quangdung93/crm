<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class ThemeOption extends Model
{
    protected $table = 'theme_options';

    protected $guarded = [];

    protected $casts = [
        'value' => 'array',
    ];

    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            $model->removeFromCache();
        });

        static::deleted(function ($model) {
            $model->removeFromCache();
        });
    }

    public function getThemeOption($key, $default = null){
        $listKey = explode('.', $key);
        if(Cache::has('themes')) {
            $themeFromCache = Cache::get('themes');
            if(isset($listKey[1])){
                return $themeFromCache[$listKey[0]][$listKey[1]] ?? null;
            }
            return $themeFromCache[$listKey[0]] ?? null;
        }

        $themes = self::pluck('value','key')->toArray();
        Cache::forever('themes', $themes);
    
        return isset($listKey[1]) ? $themes[$listKey[0]][$listKey[1]] : ($themes[$listKey[0]] ?: $default);
    }

    public function removeFromCache(){
        Cache::forget('themes');
    }
}
