<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use App\Services\MenuService;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        $menus = Menu::all();
        return view('admin.menus.index')->with(['menus' => $menus]);
    }

    public function create()
    {
        return view('admin.menus.add-edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:menus',
        ],[
            'name.required' => 'Bạn chưa nhập tên menu',
            'name.unique' => 'Tên menu đã tồn tại',
        ]);

        $data['name'] = Str::slug($request->name);

        $menu = Menu::create($data);

        if($menu){
            return redirect('admin/menus')->with('success', 'Tạo menu thành công!');
        }
        else{
            return redirect('admin/menus')->with('danger', 'Tạo thất bại!');
        }
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menus.add-edit')->with(['menu' => $menu]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:menus,name,'.$id,
        ],[
            'name.required' => 'Bạn chưa nhập tên menu',
            'name.unique' => 'Tên menu đã tồn tại',
        ]);

        $menu = Menu::findOrFail($id);

        $data['name'] = Str::slug($request->name);

        $update = $menu->update($data);

        if($update){
            return redirect('admin/menus/edit/'.$id)->with('success', 'Sửa thành công!');
        }
        else{
            return redirect('admin/menus/edit/'.$id)->with('danger', 'Tạo thất bại!');
        }
    }

    public function destroy($id)
    {   
        $menu = Menu::findOrFail($id);

        $delete = $menu->delete();

        if($delete){
            return redirect('admin/menus')->with('success', 'Xóa thành công!');
        }
        else{
            return redirect('admin/menus')->with('danger', 'Xóa thất bại!');
        }
    }

    public function builder($id){
        $menu = Menu::findOrFail($id);

        $category_posts = PostCategory::active()->get();
        $posts = Post::active()->get();
        $pages = Page::active()->get();
        $category = Category::active()->get();

        return view('admin.menus.builder')->with([
            'menu' => $menu,
            'posts' => $posts,
            'pages' => $pages,
            'category' => $category,
            'category_posts' => $category_posts
        ]);
    }

    public function addItem(Request $request){
        if(!isset($request->type)){
            return response()->json(['status' => false]);
        }

        $highestOrder = MenuItem::highestOrderMenuItem();
        $type = $request->type;
        $modelId = $request->value_item;
        $className = 'App\\Models\\' . Str::studly(Str::singular($type));
        if(!class_exists($className)) {
            return response()->json(['status' => false]);
        }

        $model = new $className;
        $instance = $model->findOrFail($modelId);
        $data = [
            'menu_id' => $request->menu_id,
            'title' => $instance->name,
            'url' => Str::start($instance->link(), '/'),
            'type' => $type,
            'object_id' => $instance->id,
            'order' => $highestOrder
        ];

        $menuItem = MenuItem::create($data);
        if($menuItem){
            return response()->json(['status' => true]);
        }
        else{
            return response()->json(['status' => false]);
        }
    }

    public function addItemCustom(Request $request)
    {
        $highestOrder = MenuItem::highestOrderMenuItem();
        $data = $request->except(['id']);
        $data['order'] = $highestOrder;

        if($data['url'] != '#'){
            $data['url'] = Str::start($data['url'], '/');
        }
        
        $menuItem = MenuItem::create($data);

        if($menuItem){
            return redirect('admin/menus/builder/'.(int)$data['menu_id'])->with('success', 'Thêm menu thành công!');
        }
        else{
            return redirect('admin/menus/builder/'.(int)$data['menu_id'])->with('danger', 'Thêm thất bại!');
        }
    }

    public function updateItem(Request $request){
        $id = $request->input('id');
        $data = $request->except(['id']);
        $menuItem = MenuItem::findOrFail($id);

        if($data['url'] != '#'){
            $data['url'] = Str::start($data['url'], '/');
        }

        $update = $menuItem->update($data);

        if($update){
            return redirect('admin/menus/builder/'.(int)$data['menu_id'])->with('success', 'Sửa menu thành công!');
        }
        else{
            return redirect('admin/menus/builder/'.(int)$data['menu_id'])->with('danger', 'Sửa thất bại!');
        }
    }   

    public function orderItem(Request $request)
    {
        $menuItemOrder = json_decode($request->input('order'));
        $this->menuService->orderMenu($menuItemOrder, null);
        return response()->json(['status' => true]);
    }

    public function deleteItem($id){
        $item = MenuItem::findOrFail($id);
        $item->children()->delete();
        $delete = $item->delete();

        if($delete){
            return redirect('admin/menus/builder/'.$item->menu_id)->with('success', 'Xóa menu thành công!');
        }
        else{
            return redirect('admin/menus/builder/'.$item->menu_id)->with('danger', 'Xóa menu thất bại!');
        }
    }
}
