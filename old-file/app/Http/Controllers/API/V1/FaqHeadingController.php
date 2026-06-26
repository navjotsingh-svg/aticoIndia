<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FaqHeading;
use App\Models\FaqQuestion;

class FaqHeadingController extends Controller
{
    //Add Faq Heading
    public function addFaqHeading(Request $request){
    	try{    
            $inputs = $request->all();
    		$validator = (new FaqHeading)->validate($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }
            (new FaqHeading)->store($inputs);

            return apiResponse(true, 200 , 'Faq Heading added');

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
  }

  	//Add Faq Question
    public function addFaqQuestion(Request $request){
    	try{    
            $inputs = $request->all();
    		$validator = (new FaqQuestion)->validate($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }
            (new FaqQuestion)->store($inputs);

            return apiResponse(true, 200 , 'Faq Question added');

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
  	}

  	//All Faq Questions
    public function allFaqQuestion(){
    	try{ 
            $data = FaqHeading::where('status', 1)->orderBy('sort', 'asc')->get();

            if(isset($data)){
            	$fields = ['question', 'answer'];
            	foreach ($data as $questions) {
            		$questions['questions'] = FaqQuestion::where('faq_heading_id', $questions->id)->where('status', 1)->orderBy('sort', 'asc')->get($fields);
            	}
              return apiResponse(true, 200 , null, null, $data);
            }else{
              return apiResponse(false, 500, lang('No Faq Questions found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
  	}
}
