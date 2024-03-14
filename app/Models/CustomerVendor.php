<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerVendor extends Model
{
    use HasFactory;

    protected $table = 'vendors';
    protected $fillable = [
        'address_1',
        'address_2',
        'city',
        'pincode',
        'state',
        "company_name",
        "email",
        "gstin",
        "gstin",
        "phone",
        "opening_balance",
        "vendor_id",

    ];
    // CustomerVendor.php

public function addressData()
{
    return $this->hasOne('App\Models\Address');
}
public function getaddress(){
    return $this->hasMany('App\Models\Address');
}


}
