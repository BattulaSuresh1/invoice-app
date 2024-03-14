<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MobileUsersControllers;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[MobileUsersControllers::class,'Register']);
Route::post('login',[MobileUsersControllers::class,'login']);

//Products API routes
Route::get('product',[ProductController::class,'index']);
Route::post('products',[ProductController::class,'storeProducts']);

//Prouct Category API routes
Route::get('productcategory',[ProductCategoryController::class,'index']);
Route::post('product-category',[ProductCategoryController::class,'store']);

// Bank API routes
Route::get('bank',[BankController::class,'index']);
Route::post('banks',[BankController::class,'store']);
Route::get('bank_id/{id}',[BankController::class,'BankId']);

//Company API routes
Route::get('company-list',[CompanyController::class, 'index']);
Route::get('company_list/{id}',[CompanyController::class,'companyid']);
Route::post('company',[CompanyController::class,'store']);

//Customer API routes
Route::get('customers',[CustomerController::class,'index']);
Route::post('customer',[CustomerController::class,'store']);
Route::get('customer_id/{id}',[CustomerController::class,'customerid']);

Route::get('customers_list',[AddressController::class,'index']);
Route::post('address',[AddressController::class,'store']);

//Vendors API routes
Route::get('vendor', [VendorsController::class, 'index']);
Route::post('vendors-store',[VendorsController::class,'store']);