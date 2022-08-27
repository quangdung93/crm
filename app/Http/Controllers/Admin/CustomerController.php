<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Province;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index(){
        return view('admin.customers.index');
    }

    public function getDatatable(){
        $customers = Customer::with('user')->orderBy('id', 'DESC')->limit(100)->get();
        return $this->renderDatatable($customers);
    }

    public function create(){
        $provinces = Province::all();
        return view('admin.customers.add-edit')->with([
            'provinces' => $provinces
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'customer_group' => 'required',
        ],[
            'name.required' => 'Bạn chưa nhập tên khách hàng',
            'customer_group.required' => 'Bạn chưa chọn loại Khách hàng',
        ]);

        $data = $request->except('token');
        $data['status'] = 1;
        $data['created_by'] = Auth::id();

        $customer = Customer::create($data);

        if($customer){
            return redirect('admin/customers')->with('success', 'Tạo thành công!');
        }
        else{
            return redirect('admin/customers')->with('danger', 'Tạo thất bại!');
        }
    }

    public function edit($id){
        $customer = Customer::findOrFail($id);
        $provinces = Province::all();
        return view('admin.customers.add-edit')->with([
            'customer' => $customer,
            'provinces' => $provinces,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'customer_group' => 'required',
        ],[
            'name.required' => 'Bạn chưa nhập tên khách hàng',
            'customer_group.required' => 'Bạn chưa chọn loại Khách hàng',
        ]);

        $model = Customer::findOrFail($id);

        $data = $request->except('token');
        $data['status'] = isset($request->status) ? 1 : 0;

        $update = $model->update($data);

        if($update){
            return redirect('admin/customers/edit/' . $id)->with('success', 'Sửa thành công!');
        }
        else{
            return redirect('admin/customers/edit/'. $id)->with('danger', 'Sửa thất bại!');
        }
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $delete = $post->delete();

        if($delete){
            return redirect('admin/posts')->with('success', 'Xóa thành công!');
        }
    }

    public function detail($id){
        $customer = Customer::findOrFail($id);
        return view('admin.customers.detail')->with([
            'customer' => $customer
        ]);
    }

    public function renderDatatable($table){
        $data = Datatables::of($table)
            ->editColumn('customer_code', function ($row) {
                return $row->customer_code;
            })
            ->editColumn('name', function ($row) {
                return $row->name;
            })
            ->editColumn('joindate', function ($row) {
                return Carbon::parse($row->joindate)->format('d/m/Y');
            })
            ->editColumn('customer_date', function ($row) {
                return Carbon::parse($row->customer_date)->format('H:i - d/m/Y');
            })
            ->editColumn('created_by', function ($row) {
                return optional($row->user)->name;
            })
            ->addColumn('sale', function ($row) {
                $action = "";
                $action .= '<a class="btn btn-primary text-nowrap" href="'.url('admin/products/edit/'.$row->id).'" title="Chỉnh sửa">Đặt hàng</a>';

                return $action;
            })
            ->addColumn('action', function ($row) {
                $user = Auth::user();
                $action = "";
                // if($user->can('edit_customer')){
                    $action .= '<a href="'.url('admin/customers/edit/'.$row->id).'" title="Chỉnh sửa">Sửa</a>';
                // }
                if($user->can('delete_customer')){
                    $action .= '<a href="'.url('admin/customers/delete/'.$row->id).'" class="btn btn-danger notify-confirm" title="Xóa">
                        <i class="feather icon-trash-2"></i>
                    </a>';
                }

                return $action;
            })
            ->rawColumns(['sale', 'action'])
            ->make(true);
        return $data;
    }
}
