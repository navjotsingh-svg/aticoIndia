<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id',
        'name',
        'heading',
        'short_description',
        'description',
        'product_code',
        'image',
        'img_alt',
        'slug',
        'meta_tag',
        'meta_description',
        'meta_title',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function validate($inputs, $id=null)
     {
        if ($id) {  
            //$rules['sort'] = 'required|numeric|unique:categories,sort,'.$id;  
            $rules['name'] = 'required';    
            //$rules['heading'] = 'required';    
            $rules['description'] = 'required';    
            $rules['category_id'] = 'required|array|min:1';
        }
        else{
            $rules['name'] = 'required';    
            //$rules['sort'] = 'required|unique:categories';   
            $rules['image'] = 'required|image';
            //$rules['heading'] = 'required';    
            $rules['description'] = 'required';    
            $rules['category_id'] = 'required|array|min:1';    
        }
        
        return \Validator::make($inputs, $rules);
     }



    public function validateProductImportFile($inputs)
     {
        $rules['file'] = 'required|file|max:1024|mimes:doc,docx';
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

     public function validateQuestionImport($inputs)
     {
        $rules['category'] = 'required';
        $rules['level'] = 'required';
        if($inputs['english_language'] == 'English'){
            $rules['english_question'] = 'required';
            $rules['english_multiple_answer'] = 'required|array|min:1';
            $rules['english_right_answer'] = 'required';
        }
        if($inputs['hindi_language'] == 'Hindi'){
            $rules['hindi_question'] = 'required';
            $rules['hindi_multiple_answer'] = 'required|array|min:1';
            $rules['hindi_right_answer'] = 'required';
        }
        return \Validator::make($inputs, $rules);
     }

    public function multipleStore($inputs)
    {
        return $this->insert($inputs);
    }

    public function getProduct($search = null, $skip, $perPage)
     {
         $take = ((int)$perPage > 0) ? $perPage : 20;
         $filter = 1; // default filter if no search

       

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
                 " AND (products.name LIKE '%" .addslashes(trim($search['keyword'])) . "%')" : "";
             $filter .= $keyword;
         }

         return  $this
             ->whereRaw($filter)
             ->orderBy($orderEntity, $orderAction)
             ->skip($skip)->take($take)->get();
     }
     
     public function totalProduct($search = null)
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
}
