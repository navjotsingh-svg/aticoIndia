<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FocusSector;
use App\Models\Sector;

class SectorController extends Controller
{
    //All Focus Sectors
    public function allFocusSectors(){
    	try{    
            $sectors  = FocusSector::where('status', 1)->orderBy('sort', 'asc')->get();

            if(count($sectors) != 0){
              return apiResponse(true, 200 , null, null, $sectors);
            }else{
              return apiResponse(false, 500, lang('No sectors found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //All Sectoral Session
    public function allSectors(){
      try{    
            $sectors  = Sector::where('status', 1)->get();

            if(count($sectors) != 0){
              return apiResponse(true, 200 , null, null, $sectors);
            }else{
              return apiResponse(false, 500, lang('No sectors found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
