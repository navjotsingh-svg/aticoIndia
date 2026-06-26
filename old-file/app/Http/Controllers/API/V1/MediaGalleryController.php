<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MediaGallery;

class MediaGalleryController extends Controller
{
    //All Media Gallery
    public function allMediaGallery(){
    	try{    
            $mediaGallery  = MediaGallery::where('status', 1)->orderBy('sort', 'desc')->get();

            if(count($mediaGallery) != 0){
              return apiResponse(true, 200 , null, null, $mediaGallery);
            }else{
              return apiResponse(false, 500, lang('No Media Gallery found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
