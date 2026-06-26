<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IndustrialProfile;
use App\Models\Highlight;


class IndustrialProfileController extends Controller
{
    //All Industrial Profile
    public function allIndustrialProfile(){
    	try{    
            $sectors  = IndustrialProfile::first();

            if(isset($sectors)){
              return apiResponse(true, 200 , null, null, $sectors);
            }else{
              return apiResponse(false, 500, lang('No Industrial Profile found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //All Industrial Profile Highlights
    public function allIndustrialProfileHighlights(){
    	try{    
            $highlights  = Highlight::orderBy('created_at', 'desc')->get();

            if(count($highlights) != 0){
              return apiResponse(true, 200 , null, null, $highlights);
            }else{
              return apiResponse(false, 500, lang('No Industrial Profile highlights found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
