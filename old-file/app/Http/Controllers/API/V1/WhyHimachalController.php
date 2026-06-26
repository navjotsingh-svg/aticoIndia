<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HPStat;
use App\Page;
use App\Models\MenuPolicy;

class WhyHimachalController extends Controller
{
     //Himachal Stats
    public function allStats(){
    	try{    
            $stats  = HPStat::first();

            if(isset($stats)){
              return apiResponse(true, 200 , null, null, $stats);
            }else{
              return apiResponse(false, 500, lang('No stats found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    public function policies()
    {
        try{    
            $policies  = Page::where('parent_id', 60)->where('status', 1)->orderBy('sort', 'asc')->get();

            if(isset($policies)){
              return apiResponse(true, 200 , null, null, $policies);
            }else{
              return apiResponse(false, 500, lang('No policies found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    public function new_policies()
    {
        try{    
            $policies  = MenuPolicy::where('status', 1)->orderBy('sort', 'asc')->get();

            if(isset($policies)){
              return apiResponse(true, 200 , null, null, $policies);
            }else{
              return apiResponse(false, 500, lang('No policies found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
