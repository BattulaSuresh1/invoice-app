<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CompanyController extends Controller {
    //

    // public function index() {
    //     $company = Company::all();
    //     return response()->json( $company );
    // }

    public function index() {
        $companies = Company::all();
    
        // Transform the result to the desired format
        $transformedCompanies = $companies->map(function ($company) {
            return [
                'companyName' => $company->company_name,
                'email' => $company->email,
                'mobile' => $company->mobile,
                'upi' => $company->upi,
                'logo' => $company->logo,
                'organizationName' => $company->organization_name,
                'address_1' => $company->address_1,
                'address_2' => $company->address_2,
                'city' => $company->city,
                'state' => $company->state,
                'pincode' => $company->pincode,
                'gstin' => $company->gstin,
                'pos_footer' => $company->pos_footer,
                'invoice_footer' => $company->invoice_footer,
                'is_pos' => $company->is_pos,
            ];
        });
    
        return response()->json($transformedCompanies);
    }
    

    public function store( Request $request ) {

        $validator = Validator::make( $request->all(), [
            'company_name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'upi' => 'required',
            'logo' => 'required',
            'organization_name' => 'required',
            'address_1' => 'required',
            'address_2' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'state' => 'required',
            'gstin' => 'required',
            'pos_footer' => 'required',
            'invoice_footer' => 'required',
            'is_pos' => 'required',
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

        $company = new Company();
        $company->company_name = $request->input( 'company_name' );
        $company->email = $request->input( 'email' );
        $company->mobile = $request->input( 'mobile' );
        $company->upi = $request->input( 'upi' );
        $company->logo = $request->input( 'logo' );
        $company->organization_name = $request->input( 'organization_name' );
        $company->address_1 = $request->input( 'address_1' );
        $company->address_2 = $request->input( 'address_2' );
        $company->city = $request->input( 'city' );
        $company->pincode = $request->input( 'pincode' );
        $company->state = $request->input( 'state' );
        $company->gstin = $request->input( 'gstin' );
        $company->pos_footer = $request->input( 'pos_footer' );
        $company->invoice_footer = $request->input( 'invoice_footer' );
        $company->is_pos = $request->input( 'is_pos' );
        $company->save();

        if ( $company ) {
            $response = [
                'success' => true,
                'data' => $company,
                'Message' => 'Company  Details Created '
            ] ;
            return response()->json( $response, 200 );
        } else {
            $response = [
                'success' => false,
                'data' => $company,
                'Message' => 'Something Went Wrong'
            ];
            return response()->json( $response, 401 );
        }

    }

    public function companyid($id){
        $company = Company::find($id);
        return response()->json( $company );
    }

}

