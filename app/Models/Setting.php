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

    const MODEL = [
        'App\Models\Post' => 'Bài viết',
        'App\Models\Product' => 'Sản phẩm',
        'App\Models\Page' => 'Trang',
        'App\Models\PostCategory' => 'Danh mục bài viết',
        'App\Models\Category' => 'Danh mục',
        'App\Models\Brand' => 'Thương hiệu',
        'App\Models\RedirectLink' => 'Chuyển hướng',
        'App\Models\Setting' => 'Cấu hình',
        'App\Models\Theme' => 'Giao diện',
        'App\Models\User' => 'Người dùng',
        'App\Models\Menu' => 'Menu',
        'App\Models\MenuItem' => 'Mục menu',
    ];

    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            $model->removeSettingFromCache();
        });

        static::deleted(function ($model) {
            $model->removeSettingFromCache();
        });
    }

    public function removeSettingFromCache(){
        Cache::forget('settings');
    }

    public function setting($key, $default = null){
        if(Cache::has('settings')) {
            return Cache::get('settings')[$key] ?? null;
        }

        $settings = Setting::orderBy('order')->pluck('value','key')->toArray();
        Cache::forever('settings', $settings);
    
        return @$settings[$key] ?: $default;
    }
}
