<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $table = 'blog_comments';

    protected $fillable = [
         'blog_id',
         'name',
         'email',
         'comment',
         'status',
         'created_at',
         'updated_at'
     ];

     public function validate($inputs)
     { 
             
        $rules['name'] = 'required';
        $rules['email'] = 'required';
        $rules['comment'] = 'required';
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

     public function getBlogComment($search = null, $skip, $perPage)
     {
         $take = ((int)$perPage > 0) ? $perPage : 20;
         $filter = 1; // default filter if no search

         $fields = [
             'blogs.name as blog_name',
             'blog_comments.name',
             'blog_comments.id',
             'blog_comments.email',
             'blog_comments.comment',
             'blog_comments.status',
             'blog_comments.created_at',
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
            ->join('blogs', 'blog_comments.blog_id', '=', 'blogs.id')
             ->whereRaw($filter)
             ->orderBy($orderEntity, $orderAction)
             ->skip($skip)->take($take)->get($fields);
     }
     
     public function totalBlogComment($search = null)
     {
         $filter = 1; // if no search add where

         // when search
         if (is_array($search) && count($search) > 0) {
             $partyName = (array_key_exists('keyword', $search)) ? " AND blogs.name LIKE '%" .
                 addslashes(trim($search['keyword'])) . "%' " : "";
             $filter .= $partyName;
         }
         return $this->select(\DB::raw('count(*) as total'))
         ->join('blogs', 'blog_comments.blog_id', '=', 'blogs.id')
             ->whereRaw($filter)->first();
     }

    public function permanentlyDelete($id)
    {
        return $this->find($id)->forceDelete();
    }

}
