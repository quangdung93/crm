<?php
 
namespace App\Traits;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
 
trait UploadImage
{

    public function uploadImage($folder, $file, $thumb = null)
    {
        try {
            //get filename with extension
            $filenamewithextension = $file->getClientOriginalName();

            //get filename without extension
            $fileName = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $file->getClientOriginalExtension();

            //filename to store
            $fileName = Str::slug($fileName);
            $finalFile = time() .'_'. $fileName .'.' . $extension;

            Storage::put('/public/' . $folder . '/' . $finalFile, fopen($file, 'r+'));

            //Resize image thumbnail
            if(!is_null($thumb)){
                $thumb = explode('/', $thumb);
                Storage::put('/public/' . $folder . '/thumb/' . $finalFile, fopen($file, 'r+'));
                $thumbnail = storage_path('/app/public/' . $folder . '/thumb/' . $finalFile);
                $img = Image::make($thumbnail)->resize($thumb[0], $thumb[1]);
                $img->save($thumbnail);
            }

            return 'storage/'.$folder.'/'.$finalFile;
        }
        catch (\Exception $e) {
            return null;
        }
    }

    public function uploadImageCustomSize($folder, $file, $width = null, $height = null)
    {
        try {
            $image = Image::make($file);
            $baseName = $file->getClientOriginalName();
            $filename = pathinfo($baseName, PATHINFO_FILENAME);
            $filename = Str::slug($filename);
            $extension = $file->getClientOriginalExtension();
            $heightImage = $image->height();
            $widthImage = $image->width();
            $path = public_path().'/storage/' .$folder. '/';
            if (!file_exists($path)) {
                mkdir($path, 755, true);
            }
            
            if($width && !$height && $widthImage > $width){ //Have width not height
                $thumbImage = Image::make($file->getRealPath())
                ->resize($width,null,function ($constraint) {
                    $constraint->aspectRatio();
                });
                $thumbImage->save($path.'resize_'.time().$filename.'.'.$extension); 
                return 'storage/' . $folder . '/' . $thumbImage->basename;
            }
            elseif($width && $height){ //both width and height
                $thumbImage = Image::make($file->getRealPath())->resize($width,$height);
                $thumbImage->save($path.'mobile_'.time().$filename.'.'.$extension); 
                return array(
                    'original' => 'storage/' . $folder . '/' . $image->basename,
                    'thumb' => 'storage/' . $folder . '/' . $thumbImage->basename,
                );
            }
            else{
                //not set width and height
                $image->save($path.time().$filename.'.'.$extension);
                return 'storage/' . $folder . '/' . $image->basename;
            }
        }
        catch (\Exception $e) {
            return null;
        }
    }

    public function deleteImage($imagePath){
        if(Storage::disk('public')->exists($imagePath)){
            Storage::disk('public')->delete($imagePath);
        }
    }
}