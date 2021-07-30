<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{   
    use SoftDeletes;

    protected $table = 'settings';

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public $setting_cache = null;

    public function setting($key, $default = null){
        if (Cache::tags('settings')->has($key)) {
            return Cache::tags('settings')->get($key);
        }

        if ($this->setting_cache === null) {
            Cache::tags('settings')->flush();

            foreach (Setting::orderBy('order')->get() as $setting) {
                @$this->setting_cache[$setting->key] = $setting->value;
                Cache::tags('settings')->forever($setting->key, $setting->value);
            }
        }
    
        return @$this->setting_cache[$key] ?: $default;
    }
}
