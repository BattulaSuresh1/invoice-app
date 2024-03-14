<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;
use App\Models\CustomerVendor;

use Illuminate\Http\Request;

class VendorsController extends Controller {

    // public function index() {
    //     // $vendors = CustomerVendor::with( 'address' )->get();
    //     // $vendors = CustomerVendor::all();
    //     $vendors = CustomerVendor::with('getaddress')->get();
    //     return response()->json( $vendors );

    // }
    public function index() {
        $vendors = CustomerVendor::with('getaddress')->get();
        
        // Transform the result to the desired format
        $transformedVendors = $vendors->map(function ($vendor) {
            // Check if the getaddress relationship exists and is not empty
            $address = optional($vendor->getaddress)->first();
    
            return [
                'id' => $vendor->vendor_id,
                'billing' => $address
                    ? [
                        'id' => $vendor->id,
                        'type' => $address->type,
                        'address_1' => $address->address_1,
                        'address_2' => $address->address_2,
                        'city' => $address->city,
                        'pincode' => $address->pincode,
                        'state' => $address->state,
                    ]
                    : null,
                'company_name' => $vendor->company_name,
                'email' => $vendor->email,
                'gstin' => $vendor->gstin,
                'name' => $vendor->name,
                'phone' => $vendor->phone,
                'opening_balance' => $vendor->opening_balance,
                'vendor_id' => $vendor->vendor_id,
            ];
        });
    
        return response()->json($transformedVendors);
    }
    
    
    public function store( Request $request ) {

        $validator = Validator::make( $request->all(), [
            'company_name' => 'required',
            'email' => 'required',
            'gstin' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'opening_balance' => 'required',
            'vendor_id' => 'required',
        ] );

        if ( $validator->fails() ) {
            $response = [
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed',
            ];
            return response()->json( $response, 422 );
        }
        // Assuming you have some logic to get the current customer based on the provided customer_id
        $vendor = new CustomerVendor();
        $vendor->company_name = $request->input( 'company_name' );
        $vendor->email = $request->input( 'email' );
        $vendor->gstin = $request->input( 'gstin' );
        $vendor->name = $request->input( 'name' );
        $vendor->phone = $request->input( 'phone' );
        $vendor->opening_balance = $request->input( 'opening_balance' );
        $vendor->vendor_id = $request->input( 'vendor_id' );
        $vendor->save();

        if ( $vendor ) {
            $response = [
                'success' => true,
                'data' =>$vendor,
                'Message' => 'Vendor Details Created '
            ] ;
            return response()->json( $response, 200 );
        } else {
            $response = [
                'success' => false,
                'data' =>$vendor,
                'Message' => 'Something Went Wrong'
            ];
            return response()->json( $response, 401 );
        }
    }
}
