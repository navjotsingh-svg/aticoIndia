<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InvestibleProject;
use App\Models\InvestmentOpportunity;

class InvestibleProjectController extends Controller
{
    //Add Investible Project
    public function addInvestibleProject(Request $request){
    	try{    
            $inputs = $request->all();
    		$validator = (new InvestibleProject)->validate($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }

            if(isset($inputs['section_image']) or !empty($inputs['section_image']))
            {
            	$image_name = rand(100000, 999999);
	            $fileName = '';
	            if($file = $request->hasFile('section_image')) 
	            {
	                $file = $request->file('section_image') ;
	                $img_name = $file->getClientOriginalName();
	                $fileName = $image_name.$img_name;
	                $destinationPath = public_path().'/uploads/' ;
	                $file->move($destinationPath, $fileName);
	            }

	            $image = $fileName;
            }
            else{
            	$image = null;
            }

	        unset($inputs['section_image']);
            $inputs = $inputs + [
                'section_image'	=>	$image,
            ];

            (new InvestibleProject)->store($inputs);

            return apiResponse(true, 200 , 'Investible Project added');

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }


    //Add Investment Opportunity
    public function addInvestmentOpportunity(Request $request){
    	try{    
            $inputs = $request->all();
    		$validator = (new InvestmentOpportunity)->validate($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }

            if(isset($inputs['section_image']) or !empty($inputs['section_image']))
            {
            	$image_name = rand(100000, 999999);
	            $fileName = '';
	            if($file = $request->hasFile('section_image')) 
	            {
	                $file = $request->file('section_image') ;
	                $img_name = $file->getClientOriginalName();
	                $fileName = $image_name.$img_name;
	                $destinationPath = public_path().'/uploads/' ;
	                $file->move($destinationPath, $fileName);
	            }

	            $image = $fileName;
            }
            else{
            	$image = null;
            }

	        unset($inputs['section_image']);
            $inputs = $inputs + [
                'section_image'	=>	$image,
            ];

            (new InvestmentOpportunity)->store($inputs);

            return apiResponse(true, 200 , 'Investment Opportunity added');

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

     //All Investible Project
    public function allInvestibleProject(){
    	try{    
            $investibleProject  = InvestibleProject::where('status', 1)->orderBy('sort', 'asc')->get();

            if(isset($investibleProject)){
              return apiResponse(true, 200 , null, null, $investibleProject);
            }else{
              return apiResponse(false, 500, lang('No Investible Project found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

     //All Investment Opportunity
    public function allInvestmentOpportunity(){
    	try{    
            $investmentOpportunity  = InvestmentOpportunity::where('status', 1)->orderBy('sort', 'asc')->get();

            if(isset($investmentOpportunity)){
              return apiResponse(true, 200 , null, null, $investmentOpportunity);
            }else{
              return apiResponse(false, 500, lang('No Investment Opportunity found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
