<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller {
    //

    public function index() {
        $categories = ProductCategory::all();
        return response()->json( $categories );
    }

    public function store( Request $request ) {

        $validator = Validator::make( $request->all(), [
            'product_category' => 'required',
            'product_id' => 'required',
            'product_name' => 'required',
            'product_type' => 'required',
            'qty' => 'required',
            'show_online' => 'required',
            'tax' => 'required',
            'purchase_price' => 'required',
            'isSelected' => 'required',
            'selectedQty' => 'required',
            'totalPrice' => 'required',
            'totalTax' => 'required',
            'totalDiscount' => 'required',
            'netAmount'=> 'required',
            'unit'=> 'required',
            'url'=> 'required',
            'unitPrice'=> 'required',
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

        // print_r( $request->all() );
        // exit;

        $product = new ProductCategory();
        {
            $product->product_category = $request->input( 'product_category' );
            $product->product_id = $request->input( 'product_id' );
            $product->product_name = $request->input( 'product_name' );
            $product->product_type = $request->input( 'product_type' );
            $product->qty = $request->input( 'qty' );
            $product->show_online = $request->input( 'show_online' );
            $product->tax = $request->input( 'tax' );
            $product->purchase_price = $request->input( 'purchase_price' );
            $product->isSelected = $request->input( 'isSelected' );
            $product->selectedQty = $request->input( 'selectedQty' );
            $product->totalPrice = $request->input( 'totalPrice' );
            $product->totalTax = $request->input( 'totalTax' );
            $product->totalDiscount = $request->input( 'totalDiscount' );
            $product->netAmount = $request->input( 'netAmount' );
            $product->unit = $request->input( 'unit' );
            $product->url = $request->input( 'url' );
            $product->unitPrice = $request->input( 'unitPrice' );
            $product->save();

            if ( $product ) {
                $response = [
                    'success' => true,
                    'data' => $product,
                    'message' => 'Product category created  ',
                ];
                return response()->json( $response, 200 );
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Product Not Created',
                ];
                return response()->json( $response, 401 );
            }
        }
    }
}
