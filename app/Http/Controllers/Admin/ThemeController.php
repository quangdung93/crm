<?php

namespace App\Http\Controllers\Admin;

use App\Models\Theme;
use App\Models\Category;
use App\Models\ThemeOption;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
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
        $postCategories = PostCategory::active()->get();
        return view('admin.themes.options')->with([
            'themeOptions' => $themeOptions,
            'categories' => $categories,
            'postCategories' => $postCategories,
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
            foreach ($data as $key => $value) {
                if(!is_array($value)){
                    continue;
                }

                foreach($value as $index => $item){
                    foreach($item as $subKey => $subItem){
                        if($subItem instanceof UploadedFile){
                            $image = $subItem;
                            $imagePath = $this->uploadImage('settings', $image);
                            if($imagePath){
                                // $setting = ThemeOption::where('key', $key)->first();
                                // $this->deleteImage($setting->value[$upload]);
                                $value[$index][$subKey] = $imagePath;
                            }
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
