<?php

namespace App\Http\Controllers\Admin;

use App\Models\Theme;
use App\Models\Category;
use App\Models\ThemeOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = Theme::all();
        return view('admin.themes.index')->with(['themes' => $themes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $themeOptions = ThemeOption::where('theme_id', $id)->get()->pluck('value', 'key')->toArray();
        $categories = Category::active()->get();
        return view('admin.themes.options')->with([
            'themeOptions' => $themeOptions,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // try{
            $data = $request->except('_token');
            // dd($data);
            foreach ($data as $key => $value) {
                //Image Handle
                if($request->hasFile($key)){
                    if(is_array($value) && isset($value['image']) || isset($value['logo'])){
                        if(isset($value['image']) && $value['image'] instanceof UploadedFile){
                            $image = $value['image'];
                            $imagePath = $this->uploadImage('settings', $image);
                            if($imagePath){
                                $setting = ThemeOption::where('key', $key)->first();
                                // $this->deleteImage($setting->value['image']);
                                $value['image'] = $imagePath;
                            }
                        }
                        elseif(isset($value['logo']) && $value['logo'] instanceof UploadedFile){
                            $image = $value['logo'];
                            $imagePath = $this->uploadImage('settings', $image);
                            if($imagePath){
                                $setting = ThemeOption::where('key', $key)->first();
                                // $this->deleteImage($setting->value['image']);
                                $value['logo'] = $imagePath;
                            }
                        }
                    }
                    else{
                        $image = $value;
                        $imagePath = $this->uploadImage('settings', $image);
                        if($imagePath){
                            $setting = ThemeOption::where('key', $key)->first();
                            $this->deleteImage($setting->value);
                            $value = $imagePath;
                        }
                    }
                }

                $option = ThemeOption::where('theme_id', 1)->where('key', $key)->first();
                $option->update(['value' => $value]);
            }

            //Remove cache
            Cache::forget('themes');

            return back();
        // }
        // catch(\Exception $e){
        //     return back()->withErrors($e->getMessage());
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
