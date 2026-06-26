<?php

 namespace App\Models;
 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;

class ProductReview extends Model
{
    protected $table = 'product_reviews';
    protected $fillable = [
        'product_id',
        'name',
        'email',
        'review',
        'rating',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function store($input, $id = null)
    {
        if ($id) {
            return $this->find($id)->update($input);
        } else {
            return $this->create($input)->id;
        }
    }


    public function getProductReview($search = null, $skip, $perPage)
     {
         $take = ((int)$perPage > 0) ? $perPage : 20;
         $filter = 1; // default filter if no search

        $fields = [
            'products.name as product_name',
            'product_reviews.name as user_name',
            'product_reviews.email',
            'product_reviews.review',
            'product_reviews.rating',
            'product_reviews.created_at',
            'product_reviews.status',
            'product_reviews.id',
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
                 " AND (product_reviews.review LIKE '%" .addslashes(trim($search['keyword'])) . "%')" : "";
             $filter .= $keyword;
         }

         return $this
            ->join('products', 'product_reviews.product_id', '=', 'products.id')
            ->whereRaw($filter)
            ->orderBy($orderEntity, $orderAction)
            ->skip($skip)->take($take)
            ->get($fields);
        }

     /**\
      * @param null $search
      * @return mixed
      */
     public function totalProductReview($search = null)
     {
         $filter = 1; // if no search add where
         //
         // when search
         if (is_array($search) && count($search) > 0) {
             $partyName = (array_key_exists('keyword', $search)) ? " AND review LIKE '%" .
                 addslashes(trim($search['keyword'])) . "%' " : "";
             $filter .= $partyName;
         }
         return $this->select(\DB::raw('count(*) as total'))
            ->join('products', 'product_reviews.product_id', '=', 'products.id')
            ->whereRaw($filter)->first();
     }

    public function permanentlyDelete($id)
    {
        return $this->find($id)->forceDelete();
    }


}
