<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobile_user extends Model
{
    use HasFactory;

protected $table = "mobile_user";
protected $fillable = [
    'name',
    'email',
    'password',
    'mobile',
];
    
}
