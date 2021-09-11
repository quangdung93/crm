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

if (!function_exists('shortcode')) {
	function shortcode($key){
		return App\Helpers\ShortcodeHelper::renderByKey($key);
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

if (!function_exists('theme')) {
    function theme($key, $default = null){
		return (new App\Models\ThemeOption())->getThemeOption($key, $default);
    }
}

if (!function_exists('category')) {
	function category($category_id){
		return (new App\Models\Category())->getCategory($category_id);
    }
}

if (!function_exists('get_embed_youtube')) {
	function get_embed_youtube($url){
		try{
			parse_str( parse_url( $url, PHP_URL_QUERY ),$embedUrl);
			return $embedUrl['v'];
		}
		catch(\Exception $e){
			return null;
		}
	}
}

if (!function_exists('split_textarea')){
	function split_textarea($text){
		return array_filter(preg_split('/\r\n|[\r\n]/', $text));
	}
}

if (!function_exists('render_split_textarea')){
	function render_split_textarea($text, $tag = 'p'){
		$list = split_textarea($text);
		$html = '';
		if(count($list) > 0){
			foreach($list as $item){
				$html .= '<'.$tag.'>' .$item. '</'.$tag.'>';
			}
		}

		return $html;
	}
}


if (!function_exists('post_excerpt')){
	function post_excerpt($content, $limit = 30){
		return strip_tags(Str::words($content, $limit));
	}
}

if (!function_exists('product_template')){
	function product_template($products){
		if(!$products){
			return null;
		}

		$html = '';

		foreach ($products as $item) {
			$discount = $priceOld = '';
			if($item->discount > 0){
				$discount = '<div class="discount">-'.round($item->discount, 1).'%</div>';
				$priceOld = '<span class="price-old">'.number_format($item->price_old).' đ</span>';
			}
			
			$html .= '<div class="product-item">
				<div class="product-img">
					<a href="'.url($item->link()).'">
						<img class="lazy" data-src="'.asset($item->image).'" alt="'.$item->name.'"/>
					</a>
					'.$discount.'
				</div>
				<div class="product-info">
					<div class="product-title">
						<a href="'.url($item->link()).'">'.$item->name.'</a>
					</div>
					<div class="product-price">
						'.$priceOld.'
						<span class="price-new">'.number_format($item->price).' đ</span>
					</div>
					<div class="note-price">(Giá chưa bao gồm VAT)</div>
					<div class="btn add-cart-product-temp" data-id="'.$item->id.'">Thêm vào giỏ hàng</div>
				</div>
			</div>';
			
		}

		return $html;
	}
}