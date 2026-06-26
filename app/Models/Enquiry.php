<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'country',
        'mobile_no',
        'message',
        'file_name',
    ];
}
