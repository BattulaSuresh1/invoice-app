<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller {
    //

    // public function index() {
    //      $products = Product::with( 'category' )->get();
    //     //$products = Product::all();
    //     return response()->json( $products );
    // }

    public function index() {
        $products = Product::with('category')->get();
        
        // Transform the result to the desired format
        $transformedProducts = $products->map(function ($product) {
            $category = $product->category;
    
            return [
                'id' => $product->id,
                'avg_purchase_price' => $product->avg_purchase_price,
                'barcode_id' => $product->barcode_id,
                'description' => $product->description,
                'discount' => $product->discount,
                'free_qty' => $product->free_qty,
                'hsn_code' => $product->hsn_code,
                'image' => $product->image,
                'is_price_with_tax' => $product->is_price_with_tax,
                'price_with_tax' => $product->price_with_tax,
                'price' => $product->price,
                'product_category' => $category ? $category->product_category : null,
                'product_id' => $category ? $category->product_id : null,
                'product_name' =>$category ? $category->product_name : null,
                'product_type' => $category ? $category->product_type : null,
                'qty' => $category ? $category->qty : null,
                'show_online' => $category ? $category->show_online : null,
                'tax' => $category ? $category->tax : null,
                'purchase_price' => $category ? $category->purchase_price : null,
                'isSelected' => $category ? $category->isSelected : null,
                'selectedQty' => $category ? $category->selectedQty : null,
                'totalPrice' => $category ? $category->totalPrice : null,
                'totalTax' => $category ? $category->totalTax : null,
                'totalDiscount' => $category ? $category->totalDiscount : null,
                'netAmount' => $category ? $category->netAmount : null,
                'unit' => $category ? $category->unit : null,
                'url' => $category ? $category->url : null,
                'unitPrice' => $category ? $category->unitPrice : null,
            ];
        });
        
        return response()->json($transformedProducts);
    }
    
    
    public function storeProducts( Request $request ) {
        //$product = Product::create( $request->all() );
        $request->validate( [
            'avg_purchase_price' => 'required',
            'barcode_id' => 'required',
            'description' => 'required',
            'discount' => 'required',
            'free_qty' => 'required',
            'hsn_code' => 'required',
            'image' => 'required',
            'is_price_with_tax' => 'required',
            'price_with_tax' => 'required',
            'price' => 'required',
        ] );

        $product = new Product();
        $product->avg_purchase_price = $request->input( 'avg_purchase_price' );
        $product->barcode_id = $request->input( 'barcode_id' );
        $product->description = $request->input( 'description' );
        $product->free_qty = $request->input( 'free_qty' );
        $product->hsn_code = $request->input( 'hsn_code' );
        $product->image = $request->input( 'image' );
        $product->is_price_with_tax = $request->input( 'is_price_with_tax' );
        $product->price_with_tax = $request->input( 'price_with_tax' );
        $product->price = $request->input( 'price' );
        $product->save();

        if ( $product ) {
            $response = [
                'success' => true,
                'data' => $product,
                'message' => 'Product created  ',
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

