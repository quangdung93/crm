<?php

use Carbon\Carbon;

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

if (!function_exists('format_date')) {
    function format_date($data){
        return Carbon::parse($data)->format('d/m/Y');
    }
}

if (!function_exists('format_datetime')) {
    function format_datetime($data){
        return Carbon::parse($data)->format('d/m/Y - H:i');
    }
}

if (!function_exists('theme_field')){

	function theme_field($type, $key, $title, $content = '', $details = '', $placeholder = '', $required = 0){
		
        $theme = App\Models\Theme::where('folder', '=', config('themes.active_theme_folder'))->first();
		$option_exists = $theme->options->where('key', $key)->first();

		if(isset($option_exists->value)){
			$content = $option_exists->value;
		}

		$row = new class{ public function getTranslatedAttribute(){} };
		$row->required = $required;
		$row->field = $key;
		$row->type = $type;
		$row->details = $details;
		$row->display_name = $placeholder;

		$dataTypeContent = new class{ public function getKey(){} };
		$dataTypeContent->{$key} = $content;

		$label = '<label for="'. $key . '">' . $title . '<span class="how_to">You can reference this value with <code>theme(\'' . $key . '\')</code></span></label>';
		$details = '<input type="hidden" value="' . $details . '" name="' . $key . '_details__theme_field">';
		$type = '<input type="hidden" value="' . $type . '" name="' . $key . '_type__theme_field">';
		return $label . app('voyager')->formField($row, '', $dataTypeContent) . $details . $type . '<hr>';
	}
}

if (!function_exists('theme')){
	function theme($key, $default = ''){
		$theme = App\Models\Theme::active()->first();

		if(Cookie::get('theme')){
            $theme_cookied = App\Models\Theme::where('folder', Cookie::get('theme'))->first();
            if(isset($theme_cookied->id)){
                $theme = $theme_cookied;
            }
        }

		$value = $theme->options->where('key', $key)->first();

		if(isset($value)) {
			return $value->value;
		}

		return $default;
	}
}