<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller {
    //

    // public function index() {
    //     $bank = Bank::all();
    //     return response()->json( $bank );
    // }


    public function index() {
        $banks = Bank::all();
    
        // Transform the result to the desired format
        $transformedBanks = $banks->map(function ($bank) {
            return [
                'bankName' => $bank->bank_name,
                'bankNo' => $bank->bank_no,
                'branchName' => $bank->branch_name,
                'id' => $bank->id,
                'ifsc' => $bank->ifsc,
                'is_default' => $bank->is_default,
            ];
        });
    
        return response()->json($transformedBanks);
    }
    

    public function store( Request $request ) {

        $validator = Validator::make( $request->all(), [
            'bank_name' => 'required',
            'bank_no' => 'required',
            'branch_name' => 'required',
            'ifsc' => 'required|string|max:255',
            'is_default' => 'boolean',
        ] );

        // Check if the validation fails
        if ( $validator->fails() ) {
            $response = [
                'success' => false,
                'errors' => $validator->errors(),
                'message' => 'Validation failed',
            ];

            return response()->json( $response, 422 );
        }

        $bank = new Bank();
        $bank->bank_name = $request->input( 'bank_name' );
        $bank->bank_no = $request->input( 'bank_no' );
        $bank->branch_name = $request->input( 'branch_name' );
        $bank->ifsc = $request->input( 'ifsc' );
        $bank->is_default = $request->input( 'is_default' );
        $bank->save();

        if ( $bank ) {
            $response = [
                'success' => true,
                'data' => $bank,
                'Message' => 'Bank Details Created '
            ] ;
            return response()->json( $response, 200 );
        } else {
            $response = [
                'success' => false,
                'data' => $bank,
                'Message' => 'Something Went Wrong'
            ];
            return response()->json( $response, 401 );
        }

    }

    public function BankId($id){
        $bank = Bank::find($id);
        return response()->json( $bank );
    }
    
}
