<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StateProgress;
use App\Models\IncentiveAndConcession;
use App\Models\ActAndRule;

class EaseOfDoingController extends Controller
{
    //All State Progress
    public function allStateProgress(){
    	try{    
            $stateProgress  = StateProgress::where('status', 1)->get();

            if(count($stateProgress) != 0){
              return apiResponse(true, 200 , null, null, $stateProgress);
            }else{
              return apiResponse(false, 500, lang('No State Progress found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //All Incentives And Concession
    public function incentivesConcessionDetails(){
    	try{    
            $incentives  = IncentiveAndConcession::where('status', 1)->orderBy('created_at', 'desc')->get();

            if(count($incentives) != 0){
              return apiResponse(true, 200 , null, null, $incentives);
            }else{
              return apiResponse(false, 500, lang('No incentives found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //All Act and rules
    public function actsRules(){
    	try{    
            $actsRules  = ActAndRule::where('status', 1)->orderBy('created_at', 'desc')->get();

            if(count($actsRules) != 0){
              return apiResponse(true, 200 , null, null, $actsRules);
            }else{
              return apiResponse(false, 500, lang('No Act and rules found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
