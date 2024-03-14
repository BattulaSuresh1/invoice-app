<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class CustomerController extends Controller
{
    
    // public function index(){
    //     $customer = Customer::all();
    //     return response()->json($customer);
    // }  
    
    public function index() {
        $customers = Customer::with('address')->get();
    
        // Transform the result to the desired format
        $transformedCustomers = $customers->map(function ($customer) {
            $address = $customer->address->first(); // Use the correct relationship name
    
            return [
                'id' => $customer->id,
                'billing' => $address
                    ? [
                        'id' => $customer->id,
                        //'type' => $address->type,
                        'address_1' => $address->address_1,
                        'address_2' => $address->address_2,
                        'city' => $address->city,
                        'pincode' => $address->pincode,
                        'state' => $address->state,
                    ]
                    : null,
                'company_name' => $customer->company_name,
                'email' => $customer->email,
                'gstin' => $customer->gstin,
                'name' => $customer->name,
                'phone' => $customer->phone,
                'opening_balance' => $customer->opening_balance,
                'shipping' => $address
                    ? [
                        'id' => $customer->id,
                        //'type' => $address->type,
                        'address_1' => $address->address_1,
                        'address_2' => $address->address_2,
                        'city' => $address->city,
                        'pincode' => $address->pincode,
                        //'is_same' => $address->is_same,
                        'state' => $address->state,
                    ]
                    : null,
            ];
        });
    
        return response()->json($transformedCustomers);
    }
    
    public function store(Request $request){
        $validator = Validator::make( $request->all(), [
                'company_name',
                'email',
                'gstin',
                'name',
                'phone',
                'opening_balance',
        ]);

        if($validator->fails()) {
            $response = [
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed',
            ];
            return response()->json( $response, 422 );
        }
        $customer= new Customer();
        $customer->company_name = $request->input('company_name');
        $customer->email = $request->input('email');
        $customer->gstin = $request->input('gstin');
        $customer->name = $request->input('name');
        $customer->phone = $request->input('phone');
        $customer->opening_balance = $request->input('opening_balance');
        $customer->save();

        if ( $customer ) {
            $response = [
                'success' => true,
                'data' => $customer,
                'Message' => 'Customer Details Created '
            ] ;
            return response()->json( $response, 200 );
        } else {
            $response = [
                'success' => false,
                'data' => $customer,
                'Message' => 'Something Went Wrong'
            ];
            return response()->json( $response, 401 );
        }

    }

    public function customerid($id){
        $customer = Customer::find($id);
        return response()->json( $customer );
    }
}
