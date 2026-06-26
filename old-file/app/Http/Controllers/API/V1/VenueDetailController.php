<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VenueDetail;

class VenueDetailController extends Controller
{
   //Add Venue Detail
    public function addVenueDetail(Request $request){
    	try{    
            $inputs = $request->all();
    		$validator = (new VenueDetail)->validate($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }

            if(isset($inputs['icon']) or !empty($inputs['icon']))
            {
            	$image_name = rand(100000, 999999);
	            $fileName = '';
	            if($file = $request->hasFile('icon')) 
	            {
	                $file = $request->file('icon') ;
	                $img_name = $file->getClientOriginalName();
	                $fileName = $image_name.$img_name;
	                $destinationPath = public_path().'/uploads/venue_icons/' ;
	                $file->move($destinationPath, $fileName);
	            }

	            $image = $fileName;
            }
            else{
            	$image = null;
            }

             if(isset($inputs['location_icon']) or !empty($inputs['location_icon']))
            {
            	$image_name = rand(100000, 999999);
	            $fileName = '';
	            if($file = $request->hasFile('location_icon')) 
	            {
	                $file = $request->file('location_icon') ;
	                $img_name = $file->getClientOriginalName();
	                $fileName = $image_name.$img_name;
	                $destinationPath = public_path().'/uploads/venue_icons/' ;
	                $file->move($destinationPath, $fileName);
	            }

	            $location_icon = $fileName;
            }
            else{
            	$location_icon = null;
            }

	        unset($inputs['icon']);
	        unset($inputs['location_icon']);
            $inputs = $inputs + [
                'icon'	=>	$image,
                'location_icon'	=>	$location_icon
            ];

            (new VenueDetail)->store($inputs);

            return apiResponse(true, 200 , 'Venue Detail added');

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //All Venue Details
    public function allVenueDetails(){
    	try{    
            $venue_details  = VenueDetail::where('status', 1)->orderBy('sort', 'asc')->get();

            if(count($venue_details) != 0){
              return apiResponse(true, 200 , null, null, $venue_details);
            }else{
              return apiResponse(false, 500, lang('No Venue Details found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }


}
