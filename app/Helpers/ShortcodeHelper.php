<?php 

namespace App\Helpers;

use App\Models\Shortcode;

class ShortcodeHelper{

    public static function renderFromContent($content){
        $shortcodes = Shortcode::active()->pluck('value','key')->toArray();

        if($shortcodes){
            foreach ($shortcodes as $key => $value) {
                if(strpos($content, '@'.$key) !== false) {
                    $content = str_replace('@'.$key, $value, $content);
                }
            }
        }

        return $content;
    }

    public static function renderByKey($key){
        $shortcode = Shortcode::where('key', $key)->first();
        return $shortcode->value ?: '';
    }
}