<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SellLeaseForm;
use Mail;

class SellAndLeaseController extends Controller
{
    //Add Sell Lease Form
    public function addSellLeaseForm(Request $request){
    	try{    
            $inputs = $request->all();
    		$validator = (new SellLeaseForm)->validateApp($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }

          	$email = $inputs['email'];
            $id = (new SellLeaseForm)->store($inputs);
            $data[] = SellLeaseForm::find($id);
            $ind_data = SellLeaseForm::find($id);
                       
            $email = $inputs['email'];
            \Mail::send('frontend.pdf.sell_lease_mail', $data, function($message) use($ind_data, $email){
                $pdf = \PDF::loadView('frontend.pdf.sell_lease_pdf', $ind_data);
                $message->to('info@investinhimachal.com')->subject('Sell/Lease Enquiry');
                $message->from('info@risinghimachal.com','Himachal Govt.');
                $message->attachData($pdf->output(), 'sell_lease_pdf.pdf');
            });

            \Mail::send('frontend.pdf.individual_mail_to_user', $data, function($message) use ($email){
                $message->from('info@investinhimachal.com');
                $message->to($email);
                $message->subject('Sell/Lease Enquiry');
            });

            return apiResponse(true, 200 , 'Sell Lease Form added');

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }
}
