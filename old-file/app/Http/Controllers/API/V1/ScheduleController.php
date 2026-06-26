<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ScheduleDate;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    //All Schedule Date
    public function allScheduleDates(){
    	try{    
            $schedule_dates  = ScheduleDate::where('status', 1)->orderBy('sort', 'asc')->get();

            if(count($schedule_dates) != 0){
              return apiResponse(true, 200 , null, null, $schedule_dates);
            }else{
              return apiResponse(false, 500, lang('No schedule dates found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //All Schedule 
    public function allSchedule(Request $request){
    	try{    
    		$inputs = $request->all();
    		$validator = (new Schedule)->validateScheduleApp($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }

            $schedules  = Schedule::where('schedule_date_id', $inputs['schedule_date_id'])->where('status', 1)->orderBy('sort', 'asc')->get();

            if(count($schedules) != 0){
              return apiResponse(true, 200 , null, null, $schedules);
            }else{
              return apiResponse(false, 500, lang('No schedules found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
