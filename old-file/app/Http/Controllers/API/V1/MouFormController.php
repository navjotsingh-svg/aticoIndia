<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MouForm;
use Mail;

class MouFormController extends Controller
{
    //Add Mou Form
    public function addMouForms(Request $request){
    	try{    
            $inputs = $request->all();
    		$validator = (new MouForm)->validateApp($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }

            if(isset($inputs['mou_form']) or !empty($inputs['mou_form']))
            {
            	$image_name = rand(100000, 999999);
	            $fileName = '';
	            if($file = $request->hasFile('mou_form')) 
	            {
	                $file = $request->file('mou_form') ;
	                $img_name = $file->getClientOriginalName();
	                $fileName = $image_name.$img_name;
	                $destinationPath = public_path().'/uploads/mou_forms/' ;
	                $file->move($destinationPath, $fileName);
	            }

	            $image = $fileName;
            }
            else{
            	$image = null;
            }

	        unset($inputs['mou_form']);
            $inputs = $inputs + [
                'mou_form'	=>	$image
            ];

            
            $id = (new MouForm)->store($inputs);
            $data[] = MouForm::find($id);
            $ind_data = MouForm::find($id);
            //dd($ind_data);  
            $email = $inputs['email'];
            
            \Mail::send('frontend.pdf.mou_mail', $data, function($message) use($ind_data, $email){
                $pdf = \PDF::loadView('frontend.pdf.mou_pdf', $ind_data);
                $message->to('info@investinhimachal.com')->subject('MOU Enquiry');
                $message->from('info@risinghimachal.com','Himachal Govt.');
                $message->attachData($pdf->output(), 'mou_pdf.pdf');
            });

            \Mail::send('frontend.pdf.individual_mail_to_user', $data, function($message) use ($email){
                $message->from('info@investinhimachal.com');
                $message->to($email);
                $message->subject('MOU Enquiry');
            });

            return apiResponse(true, 200 , 'Mou Form added');

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
