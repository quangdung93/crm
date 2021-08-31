<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index');
    }

    public function getDatatable(){
        $products = Product::with('categories','brand')->orderByDesc('created_at')->get();
        return $this->productService->getDatatable($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::active()->get();
        $brands = Brand::active()->get();

        return view('admin.products.add-edit')->with([
            'categories' => $categories, 
            'brands' => $brands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products',
            'categories' => 'required',
            'brand_id' => 'required',
            'price' => 'required',
        ],[
            'name.required' => 'Bạn chưa nhập tên bài viết',
            'slug.required' => 'Đường dẫn không được trống',
            'slug.unique' => 'Đường dẫn đã tồn tại',
            'categories.required' => 'Bạn chưa chọn danh mục',
            'brand_id.required' => 'Bạn chưa chọn thương hiệu',
            'price.required' => 'Bạn chưa nhập giá gốc',
        ]);

        $price = (int)Str::replace(',','', $request->price);

        $price_old = 0;
        if($request->price_old){
            $price_old = (int)Str::replace(',','', $request->price_old);
        }

        if($price == 0){
            return back()->withErrors(['price' => 'Giá bán phải lớn hơn 0']); 
        }
        elseif($price_old > 0 && $price > $price_old){
            return back()->withErrors(['price' => 'Giá bán không được lớn hơn giá gốc']); 
        }

        $discount = 0;
        if($price_old > 0){
            $discount = ($price_old - $price) / $price_old * 100;
        }

        //Avatar image
        if($request->hasFile('input_file')){
            $avatarPath = $this->uploadImage('products', $request->file('input_file'));
        }

        $data = $request->except('input_file', 'categories');
        $data['slug'] = Str::slug($request->slug);
        $data['price'] = $price;
        $data['price_old'] = $price_old;
        $data['discount'] = round($discount, 2);
        $data['image'] = $avatarPath ?? null;
        $data['status'] = isset($request->status) ? 1 : 0;
        $data['user_id'] = Auth::id();
        $product = Product::create($data);

        if($product){
            $product->categories()->attach($request->categories);
            return redirect('admin/products')->with('success', 'Tạo thành công!');
        }
        else{
            return redirect('admin/products')->with('danger', 'Tạo thất bại!');
        }
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
        $product = Product::findOrFail($id)->load('images','categories');
        $categories = Category::active()->get();
        $brands = Brand::active()->get();

        return view('admin.products.add-edit')->with([
            'product' => $product,
            'categories' => $categories, 
            'brands' => $brands
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
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,'.$id,
            'categories' => 'required',
            'brand_id' => 'required',
            'price' => 'required',
        ],[
            'name.required' => 'Bạn chưa nhập tên bài viết',
            'slug.required' => 'Đường dẫn không được trống',
            'slug.unique' => 'Đường dẫn đã tồn tại',
            'categories.required' => 'Bạn chưa chọn danh mục',
            'brand_id.required' => 'Bạn chưa chọn thương hiệu',
            'price.required' => 'Bạn chưa nhập giá gốc',
        ]);

        $product = Product::findOrFail($id);

        $price = (int)Str::replace(',','', $request->price);

        $price_old = 0;
        if($request->price_old){
            $price_old = (int)Str::replace(',','', $request->price_old);
        }

        if($price == 0){
            return back()->withErrors(['price' => 'Giá bán phải lớn hơn 0']); 
        }
        elseif($price_old > 0 && $price > $price_old){
            return back()->withErrors(['price' => 'Giá bán không được lớn hơn giá gốc']); 
        }

        $discount = 0;
        if($price_old > 0){
            $discount = ($price_old - $price) / $price_old * 100;
        }

        //Avatar image
        if($request->hasFile('input_file')){
            $avatarPath = $this->uploadImage('products', $request->file('input_file'));
            if($avatarPath){
                $this->deleteImage($product->image);
            }
        }else{
            $avatarPath = $product->image;
        }

        $data = $request->except('input_file','categories');
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
        $data['price'] = $price;
        $data['price_old'] = $price_old;
        $data['discount'] = round($discount, 2);
        $data['image'] = $avatarPath ?? null;
        $data['status'] = isset($request->status) ? 1 : 0;

        $update = $product->update($data);

        if($update){
            $product->categories()->sync($request->categories);
            return redirect('admin/products/edit/' . $id)->with('success', 'Sửa thành công!');
        }
        else{
            return redirect('admin/products/edit/'. $id)->with('danger', 'Sửa thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $delete = $product->delete();

        if($delete){
            return redirect('admin/products')->with('success', 'Xóa thành công!');
        }
    }
}
