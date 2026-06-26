<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    //Enquiry
    public function enquiry(Request $request){
    	try{    
    		$inputs = $request->all();
    		$validator = (new Enquiry)->validateApp($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }

            $id = (new Enquiry)->store($inputs);
            
            return apiResponse(true, 200, lang('Thank you for enquiry. We will get back to you as soon as possible.'));

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
