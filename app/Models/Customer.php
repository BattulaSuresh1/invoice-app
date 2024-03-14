<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    use HasFactory;

    protected $table = 'customer';

    // public function address() {
    //     return $this->hasMany( Address:: class, 'customer_id' );
    // }

    public function address(){
        return $this->hasMany('App\Models\Address');
    }
}
