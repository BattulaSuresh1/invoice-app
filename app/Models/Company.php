<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = "company";

    protected $fillable = [
        'company_name',
        'email',
        'mobile',
        'upi',
        'logo',
        'organization_name',
        'address_1',
        'address_2',
        'city',
        'pincode',
        'state',
        'gstin',
        'pos_footer',
        'invoice_footer',
        'is_pos',

    ];
}
