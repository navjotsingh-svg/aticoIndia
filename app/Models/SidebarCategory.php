<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SidebarCategory extends Model
{
    protected $table = 'sidebar_categories';

    protected $fillable = [
        'category_id',
    ];
}
