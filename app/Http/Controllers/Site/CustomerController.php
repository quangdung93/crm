<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function register(Request $request){
        $data = $request->all();
        $customer = Customer::create($data);

        if($customer){
            return response()->json([
                'status' => true
            ]);
        }
    }
}
