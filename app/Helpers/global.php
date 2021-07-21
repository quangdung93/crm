<?php

if (!function_exists('getCurrentSlug')) {
    function getCurrentSlug(){
        return request()->path();
    }
}

if (!function_exists('menu')) {
    function menu($menuName, $type = null){
        return (new App\Models\Menu)->display($menuName, $type);
    }
}

if (!function_exists('setting')) {
    function setting($key, $default = null){
        return (new App\Models\Setting)->setting($key, $default);
    }
}