<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

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

if (!function_exists('format_price')) {
    function format_price($price){
        return number_format($price);
    }
}

if (!function_exists('asset_image')) {
    function asset_image($path){
		if(Storage::disk('public')->exists($path)){
			return asset($path);
		}
		else{
			return asset('admin/images/default.png');
		}
    }
}

if (!function_exists('handle_show_attribute')) {
    function handle_show_attribute($key, $value, $model){
		if($key == 'price' || $key == 'price_old'){
			return format_price($value);
		}
		elseif($key == 'brand_id' && $model == 'App\Models\Product'){
			return App\Models\Brand::find($value)->name;
		}
		elseif($key == 'category_id'){
			if($model == 'App\Models\Product'){
				return App\Models\Category::find($value)->name;
			}
			elseif($model == 'App\Models\Post'){
				return App\Models\PostCategory::find($value)->name;
			}
		}
		elseif(in_array($key, ['content', 'body'])){
			return 'Chỉnh sửa nội dung';
		}
		
		return $value;
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

if (!function_exists('product_template')){
	function product_template($products){
		if(!$products){
			return null;
		}

		$html = '';

		foreach ($products as $item) {
			$html .= '<div class="product-item">
				<div class="product-img">
					<a href="#">
						<img src="'.asset($item->image).'" alt="'.$item->name.'"/>
					</a>
					<div class="discount">-'.round($item->discount, 1).'%</div>
				</div>
				<div class="product-info">
					<div class="product-title">
						<a href="#">'.$item->name.'</a>
					</div>
					<div class="product-price">
						<span class="price-old">'.number_format($item->price_old).' đ</span>
						<span class="price-new">'.number_format($item->price).' đ</span>
					</div>
					<div class="note-price">(Giá chưa bao gồm VAT)</div>
					<div class="btn add-cart-product-temp">Thêm vào giỏ hàng</div>
				</div>
			</div>';
			
		}

		return $html;
	}
}