<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\AlbumImage;

class AlbumController extends Controller
{
   //Add Album
    public function addAlbum(Request $request){
    	try{    
            $inputs = $request->all();
    		$validator = (new Album)->validate($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }

            (new Album)->store($inputs);

            return apiResponse(true, 200 , 'Album added');

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //Add Album Images
    public function addAlbumImages(Request $request){
    	try{    
            $inputs = $request->all();
    		$validator = (new AlbumImage)->validate($inputs);
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
	                $destinationPath = public_path().'/uploads/album_images/' ;
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

            (new AlbumImage)->store($inputs);

            return apiResponse(true, 200 , 'Album Image added');

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //All Album
    public function allAlbums(){
    	try{    
            $album  = Album::where('status', 1)->orderBy('sort', 'desc')->get();

            if(count($album) != 0){
            	foreach ($album as $albums) {
            		 $albums['images']  = AlbumImage::where('album_id', $albums->id)->where('status', 1)->orderBy('sort', 'asc')->get();
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
    public function allAlbumsImages(Request $request){
    	try{   

    		$inputs = $request->all();
    		$validator = (new AlbumImage)->validateApp($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            } 

            $album  = AlbumImage::where('album_id', $inputs['album_id'])->where('status', 1)->orderBy('sort', 'asc')->get();

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
