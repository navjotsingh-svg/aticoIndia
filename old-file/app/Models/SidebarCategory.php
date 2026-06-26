<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SidebarCategory extends Model
{

     protected $table = 'sidebar_categories';

     protected $fillable = [
         'category_id',
         'created_at',
         'updated_at'
     ];

     public function validate($inputs, $id=null)
     {
      
        if($id){
            $rules['category_id'] = 'required|array|min:1';
        }
        else{
            $rules['category_id'] = 'required|array|min:1';
        }
      return \Validator::make($inputs, $rules);
     }

    public function store($input, $id = null)
    {
     if ($id) {
         return $this->find($id)->update($input);
     } else {
         return $this->create($input)->id;
     }
    }

}
