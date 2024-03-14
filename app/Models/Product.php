<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
protected $table="products";

    protected $fillable = [
        'avg_purchase_price',
        'barcode_id',
        'description',
        'discount',
        'free_qty',
        'hsn_code',
        'image',
        'is_price_with_tax',
        'price_with_tax',
        'price',
        'product_category', // Foreign key to ProductCategory
        'product_id',
        'product_name',
        'product_type',
        'qty',
        'show_online',
        'tax',
        'purchase_price',
        'unit',
        'url',
        'unitPrice',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'id');
    }
    // public function getCategory(){
    //     return $this->hasMany('App\Models\ProductCategory');
    // }
}
