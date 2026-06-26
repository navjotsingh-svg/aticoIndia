<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Individual;
use App\Models\BToG;
use App\Models\UploadMouForm;
use App\Models\IntendToInvest;
use Mail;
use PDF;

class RegisterController extends Controller
{
    //Individual Register
    public function individualRegister(Request $request){
    	try{    
    		$inputs = $request->all();
    		$validator = (new Individual)->validateApp($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }

            $id = (new Individual)->store($inputs);

            $data[] = Individual::find($id);
            $ind_data = Individual::where('individuals.id', $id)->leftjoin('countries', 'individuals.country', '=', 'countries.id')
                    ->leftjoin('states', 'individuals.state', 'states.id')->leftjoin('cities', 'individuals.city', '=', 'cities.id')->select('individuals.id', 'individuals.company_name', 'individuals.pan', 'individuals.address_line_1', 'individuals.address_line_2', 'individuals.district', 'individuals.taluka', 'individuals.pin_code', 'individuals.phone_number', 'individuals.fax_number', 'individuals.email', 'individuals.website', 'individuals.salutation', 'individuals.designation', 'individuals.name', 'individuals.mobile', 'individuals.contact_email', 'countries.name as country', 'states.name as state', 'cities.name as city')->first();
            
            $email = $ind_data['contact_email'];

            \Mail::send('frontend.pdf.individual_mail', $data, function($message) use($ind_data, $email){
                $pdf = \PDF::loadView('frontend.pdf.individual', $ind_data);
                $message->to('info@investinhimachal.com')->subject('Individual');
                $message->from('info@risinghimachal.com','Himachal Govt.');
                $message->attachData($pdf->output(), 'individual.pdf');
            });

            \Mail::send('frontend.pdf.individual_mail_to_user', $data, function($message) use ($email){
                $message->from('info@investinhimachal.com');
                $message->to($email);
                $message->subject('Individual Form');
            });
            
            return apiResponse(true, 200, lang('Registration successful'));

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    //B2G Meeting Register
    public function bGMeetingRegister(Request $request){
    	try{    
    		$inputs = $request->all();
    		$validator = (new BToG)->validateApp($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }

             if(isset($inputs['project_summary_report']) or !empty($inputs['project_summary_report']))
            {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('project_summary_report')) 
                {
                    $file = $request->file('project_summary_report') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/' ;
                    $file->move($destinationPath, $fileName);
                }
                unset($inputs['project_summary_report']);
                $inputs['project_summary_report'] = $fileName;
            }
            else{
                unset($inputs['project_summary_report']);
                $inputs['project_summary_report'] = null;
            }


            $id = (new BToG)->store($inputs);

            $data[] = BToG::find($id);
            $ind_data = BToG::where('b_to_g.id', $id)->leftjoin('countries', 'b_to_g.country', '=', 'countries.id')
                    ->leftjoin('states', 'b_to_g.state', 'states.id')->leftjoin('cities', 'b_to_g.city', '=', 'cities.id')->select('b_to_g.id', 'b_to_g.project_detail', 'b_to_g.project_proposal', 'b_to_g.signed_mou', 'b_to_g.project_summary_report', 'b_to_g.project_category', 'b_to_g.sector', 'b_to_g.sectoral_name', 'b_to_g.proposed_investment', 'b_to_g.proposed_employment', 'b_to_g.company_name', 'b_to_g.pan', 'b_to_g.address_line_1', 'b_to_g.address_line_2', 'b_to_g.district', 'b_to_g.taluka', 'b_to_g.pin_code', 'countries.name as country', 'states.name as state', 'cities.name as city', 'b_to_g.phone_number', 'b_to_g.fax_number', 'b_to_g.email', 'b_to_g.website', 'b_to_g.designation', 'b_to_g.name', 'b_to_g.mobile', 'b_to_g.contact_email', 'b_to_g.ref_name', 'b_to_g.ref_designation', 'b_to_g.multiple_location_project', 'b_to_g.project_district', 'b_to_g.project_taluka', 'b_to_g.project_village', 'b_to_g.year_of_commencement', 'b_to_g.expectation_from_state', 'b_to_g.created_at', 'b_to_g.salutation')->first();
            $email = $ind_data['contact_email'];
           \Mail::send('frontend.pdf.individual_mail', $data, function($message) use($ind_data, $email){
                $pdf = \PDF::loadView('frontend.pdf.individual', $ind_data);
                $message->to('info@investinhimachal.com')->subject('Individual');
                $message->from('info@risinghimachal.com','Himachal Govt.');
                $message->attachData($pdf->output(), 'individual.pdf');
            });

            \Mail::send('frontend.pdf.individual_mail_to_user', $data, function($message) use ($email){
                $message->from('info@investinhimachal.com');
                $message->to($email);
                $message->subject('Rising Himachal');
            });
            
            return apiResponse(true, 200, lang('Registration successful'));

      }catch(Exception $e){
           return apiResponse(false, 500, lang('messages.server_error'));
      }
    }

    public function uploadMouForm(Request $request)
    {
        try{
            $inputs = $request->all();
            $validator = (new UploadMouForm)->validateApp($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }
            $mou_form = UploadMouForm::where('created_by', 'user')->orderBy('id', 'desc')->first();
            $inputs['created_by'] = 'user';
            if(isset($mou_form)){
                $unique_string = $mou_form['unique_no'];
                $uni_old_num = str_replace('RHPGIM/MOU/', '', $unique_string);
                $uni_new_num = $uni_old_num + 1;
                $inputs['unique_no'] = 'RHPGIM/MOU/'.$uni_new_num;
            }
            else{
                $inputs['unique_no'] = 'RHPGIM/MOU/1201';
            }
            $check_uniq = UploadMouForm::where('unique_no', $inputs['unique_no'])->first();
            if(isset($check_uniq)){
                $unique_string = $check_uniq['unique_no'];
                $uni_old_num = str_replace('RHPGIM/MOU/', '', $unique_string);
                $uni_new_num = $uni_old_num + 1;
                unset($inputs['unique_no']);
                $inputs['unique_no'] = 'RHPGIM/MOU/'.$uni_new_num;
            }
            $id = (new UploadMouForm)->store($inputs);
            
            return apiResponse(true, 200, lang('MoU successful submitted'));
        } catch (\Exception $exception) {
           return apiResponse(false, 500, lang($exception->getMessage()));
        }
    }

      public function intentToInvest(Request $request)
    {
        try{
            $inputs = $request->all();
            $validator = (new IntendToInvest)->validateApp($inputs);
            if( $validator->fails() ) {
                return apiResponse(false, 406, "", errorMessages($validator->messages()));
            }
            $mou_form = IntendToInvest::orderBy('id', 'desc')->first();
            if(isset($mou_form)){
                $unique_string = $mou_form['unique_no'];
                $uni_old_num = str_replace('RHPGIM/BID/', '', $unique_string);
                $uni_new_num = $uni_old_num + 1;
                $inputs['unique_no'] = 'RHPGIM/BID/'.$uni_new_num;
            }
            else{
                $inputs['unique_no'] = 'RHPGIM/BID/1101';
            }
            $id = (new IntendToInvest)->store($inputs);

            return apiResponse(true, 200, lang('MoU successful submitted'));
        } catch (\Exception $exception) {
           return apiResponse(false, 500, lang('messages.server_error'));
        }
    }
}
