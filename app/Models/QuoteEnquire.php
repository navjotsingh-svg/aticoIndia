<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteEnquire extends Model
{
    protected $fillable = [
        'name',
        'email',
        'country',
        'phone_number',
        'massage',
    ];
}
