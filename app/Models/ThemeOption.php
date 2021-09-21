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
        // $this->removeFromCache();
        $listKey = explode('.', $key);
        $mainKey = $listKey[0];
        $subKey = isset($listKey[1]) ? $listKey[1] : null;

        if(Cache::has('themes')) {
            $themeFromCache = Cache::get('themes');
            return $this->handleResponse($themeFromCache, $mainKey, $subKey);
        }

        $themes = self::pluck('value','key')->toArray();
        Cache::forever('themes', $themes);
        return $this->handleResponse($themes, $mainKey, $subKey, $default);
    }

    public function handleResponse($data, $mainKey, $subKey, $default = null){
        if(!isset($data[$mainKey])){
            return null;
        }

        if(is_array($data[$mainKey])){ 
            if(count($data[$mainKey]) === 1 && $subKey){ //Single array
                return @$data[$mainKey][0][$subKey]; // return string
            }

            if(isset($data[$mainKey][0])){ //Check if is a nested array
                return $data[$mainKey]; // return array
            }
        }

        return @$data[$mainKey] ?: $default;
    }

    public function removeFromCache(){
        Cache::forget('themes');
    }
}
