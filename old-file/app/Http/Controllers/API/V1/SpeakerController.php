<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Speaker;

class SpeakerController extends Controller
{
    //All Speakers
    public function allSpeakers(){
    	try{    
            $speakers  = Speaker::where('status', 1)->get();

            if(count($speakers) != 0){
              return apiResponse(true, 200 , null, null, $speakers);
            }else{
              return apiResponse(false, 500, lang('No speakers found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
