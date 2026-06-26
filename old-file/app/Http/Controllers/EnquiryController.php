<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Models\Enquiry;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Storage;

use Mail;



class EnquiryController extends Controller

{

    public function store(Request $request)

{


    try {


        if ($request->has('mobileno')) {
            return back()->with('success', 'We have received your message.');
        }
        $inputs = $request->all();

        

        $validator = (new Enquiry)->validate($inputs);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();

        }
        $fileUrl = '';
        if ($request->hasFile('file_name')) {

            $file = $request->file('file_name');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('files'), $filename); // Move file to public folder

            

            $fileUrl = '/files/' . $filename; // Relative path of the stored file

            $inputs['file_name'] = $fileUrl;

        }



        $id = (new Enquiry)->store($inputs);

        $enquiry = Enquiry::find($id);

        $data = [

            'name' => $enquiry['name'],

            'email' => $enquiry['email'],

            'country' => $enquiry['country'],

            'mobile_no' => $enquiry['mobile_no'],

            'massage' => $enquiry['message'],

            'file_name' => $fileUrl,

            'page_url' => $request['page_url'],
            'ip_address' => $request['ip_address'],

        ];



        $email = $enquiry['email'];

       /* if ($email) {

            \Mail::send('frontend.emails.contact_us', $data, function ($message) use ($email) {

                $message->from('enquiry@tejcargopackersandmovers.com');

                $message->to('sales@aticoindia.com');

                $message->subject('Enquiry Submitted');

            });

        }*/

        // if($email){
        //         \Mail::send('frontend.emails.contact_us', $data, function($message) use ($email){
        //             $message->from('sales@aticoindia.com');
        //             $message->to($email);
        //             $message->subject('Enquiry Submitted');
        //         });    
        //     }

            if($email){
                \Mail::send('frontend.emails.contact_us', $data, function($message) use ($email,$enquiry){
                    $message->from('sales@aticoindia.com',$enquiry['name']);
                    $message->to('sales@aticoindia.com');
                    $message->subject('Enquiry Received');
                });    
            }

            if($email){
                \Mail::send('frontend.emails.contact_us', $data, function($message) use ($email){
                    $message->from('sales@aticoindia.com');
                    $message->to($email);
                    $message->subject('Enquiry Received');
                });    
            }



        return back()->with('success', 'We have received your message.');

    } catch (\Exception $e) {
        dd($e);
        return back();

    }

}



    

    public function index()

    {

        return view('admin.enquiry.index');

    }

public function destroy($id)

    {

        try {

            $enquiry = Enquiry::findOrFail($id);

            $enquiry->delete();



            return redirect()->route('enquiry.index')->with('success', 'Enquiry deleted successfully.');

        } catch (\Exception $e) {

            // Log the error or handle it as needed

            return redirect()->route('enquiry.index')->with('error', 'Failed to delete enquiry.');

        }

    }

    

   public function deleteSelected(Request $request)

{

    try {

        $selectedEnquiries = $request->input('selected_enquiries', []);



        Enquiry::whereIn('id', $selectedEnquiries)->delete();



        return redirect()->route('enquiry.index')->with('success', 'Selected enquiries deleted successfully.');

    } catch (\Exception $e) {

        // Log the error message

        \Log::error('Error deleting selected enquiries: ' . $e->getMessage());



        // Return with an error message

        return redirect()->route('enquiry.index')->with('error', 'Failed to delete selected enquiries.');

    }

}



    public function enquiryPaginate(Request $request, $pageNumber = null)

    {

        if (!\Request::isMethod('post') && !\Request::ajax()) { //

            return lang('messages.server_error');

        }



        $inputs = $request->all();

        $page = 1;

        if (isset($inputs['page']) && (int)$inputs['page'] > 0) {

            $page = $inputs['page'];

        }



        $perPage = 20;

        if (isset($inputs['perpage']) && (int)$inputs['perpage'] > 0) {

            $perPage = $inputs['perpage'];

        }



        $start = ($page - 1) * $perPage;

        if (isset($inputs['form-search']) && $inputs['form-search'] != '') {

            $inputs = array_filter($inputs);

            unset($inputs['_token']);



            $data = (new Enquiry)->getEnquiry($inputs, $start, $perPage);



            $totalnews = (new Enquiry)->totalEnquiry($inputs);

            $total = $totalnews->total;

        } else {

            $data = (new Enquiry)->getEnquiry($inputs, $start, $perPage);

            $totalnews = (new Enquiry)->totalEnquiry($inputs);

            $total = $totalnews->total;

        }

        return view('admin.enquiry.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));

    }



}