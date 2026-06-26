<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname', 
        'username',
        'email',
        'user_type', 
        'password',
        'mobile_no', 
        'country',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
      * @param $query
      * @return mixed
      */
     public function scopeActive($query)
     {
         return $query->where('status', 1);
     }


    /**
     * @param array $inputs
     *
     * @return \Illuminate\Validation\Validator
     */
    public function validateLoginUser($inputs, $id = null)
    {
        $rules['username'] = 'required';
        $rules['password'] = 'required|min:6';
        return \Validator::make($inputs, $rules);
    }

    /**
     * @param array $inputs
     *
     * @return \Illuminate\Validation\Validator
     */
    public function validate($inputs, $id = null)
    {
        if($id){
            $rules['name'] = 'required|string|max:30';
            $rules['surname'] = 'required|string|max:30';
            $rules['password'] = 'required|min:6|same:confirm_password';
            $rules['confirm_password'] = 'required|min:6';
            $rules['country'] = 'required|string|max:50';
        }
        else{
            $rules['name'] = 'required|string|max:30';
            $rules['surname'] = 'required|string|max:30';
            $rules['username'] = 'required|unique:users|alpha_num|max:30';
            $rules['mobile_no'] = 'required|unique:users|digits:10';
            $rules['email'] = 'required|email|max:255|unique:users';
            $rules['password'] = 'required|min:6|same:confirm_password';
            $rules['confirm_password'] = 'required|min:6';
            $rules['country'] = 'required|string|max:50';
        }
        
        return \Validator::make($inputs, $rules);
    }

    /**
     * @param array $inputs
     *
     * @return \Illuminate\Validation\Validator
     */
    public function validatePassword($inputs, $id = null)
    {   
        $rules['password']          = 'required';
        $rules['new_password']      = 'required|same:confirm_password';
        $rules['confirm_password']  = 'required';
        return \Validator::make($inputs, $rules);
    }

    /**
     * @param $inputs
     * @return mixed
     */
    public function validateOtp($inputs)
    {
        $rules = ['otp_number' => 'required|digits:6|numeric'];
        return \Validator::make($inputs, $rules);
    }

    /**
     * @param $inputs
     * @return mixed
     */
    public function validateMobile($inputs)
    {
        $rules = ['mobile_no' => 'required|digits:10|numeric'];
        return \Validator::make($inputs, $rules);
    }

    /**
      * @param $input
      * @param null $id
      * @return mixed
      */
     public function store($input, $id = null)
     {
         if ($id) {
             return $this->find($id)->update($input);
         } else {
             return $this->create($input)->id;
         }
     }     

    /**
     * @param $password
     * @return mixed
     */
    public function updatePassword($password)
    {
        return $this->where('id', authUserId())->update(['password' => $password]);
    }   
    /**
     * @param $email
     * @param $mobile
     * @return mixed
     */
    public function getTempAccount($mobile, $email)
    {
        $fields = [
                    'users.id as user_id',
                    'sms_codes.id as sms_id'
                ];
        $result  = $this->join('sms_codes','sms_codes.user_id','=','users.id')
                        ->where('users.email', $email)
                        ->where('users.mobile_no', $mobile)
                        ->where('users.status', 0)
                        ->where('sms_codes.status', 0)
                        ->first($fields);
        return $result;
    }

    /**
     * @param $id
     * @return int
     */
    public function deleteTempAccount($id)
    {
        $this->where('id', $id)->forceDelete();
    }

    /**
     * @param $id
     */
    public function activateAccount( $id ) {
        $this->find($id)->update(['status' => 1]);
    }

    /**
     * @param $otp
     * @return mixed
     */
    public function getUserByOtp( $temp, $otp )
    {
        $fields = [
                    'users.id as user_id',
                    'sms_codes.id as sms_id'
                ];
        return $this->join('sms_codes','sms_codes.user_id','=','users.id')
                    ->where(\DB::raw('TIMESTAMPDIFF(MINUTE,sms_codes.created_at,now())'),'<=',2)
                    ->where('sms_codes.code', $otp)
                    ->where('sms_codes.status', 0)
                    ->where('users.status', 0)
                    ->where('users.id', $temp)
                    ->first($fields);
    }

    /**
     * @param $mobile
     */
    public function alreadyActivateNo( $mobile ) {
        return $this->where('mobile_no', $mobile)->where('status',1)->first();
    }

    /**
     * @param $mobile
     */
    public function getUserByMobile( $mobile ) {
        return $this->where('mobile_no', $mobile)->where('status',0)->first();
    }

    /**
      * @param null $search
      * @param $skip
      * @param $perPage
      * @return mixed
      */
     public function getCustomer($search = null, $skip, $perPage)
     {
         $take = ((int)$perPage > 0) ? $perPage : 20;
         $filter = 1; // default filter if no search

         $fields = [
                'id',
                'name',
                'surname', 
                'username',
                'email',
                'user_type', 
                'password',
                'mobile_no', 
                'country',
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
                 " AND (name LIKE '%" .addslashes(trim($search['keyword'])) . "%')" : "";
             $filter .= $keyword;
         }

         return $this
             ->whereRaw($filter)
             ->where('id','!=',1)
             ->where('user_type','!=',1)
             ->where('user_type',2)
             ->orderBy($orderEntity, $orderAction)
             ->skip($skip)->take($take)->get($fields);
     }

     /**\
      * @param null $search
      * @return mixed
      */
     public function totalCustomer($search = null)
     {
         $filter = 1; // if no search add where

         // when search
         if (is_array($search) && count($search) > 0) {
             $partyName = (array_key_exists('keyword', $search)) ? " AND name LIKE '%" .
                 addslashes(trim($search['keyword'])) . "%' " : "";
             $filter .= $partyName;
         }
         return $this->select(\DB::raw('count(*) as total'))
                    ->where('id','!=',1)
                    ->where('user_type','!=',1)
                    ->where('user_type',2)
                    ->whereRaw($filter)
                    ->first();
     }

     /**
      * @param $id
      */
    public function tempDelete($id)
    {
        $this->find($id)->update([ 'deleted_by' => authUserId(), 'deleted_at' => convertToUtc()]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function permanentlyDelete($id)
    {
        return $this->find($id)->forceDelete();
    }

}
