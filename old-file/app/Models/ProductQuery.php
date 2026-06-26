<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductQuery extends Model
{
    protected $table = 'product_queries';

    protected $fillable = [
         'product_id',
         'name',
         'email',
         'country',
         'phone_number',
         'message',
         'quantity',
         'created_at',
         'updated_at'
     ];

     public function validate($inputs)
     { 
             
        $rules['name'] = 'required';
        $rules['email'] = 'required';
        $rules['country'] = 'required'; 
        $rules['phone_number'] = 'required'; 
        $rules['message'] = 'required'; 
        $rules['quantity'] = 'required'; 
        return \Validator::make($inputs, $rules);
     }
     
    public function validate1($inputs)
     { 
             
        $rules['name'] = 'required';
        $rules['email'] = 'required';
        $rules['country'] = 'required'; 
        $rules['phone_number'] = 'required'; 
        $rules['message'] = 'required'; 
       
        return \Validator::make($inputs, $rules);
     }
     
     
     public function validate3($inputs)
     { 
             
        $rules['name'] = 'required';
        $rules['email'] = 'required';
        $rules['country'] = 'required'; 
        $rules['phone_number'] = 'required'; 
  
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

     public function getProductQuery($search = null, $skip, $perPage)
     {
         $take = ((int)$perPage > 0) ? $perPage : 20;
         $filter = 1; // default filter if no search

         $fields = [
             'products.name as product_name',
             'products.slug',
             'product_queries.name',
             'product_queries.id',
             'product_queries.email',
             'product_queries.phone_number',
             'product_queries.quantity',
             'product_queries.country',
             'product_queries.message',
             'product_queries.created_at',
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
                 " AND (products.name LIKE '%" .addslashes(trim($search['keyword'])) . "%')" : "";
             $filter .= $keyword;
         }

         return  $this
            ->join('products', 'product_queries.product_id', '=', 'products.id')
             ->whereRaw($filter)
             ->orderBy($orderEntity, $orderAction)
             ->skip($skip)->take($take)->get($fields);
     }
     
     public function totalProductQuery($search = null)
     {
         $filter = 1; // if no search add where

         // when search
         if (is_array($search) && count($search) > 0) {
             $partyName = (array_key_exists('keyword', $search)) ? " AND products.name LIKE '%" .
                 addslashes(trim($search['keyword'])) . "%' " : "";
             $filter .= $partyName;
         }
         return $this->select(\DB::raw('count(*) as total'))
         ->join('products', 'product_queries.product_id', '=', 'products.id')
             ->whereRaw($filter)->first();
     }



}
