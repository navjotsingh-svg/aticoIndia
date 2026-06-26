<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PartnerCountry;
use App\Models\Organizer;

class PartnersController extends Controller
{
    //All Partner Country
    public function allPartners(){
    	try{    
            $partnerCountry  = PartnerCountry::get();

            if(count($partnerCountry) != 0){
              return apiResponse(true, 200 , null, null, $partnerCountry);
            }else{
              return apiResponse(false, 500, lang('No Partner Country found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //All Organizer
    public function allOrganisersListing(){
      try{    
            $organizer  = Organizer::where('status', 1)->orderBy('created_at', 'desc')->get();

            if(count($organizer) != 0){
              return apiResponse(true, 200 , null, null, $organizer);
            }else{
              return apiResponse(false, 500, lang('No organizer found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
