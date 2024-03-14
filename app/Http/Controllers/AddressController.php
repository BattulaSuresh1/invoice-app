<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;

class AddressController extends Controller {
    //


    public function index() {
        $addresses = Address::with('customer')->get();
        return response()->json($addresses);
    }

    public function store( Request $request ) {

        $validator = Validator::make( $request->all(), [
            'type' => 'required',
            'address_1' => 'required',
            'address_2' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'state' => 'required',
            //'customer_id' => 'required|exists:customers,id', // Assuming customers is the name of your customers table

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
        // $customer = Customer::find( $request->input( 'customer_id' ) );
        // if ( !$customer ) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Customer not found with the provided ID',
        //     ];
        //     return response()->json( $response, 404 );
        // }

        $address = new Address();
        $address->type = $request->input( 'type' );
        $address->address_1 = $request->input( 'address_1' );
        $address->address_2 = $request->input( 'address_2' );
        $address->city  = $request->input( 'city' );
        $address->pincode = $request->input( 'pincode' );
        $address->state = $request->input( 'state' );
        $address->is_same = $request->input( 'is_same' );
        // $address->customer_id = $customer->id;

        $address->save();

        if ( $address ) {
            $response = [
                'success' => true,
                'data' => $address,
                'Message' => 'Address Details Created '
            ] ;
            return response()->json( $response, 200 );
        } else {
            $response = [
                'success' => false,
                'data' => $address,
                'Message' => 'Something Went Wrong'
            ];
            return response()->json( $response, 401 );
        }

    }


}
