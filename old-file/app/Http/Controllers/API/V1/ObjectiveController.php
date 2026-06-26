<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Objective;
use App\Models\About;

class ObjectiveController extends Controller
{
    //All Objectives
    public function allObjective(){
    	try{    
            $objective  = Objective::where('status', 1)->get();

            if(count($objective) != 0){
              return apiResponse(true, 200 , null, null, $objective);
            }else{
              return apiResponse(false, 500, lang('No Objective found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //About HP
    public function aboutRisingHimachal(){
      try{    
            $about  = About::first();

            if(isset($about)){
              return apiResponse(true, 200 , null, null, $about);
            }else{
              return apiResponse(false, 500, lang('No about found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
