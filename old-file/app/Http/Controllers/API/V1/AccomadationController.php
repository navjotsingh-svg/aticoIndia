<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Accommodation;

class AccomadationController extends Controller
{
    //All Hotels
    public function allHotels(){
    	try{    
            $accommodation  = Accommodation::where('status', 1)->get();

            if(count($accommodation) != 0){
              return apiResponse(true, 200 , null, null, $accommodation);
            }else{
              return apiResponse(false, 500, lang('No accommodation found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
