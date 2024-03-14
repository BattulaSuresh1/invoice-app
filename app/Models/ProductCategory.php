<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table="product_category";

    protected $fillable = [
        "product_category",
        "product_id",
        "product_name",
        "product_type",
        "qty",
        "show_online",
        "tax",
        "purchase_price",
        "isSelected",
        "selectedQty",
        "totalPrice",
        "totalTax",
        "netAmount",
        "totalDiscount",
        "unit",
        "url",
        "unitPrice",

    ];

    public function products()
    {
        return $this->hasMany(Product::class,'id');
    }
}
