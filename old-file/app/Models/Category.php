<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

     protected $table = 'categories';

     protected $fillable = [
         'id',
         'name',
         'parent_id',
         'short_name',
         'sort',
         'second_parent_id',
         'four_parent_id',
         'third_parent_id',
         'image',
         'img_alt',
         'slug',
         'description',
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
        }
        else{
            $rules['name'] = 'required';    
            //$rules['sort'] = 'required|unique:categories';   
            //$rules['image'] = 'required|image';
            //$rules['heading'] = 'required';    
            $rules['description'] = 'required';    
        }
        
     	return \Validator::make($inputs, $rules);
     }

     public function validateSub($inputs, $id=null)
     {
        if ($id) {  
            $rules['name'] = 'required';     
            $rules['parent_id'] = 'required';     
            $rules['description'] = 'required';    
        }
        else{
            $rules['name'] = 'required';    
            $rules['parent_id'] = 'required';    
            $rules['description'] = 'required';    
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

     public function getCategory($search = null, $skip, $perPage)
     {
         $take = ((int)$perPage > 0) ? $perPage : 20;
         $filter = 1; // default filter if no search

         $fields = [
             'categories.id',
             'categories.name',
             'categories.slug',
             'categories.status',
             'categories.image',
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

            $f1 = (array_key_exists('name', $search)) ? " AND (categories.name LIKE '%" .
                addslashes($search['name']) . "%')" : "";

            if(isset($search['status']) && $search['status'] == 2){
                $f2 = (array_key_exists('form-search', $search)) ? " AND (categories.status LIKE '" .
                addslashes(0) . "')" : ""; 
            }else{
                $f2 = (array_key_exists('status', $search)) ? " AND (categories.status LIKE '" .
                addslashes($search['status']) . "')" : "";         
            }

            $f3 = (array_key_exists('slug', $search)) ? " AND (categories.slug LIKE '%" .
                addslashes($search['slug']) . "%')" : "";

            $f4 = (array_key_exists('group_id', $search)) ? " AND (group_categories.id LIKE '%" .
                addslashes($search['group_id']) . "')" : "";

            $filter .= $f1 . $f2 . $f3 . $f4;
         }

         return  $this
            ->leftjoin('group_categories', 'categories.id', '=', 'group_categories.category_id')
            ->leftjoin('groups', 'group_categories.group_id', '=', 'groups.id')
             ->where('parent_id', 0)
             ->groupBy('categories.id','categories.name','categories.slug','categories.status','categories.image')
             ->whereRaw($filter)
             ->orderBy($orderEntity, $orderAction)
             ->skip($skip)->take($take)->get($fields);
     }
     
     public function totalCategory($search = null)
     {
         $filter = 1; // if no search add where

         // when search
          if (is_array($search) && count($search) > 0) {

            $f1 = (array_key_exists('name', $search)) ? " AND (categories.name LIKE '%" .
                addslashes($search['name']) . "%')" : "";


            if(isset($search['status']) && $search['status'] == 2){
                $f2 = (array_key_exists('form-search', $search)) ? " AND (categories.status LIKE '" .
                addslashes(0) . "')" : ""; 
            }else{
                $f2 = (array_key_exists('status', $search)) ? " AND (categories.status LIKE '" .
                addslashes($search['status']) . "')" : "";         
            }

            $f3 = (array_key_exists('slug', $search)) ? " AND (categories.slug LIKE '%" .
                addslashes($search['slug']) . "%')" : "";

            $f4 = (array_key_exists('group_id', $search)) ? " AND (group_categories.id LIKE '%" .
                addslashes($search['group_id']) . "')" : "";

            $filter .= $f1 . $f2 . $f3 . $f4;

         }
         return $this->select(\DB::raw('count(*) as total'))
         ->leftjoin('group_categories', 'categories.id', '=', 'group_categories.category_id')
            ->leftjoin('groups', 'group_categories.group_id', '=', 'groups.id')

             ->where('parent_id', 0)
             ->whereRaw($filter)
             ->first();
     }

     public function getSubCategory($search = null, $skip, $perPage)
     {
         $take = ((int)$perPage > 0) ? $perPage : 20;
         $filter = 1; // default filter if no search

         $fields = [
             'categories.id',
             'categories.name',
             'categories.slug',
             'categories.status',
             'categories.image',
             'parent.name as parent_name',
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

            $f1 = (array_key_exists('name', $search)) ? " AND (categories.name LIKE '%" .
                addslashes($search['name']) . "%')" : "";


            if(isset($search['status']) && $search['status'] == 2){
                $f2 = (array_key_exists('form-search', $search)) ? " AND (categories.status LIKE '" .
                addslashes(0) . "')" : ""; 
            }else{
                $f2 = (array_key_exists('status', $search)) ? " AND (categories.status LIKE '" .
                addslashes($search['status']) . "')" : "";         
            }

            $f3 = (array_key_exists('slug', $search)) ? " AND (categories.slug LIKE '%" .
                addslashes($search['slug']) . "%')" : "";

            $f4 = (array_key_exists('category_id', $search)) ? " AND (parent.id LIKE '%" .
                addslashes($search['category_id']) . "')" : "";

            $filter .= $f1 . $f2 . $f3 . $f4;
         }


         return $this
            ->join('categories as parent', 'categories.parent_id', 'parent.id')
            ->where('parent.parent_id', 0)
             ->whereRaw($filter)
             ->orderBy($orderEntity, $orderAction)
             ->skip($skip)->take($take)->get($fields);
     }
     
     public function totalSubCategory($search = null)
     {
         $filter = 1; // if no search add where

         // when search
         if (is_array($search) && count($search) > 0) {

            $f1 = (array_key_exists('name', $search)) ? " AND (categories.name LIKE '%" .
                addslashes($search['name']) . "%')" : "";


            if(isset($search['status']) && $search['status'] == 2){
                $f2 = (array_key_exists('form-search', $search)) ? " AND (categories.status LIKE '" .
                addslashes(0) . "')" : ""; 
            }else{
                $f2 = (array_key_exists('status', $search)) ? " AND (categories.status LIKE '" .
                addslashes($search['status']) . "')" : "";         
            }

            $f3 = (array_key_exists('slug', $search)) ? " AND (categories.slug LIKE '%" .
                addslashes($search['slug']) . "%')" : "";

            $f4 = (array_key_exists('category_id', $search)) ? " AND (parent.id LIKE '%" .
                addslashes($search['category_id']) . "')" : "";

            $filter .= $f1 . $f2 . $f3 . $f4;
         }

         return $this->select(\DB::raw('count(*) as total'))
            ->join('categories as parent', 'categories.parent_id', 'parent.id')
            ->where('parent.parent_id', 0)
            ->whereRaw($filter)->first();
     }

     public function getSubSubCategory($search = null, $skip, $perPage)
     {
         $take = ((int)$perPage > 0) ? $perPage : 20;
         $filter = 1; // default filter if no search

         $fields = [
             'categories.id',
             'categories.name',
             'categories.slug',
             'categories.status',
             'categories.image',
             'cat.name as cat_name',
             'main_cat.name as main_cat_name',
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

            $f1 = (array_key_exists('name', $search)) ? " AND (categories.name LIKE '%" .
                addslashes($search['name']) . "%')" : "";


            if(isset($search['status']) && $search['status'] == 2){
                $f2 = (array_key_exists('form-search', $search)) ? " AND (categories.status LIKE '" .
                addslashes(0) . "')" : ""; 
            }else{
                $f2 = (array_key_exists('status', $search)) ? " AND (categories.status LIKE '" .
                addslashes($search['status']) . "')" : "";         
            }

            $f3 = (array_key_exists('slug', $search)) ? " AND (categories.slug LIKE '%" .
                addslashes($search['slug']) . "%')" : "";

            $f4 = (array_key_exists('category_id', $search)) ? " AND (main_cat.id LIKE '%" .
                addslashes($search['category_id']) . "')" : "";

            $filter .= $f1 . $f2 . $f3 . $f4;
         }


         return $this
            ->join('categories as cat', 'categories.parent_id', 'cat.id')
            ->join('categories as main_cat', 'cat.parent_id', 'main_cat.id')
            ->where('main_cat.parent_id', '=', 0)
             ->whereRaw($filter)
             ->orderBy($orderEntity, $orderAction)
             ->skip($skip)->take($take)->get($fields);
     }
     
     public function totalSubSubCategory($search = null)
     {
         $filter = 1; // if no search add where

         // when search
         if (is_array($search) && count($search) > 0) {

            $f1 = (array_key_exists('name', $search)) ? " AND (categories.name LIKE '%" .
                addslashes($search['name']) . "%')" : "";


            if(isset($search['status']) && $search['status'] == 2){
                $f2 = (array_key_exists('form-search', $search)) ? " AND (categories.status LIKE '" .
                addslashes(0) . "')" : ""; 
            }else{
                $f2 = (array_key_exists('status', $search)) ? " AND (categories.status LIKE '" .
                addslashes($search['status']) . "')" : "";         
            }

            $f3 = (array_key_exists('slug', $search)) ? " AND (categories.slug LIKE '%" .
                addslashes($search['slug']) . "%')" : "";

            $f4 = (array_key_exists('category_id', $search)) ? " AND (main_cat.id LIKE '%" .
                addslashes($search['category_id']) . "')" : "";

            $filter .= $f1 . $f2 . $f3 . $f4;
         }
         return $this->select(\DB::raw('count(*) as total'))
            ->join('categories as cat', 'categories.parent_id', 'cat.id')
            ->join('categories as main_cat', 'cat.parent_id', 'main_cat.id')
            ->where('main_cat.parent_id', '=', 0)
            ->whereRaw($filter)->first();
     }

    public function permanentlyDelete($id)
    {
        return $this->find($id)->forceDelete();
    }

    public static function getAllCategories($take=null)
    {
        return self::where('status', 1)->orderBy('id', 'asc')->take($take)->get();
    }

    public function pluckAllCategories()
    {
        $result =  $this->where('status', '1')->orderBy('name')->pluck('name', 'id')->toArray();
        return ['' => 'Select Category'] + $result;

    } 

    public function pluckAllParentCats()
    {
        $result =  $this->where('status', '1')->where('parent_id', 0)->orderBy('name')->pluck('name', 'id')->toArray();
        return ['' => 'Select Category'] + $result;

    }  

    public function pluckCategories()
    {
        $result =  $this->where('status', '1')->where('parent_id', 0)->orderBy('name')->pluck('name', 'id')->toArray();
        return ['' => 'Select Category'] + $result;

    }  

    public function pluckCategoriesWithSub()
    {
        $result =  $this->join('categories as sub', 'categories.id', '=', 'sub.parent_id')->where('categories.status', '1')->where('categories.parent_id', 0)->orderBy('categories.name')->pluck('categories.name', 'categories.id')->toArray();
        return ['' => 'Select Category'] + $result;

    }  

    public function multipleStore($inputs)
    {
        return $this->insert($inputs);
    }

    public function getUnAllocatedCategory($search = null, $skip, $perPage)
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
                 " AND (categories.name LIKE '%" .addslashes(trim($search['keyword'])) . "%')" : "";
             $filter .= $keyword;
         }

         $ab = GroupCategory::pluck('category_id')->toArray();
         return $this->whereNotIn('id', $ab)
         ->where('categories.status', 1)
         ->where('parent_id', 0)
             ->whereRaw($filter)
             ->orderBy($orderEntity, $orderAction)
             ->skip($skip)->take($take)->get();
     }
     
     public function totalUnAllocatedCategory($search = null)
     {
         $filter = 1; // if no search add where

         // when search
         if (is_array($search) && count($search) > 0) {
             $partyName = (array_key_exists('keyword', $search)) ? " AND name LIKE '%" .
                 addslashes(trim($search['keyword'])) . "%' " : "";
             $filter .= $partyName;
         }
         $ab = GroupCategory::pluck('category_id')->toArray();
         return $this->whereNotIn('id', $ab)->select(\DB::raw('count(*) as total'))
             ->whereRaw($filter)
             ->where('categories.status', 1)
             ->where('parent_id', 0)
             ->first();
     }

    

    
}
