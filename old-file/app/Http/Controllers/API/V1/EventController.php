<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EventCategory;
use App\Models\EventSection;
use App\Models\EventSectionDetail;

class EventController extends Controller
{
    
    //All Event Main Category
    public function allEventMain(){
    	try{    
            $category  = EventCategory::where('status', 1)->where('parent_id', null)->orderBy('sort', 'asc')->get();

            if(count($category) != 0){
              return apiResponse(true, 200 , null, null, $category);
            }else{
              return apiResponse(false, 500, lang('No event main found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //All Event Main Category
    public function allEventMainSubCategory(Request $request){
    	try{  
    		$inputs = $request->all();
    		$validator = (new EventSection)->validateEventCategory($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            } 
 
            $category  = EventCategory::where('status', 1)->where('parent_id', $inputs['id'])->orderBy('sort', 'asc')->get();

            if(count($category) != 0){
              return apiResponse(true, 200 , null, null, $category);
            }else{
              return apiResponse(false, 500, lang('No event main found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //All Event Main Category
    public function allEventSection(Request $request){
    	try{  
    		$inputs = $request->all();
    		$validator = (new EventSection)->validateEventCategory($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            } 
 
            if(isset($inputs['sub_id'])){
            	$category  = EventSection::where('status', 1)->where('event_category_id', $inputs['id'])->where('event_category_parent_id', $inputs['sub_id'])->orderBy('sort', 'asc')->get();
            }else{
            	$category  = EventSection::where('status', 1)->where('event_category_id', $inputs['id'])->orderBy('sort', 'asc')->get();
            }

            if(count($category) != 0){
            	foreach ($category as $detail) {
            		$detail['section_detail']  = EventSectionDetail::where('status', 1)->where('event_section_id', $detail->id)->orderBy('sort', 'asc')->get();
            	}
              return apiResponse(true, 200 , null, null, $category);
            }else{
              return apiResponse(false, 500, lang('No event main found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
