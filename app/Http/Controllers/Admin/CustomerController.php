<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return view('admin.customers.index')->with([
            'customers' => $customers
        ]);
    }

    public function detail($id){
        $customer = Customer::findOrFail($id);
        return view('admin.customers.detail')->with([
            'customer' => $customer
        ]);
    }
}
