<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'id',
        'name',
        'image',
        'sort',
        'status',
        'route',
        'meta_tag',
        'meta_description',
        'meta_title',
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
            $rules['sort'] = 'required|numeric|unique:groups,sort,'.$id;  
            $rules['name'] = 'required';    
            $rules['category_id'] = 'required|array|min:1';    
            //$rules['route'] = 'required';    
        }
        else{
            $rules['name'] = 'required';    
            $rules['sort'] = 'required|unique:groups';  
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

    public function getGroup($search = null, $skip, $perPage)
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
                 " AND (groups.name LIKE '%" .addslashes(trim($search['keyword'])) . "%')" : "";
             $filter .= $keyword;
         }

         return  $this
             ->whereRaw($filter)
             ->orderBy($orderEntity, $orderAction)
             ->skip($skip)->take($take)->get();
     }

     public function totalGroup($search = null)
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


    public function pluckAllGroups()
    {
        $result =  $this->where('status', '1')->orderBy('name')->pluck('name', 'id')->toArray();
        return ['' => 'Select Group'] + $result;

    } 

}
