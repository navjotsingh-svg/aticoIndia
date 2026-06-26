<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductQuery extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'email',
        'country',
        'phone_number',
        'quantity',
        'message',
        'file_name',
    ];
}
