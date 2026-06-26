<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\CiiLocation;

class LocationController extends Controller
{
    //Add Location
    public function addLocation(Request $request){
    	try{    
            $inputs = $request->all();
    		$validator = (new Location)->validate($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }
            (new Location)->store($inputs);

            return apiResponse(true, 200 , 'Location added');

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
  	}

  	 //Add Cii Location
    public function addCiiLocation(Request $request){
    	try{    
            $inputs = $request->all();
    		$validator = (new CiiLocation)->validate($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }
            (new CiiLocation)->store($inputs);

            return apiResponse(true, 200 , 'Cii Location added');

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
  	}

  	//All Location
    public function allLocation(){
    	try{    
            $data = Location::first();

            if(isset($data)){
              return apiResponse(true, 200 , null, null, $data);
            }else{
              return apiResponse(false, 500, lang('No Location found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
  	}

  	//All Cii Location
    public function allCiiLocation(){
    	try{    
            $data = CiiLocation::first();

            if(isset($data)){
              return apiResponse(true, 200 , null, null, $data);
            }else{
              return apiResponse(false, 500, lang('No Cii Location found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
  	}
}
