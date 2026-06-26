<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PartnerInProgress;
use App\Models\PartnersProgressLogo;

class PartnerInProgressController extends Controller
{
    //Add Partner In Progress
    public function addPartners(Request $request){
    	try{    
            $inputs = $request->all();
    		$validator = (new PartnerInProgress)->validate($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }

            (new PartnerInProgress)->store($inputs);

            return apiResponse(true, 200 , 'Partner in progress added');

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //Add Partner In Progress
    public function addPartnersLogos(Request $request){
    	try{    
            $inputs = $request->all();
    		$validator = (new PartnersProgressLogo)->validate($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }

            if(isset($inputs['logo']) or !empty($inputs['logo']))
            {
            	$image_name = rand(100000, 999999);
	            $fileName = '';
	            if($file = $request->hasFile('logo')) 
	            {
	                $file = $request->file('logo') ;
	                $img_name = $file->getClientOriginalName();
	                $fileName = $image_name.$img_name;
	                $destinationPath = public_path().'/uploads/partner_logos/' ;
	                $file->move($destinationPath, $fileName);
	            }

	            $image = $fileName;
            }
            else{
            	$image = null;
            }

	        unset($inputs['logo']);
            $inputs = $inputs + [
                'logo'	=>	$image
            ];

            (new PartnersProgressLogo)->store($inputs);

            return apiResponse(true, 200 , 'Partner in progress logo added');

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //All Partner in progress
    public function allPartners(){
    	try{    
            $partners  = PartnerInProgress::where('status', 1)->orderBy('sort', 'asc')->get();

            if(isset($partners)){

            	foreach ($partners as $partner) {
            		$partner['logos'] = PartnersProgressLogo::where('section_id', $partner->id)->orderBy('sort', 'asc')->get();
            	}
              return apiResponse(true, 200 , null, null, $partners);
            }else{
              return apiResponse(false, 500, lang('No partners found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
