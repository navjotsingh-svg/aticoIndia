<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MediaAlbum;
use App\Models\MediaGallery;

class MediaAlbumController extends Controller
{
    //Add Media Album
    public function addMediaAlbum(Request $request){
    	try{    
            $inputs = $request->all();
    		$validator = (new MediaAlbum)->validate($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }

            (new MediaAlbum)->store($inputs);

            return apiResponse(true, 200 , 'Media Album added');

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //Add Media Album Images
    public function addMediaAlbumImages(Request $request){
    	try{    
            $inputs = $request->all();
    		$validator = (new MediaGallery)->validate($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }

            if(isset($inputs['image']) or !empty($inputs['image']))
            {
            	$image_name = rand(100000, 999999);
	            $fileName = '';
	            if($file = $request->hasFile('image')) 
	            {
	                $file = $request->file('image') ;
	                $img_name = $file->getClientOriginalName();
	                $fileName = $image_name.$img_name;
	                $destinationPath = public_path().'/uploads/media_images/' ;
	                $file->move($destinationPath, $fileName);
	            }

	            $image = $fileName;
            }
            else{
            	$image = null;
            }

	        unset($inputs['image']);
            $inputs = $inputs + [
                'image'	=>	$image
            ];

            (new MediaGallery)->store($inputs);

            return apiResponse(true, 200 , 'Album Image added');

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //All Album
    public function allMediaGalleryAlbums(){
    	try{    
            $album  = MediaAlbum::where('status', 1)->orderBy('sort', 'desc')->get();

            if(count($album) != 0){
            	foreach ($album as $albums) {
            		 $albums['images']  = MediaGallery::where('media_albums_id', $albums->id)->where('status', 1)->orderBy('sort', 'desc')->get();
            	}
              return apiResponse(true, 200 , null, null, $album);
            }else{
              return apiResponse(false, 500, lang('No album found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //All Album
    public function allMediaGalleryAlbumsImages(Request $request){
    	try{   

    		$inputs = $request->all();
    		$validator = (new MediaAlbum)->validateApp($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            } 

            $album  = MediaGallery::where('media_albums_id', $inputs['album_id'])->where('status', 1)->orderBy('sort', 'desc')->get();

            if(count($album) != 0){
              return apiResponse(true, 200 , null, null, $album);
            }else{
              return apiResponse(false, 500, lang('No album found'));
            }

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
