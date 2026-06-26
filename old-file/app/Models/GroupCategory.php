<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupCategory extends Model
{
    protected $table = 'group_categories';

    protected $fillable = [
        'id',
        'group_id',
        'category_id',
        'created_at',
        'updated_at'
    ];

    public function store($input, $id = null)
     {
         if ($id) {
             return $this->find($id)->update($input);
         } else {
             return $this->create($input)->id;
         }
     }

}
