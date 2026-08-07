<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use SoftDeletes;

    protected $table = 'faqs';

    protected $fillable = [
        'name',
        'description',
        'status',
        'section_heading',
        'section_description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
