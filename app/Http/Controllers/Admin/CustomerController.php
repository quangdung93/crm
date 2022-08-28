<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\CustomerCare;
use App\Models\Customer;
use App\Models\Province;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
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
        $orders = Order::with('user')->where('customer_id', $id)->get();
        $customerCares = CustomerCare::where('customer_id', $id)->get();

        $result = Order::selectRaw("count(store_id) as quantity, 
                SUM(total_money) as total_money, 
                SUM(lack) as total_debt, 
                SUM(coupon) as total_discount, 
                SUM(total_quantity) as total_quantity")
                ->where('status', 1)
                ->where('admin_status', 1)
                ->where('customer_id', $id)->first()->toArray();

        $totalMoney = isset($result['total_money']) ? $result['total_money'] : 0;
        $typeCustomer = 'Thành viên';
        if($totalMoney < 15000000){
            $typeCustomer = 'Thành viên';
        }
        if($totalMoney >= 15000000 && $totalMoney < 30000000){
            $typeCustomer = 'Silver';
        }
        if($totalMoney >= 30000000 && $totalMoney < 60000000){
            $typeCustomer = 'Gold';
        }
        if($totalMoney >= 60000000 && $totalMoney < 100000000){
            $typeCustomer = 'Platinum';
        }
        if($totalMoney >= 100000000){
            $typeCustomer = 'Diamond';
        }

        return view('admin.customers.detail')->with([
            'customer' => $customer,
            'orders' => $orders,
            'customerCares' => $customerCares,
            'typeCustomer' => $typeCustomer,
            'totalMoney' => $totalMoney,
            'points' => round($totalMoney / 100000, 0)
        ]);
    }

    public function renderDatatable($table){
        $data = Datatables::of($table)
            ->editColumn('customer_code', function ($row) {
                return '<a href="'.url('/admin/customers/detail/'.$row->id).'">'.$row->customer_code.'</a>';
            })
            ->editColumn('name', function ($row) {
                $name = '<div>';
                $name .= '<a href="'.url('/admin/customers/detail/'.$row->id).'">'.$row->name.'</a>';
                $name .= '<div><span>Điểm tích lũy: '.$row->customer_diem.'</span></div>';
                $name .= '<div><span>Loại thành viên: Thành viên</span></div>';
                $name .= '</div>';

                return $name;

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
            ->rawColumns(['customer_code', 'name', 'sale', 'action'])
            ->make(true);
        return $data;
    }

    public function customerCare(Request $request){
        $request->validate([
            'task' => 'required',
            'customer_id' => 'required',
        ],[
            'customer_id.required' => 'Khách hàng không tồn tại',
            'task.required' => 'Bạn chưa chọn công việc',
        ]);

        $data = $request->except('token');
        $data['created_by'] = Auth::id();
        $customer = CustomerCare::create($data);

        if($customer){
            return redirect('admin/customers/detail/'.$request->customer_id)->with('success', 'Tạo thành công!');
        }
        else{
            return redirect('admin/customers/detail/'.$request->customer_id)->with('danger', 'Tạo thất bại!');
        }
    }
}
