<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function upload(Request $request){
        if(!$request->ajax() || !$request->hasFile('files')){
            return response()->json(['status' => false]);
        }

        $product = Product::findOrFail($request->imageable_id);

        $listFiles = $request->file('files');
        $folder = Str::plural($request->imageable_type);
        $highestSequenceImage = Image::where('imageable_type', $request->imageable_type)
                                ->where('imageable_id', $request->imageable_id)
                                ->max('sequence');
        $listImage = [];
        $sequence = $highestSequenceImage ?: 0;
        foreach ($listFiles as $file) {
            $sequence++;
            $fileName = $this->uploadImage($folder, $file);
            $create = $product->images()->create(['path' => $fileName, 'sequence' => $sequence]);
            $listImage[] = $create;
        }
        
        if(count($listImage) > 0){
            return response()->json([
                'status' => true,
                'listFileName' => $listImage
            ]);
        }
    }

    public function order(Request $request){
        $order = $request->order;
        foreach ($order as $item) {
            Image::where('id', $item['id'])->update(['sequence' => $item['order']]);
        }

        return response()->json(['status' => true]);
    }

    public function delete(Request $request){
        if(!$request->ajax() || !$request->id){
            return response()->json(['status' => false]);
        }
        $delete = Image::where('id', $request->id)->delete();

        if($delete){
            $this->deleteImage($request->path);
            return response()->json(['status' => true]);
        }
    }
}
