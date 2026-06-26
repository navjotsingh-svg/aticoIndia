<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

     protected $table = 'blogs';

     protected $fillable = [
         'name',
         'slug',
         'meta_title',
         'meta_tag',
         'meta_description',
         'description',
         'image',
         'img_alt',
         'status',
         'created_by',
         'updated_by',
         'deleted_by',
         'created_at',
         'updated_at',
         'deleted_at'
     ];

     public function validate($inputs, $id = null)
{
    if ($id) {
        // Validation rules for updating an existing entry
        $rules['name'] = 'required|unique:blogs,name,' . $id;
        $rules['description'] = 'required';
    } else {
        // Validation rules for creating a new entry
        $rules['name'] = 'required|unique:blogs,name,' . $id;
        $rules['description'] = 'required';
        $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'; // Include 'webp' format
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

      public function validateComment($inputs)
     {
        
            $rules['blog_id'] = 'required';
            $rules['comment'] = 'required';
        
        return \Validator::make($inputs, $rules);
     }

     public function getBlogs($search = null, $skip, $perPage)
     {
         $take = ((int)$perPage > 0) ? $perPage : 20;
         $filter = 1; // default filter if no search

         $fields = [
             'id',
             'name',
             'description',
             'image',
             'status',
         ];

         $sortBy = [
             'name' => 'name',
         ];

         $orderEntity = 'id';
         $orderAction = 'desc';
         if (isset($search['sort_action']) && $search['sort_action'] != "") {
             $orderAction = ($search['sort_action'] == 1) ? 'desc' : 'asc';
         }

         if (isset($search['sort_entity']) && $search['sort_entity'] != "") {
             $orderEntity = (array_key_exists($search['sort_entity'], $sortBy)) ? $sortBy[$search['sort_entity']] : $orderEntity;
         }

         if (is_array($search) && count($search) > 0) {
             $keyword = (array_key_exists('keyword', $search)) ?
                 " AND (blogs.name LIKE '%" .addslashes(trim($search['keyword'])) . "%')" : "";
             $filter .= $keyword;
         }

         return  $this
             ->whereRaw($filter)
             ->orderBy($orderEntity, $orderAction)
             ->skip($skip)->take($take)->get($fields);
     }
     
     public function totalBlogs($search = null)
     {
         $filter = 1; // if no search add where

         // when search
         if (is_array($search) && count($search) > 0) {
             $partyName = (array_key_exists('keyword', $search)) ? " AND name LIKE '%" .
                 addslashes(trim($search['keyword'])) . "%' " : "";
             $filter .= $partyName;
         }
         return $this->select(\DB::raw('count(*) as total'))
             ->whereRaw($filter)->first();
     }

     public function getAllBlogs()
     {
        return $this->where('status', '1')->where('slug', '!=', null)->where('slug', '!=', '')->orderBy('id', 'desc')->get();
     }

     //For App -- Khushboo
    public function validateBlog($inputs)
    {
        $rules = [
                    'id' => 'required|numeric',
            ];
        return \Validator::make($inputs, $rules);
    }

    public function latestBlogs($blog_id)
    {
        return $this->where('status','1')->where('slug', '!=', null)->where('slug', '!=', '')->where('id','!=', $blog_id)->orderBy('id', 'desc')->get();
    }



}
