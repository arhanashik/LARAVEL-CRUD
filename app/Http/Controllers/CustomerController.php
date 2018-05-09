<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use Validator;

use App\Customer;

class CustomerController extends Controller
{
    public function index(){
        $customer = Customer::paginate(7);
        return view('customer.index', compact('customer'));
    }

    public function searchCustomer(Request $request){
        $customer = new Customer();
        $customer = $customer->where('id', '=', $request->key)
                                ->orWhere('name', 'like', '%' . $request->key . '%')
                                ->orWhere('job_reference', 'like', '%' . $request->key . '%')
                                ->orWhere('company_name', 'like', '%' . $request->key . '%')
                                //->orderBy('job_reference')
                                ->paginate(7);

        return view('customer.index', compact('customer'));
    }

    public function addCustomer(Request $request){
        $rules = array(
            'name' => 'required',
            'job_reference' => 'required',
            'company_name' => 'required',
            'note' => 'required',
            'email' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
            return response::json(array('errors' => $validator->getMessageBag()->toArray()));
        else{
            $customer = new Customer();

            $customer->name = $request->name;
            $customer->job_reference = $request->job_reference;
            $customer->company_name = $request->company_name;
            $customer->note = $request->note;
            $customer->email = $request->email;
            $customer->save();

            return response()->json($customer);
        }
    }

    public function editCustomer(Request $request){
        $customer = Customer::find($request->id);

        $customer->name = $request->name;
        $customer->job_reference = $request->job_reference;
        $customer->company_name = $request->company_name;
        $customer->note = $request->note;
        $customer->email = $request->email;
        $customer->save();

        return response()->json($customer);
    }

    public function deleteCustomer(Request $request){
        $customer = Customer::find($request->id)->delete();

        return response()->json();
    }
}
