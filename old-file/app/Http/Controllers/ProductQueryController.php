<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductQuery;
use App\Models\Product;

class ProductQueryController extends Controller
{
    public function store(Request $request)
    {
    	try{
    		$inputs = $request->all();
    		$validator = (new ProductQuery)->validate($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }
            $id = (new ProductQuery)->store($inputs);

            $query = ProductQuery::find($id);
            $product = Product::find($query['product_id']);
            $data = [
                'product' => $product['name'],
                'name' => $query['name'],
                'email' => $query['email'],
                'country' => $query['country'],
                'phone_number' => $query['phone_number'],
                'quantity' => $query['quantity'],
                'page_url' => $request['page_url'],
                'ip_address' => $request['ip_address'],
                'massage' => $query['message']
            ];
            //dd($data);

            $email = $query['email'];
            // if($email){
            //     \Mail::send('frontend.emails.product_query', $data, function($message) use ($email){
            //         $message->from('sales@aticoindia.com');
            //         $message->to($email);
            //         $message->subject('Product Query Submitted');
            //     });    
            // }

            // if($email){
            //     \Mail::send('frontend.emails.product_query', $data, function($message) use ($email){
            //         $message->from('enquiry@tejcargopackersandmovers.com');
            //         $message->to('sales@aticoindia.com');
            //         $message->subject('Product Query Received');
            //     });    
            // }
            if($email){
                \Mail::send('frontend.emails.product_query', $data, function($message) use ($email,$query){
                    $message->from('sales@aticoindia.com',$query['name']);
                    $message->to('sales@aticoindia.com');
                    $message->subject('Product Query Received');
                });    
            }


            return back()->with('success', 'We have received your message. Thank you!');
    	}
    	catch(\Exception $e){
            dd($e);
    		return back();
    	}

        $request->validate([
            // Your other validation rules here
            'captcha' => ['required', 'integer', 'in:' . $request->session()->get('math_captcha')],
        ]);
        
    }
    public function showForm()
{
    return view('frontend.home')->with([
        'num1' => rand(1, 10),
        'num2' => rand(1, 10),
    ]);
}
public function destroy($id)
    {
        try {
            $productQuery = ProductQuery::findOrFail($id);
            $productQuery->delete();

            return redirect()->route('product_query.index')->with('success', 'Product query deleted successfully.');
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return redirect()->route('product_query.index')->with('error', 'Failed to delete product query.');
        }
    }
     public function get_quote(Request $request)
    {
    	try{
    		$inputs = $request->all();
    		$validator = (new ProductQuery)->validate3($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }
            
            $fileUrl = '';
        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('files'), $filename); // Move file to public folder

            

            $fileUrl = '/files/' . $filename; // Relative path of the stored file

            $inputs['file_name'] = $fileUrl;

        }
            $email = $request['email'];
            $data = [
                'name' => $request['name'],
                'email' => $request['email'],
                'country' => $request['country'],
                'phone_number' => $request['phone_number'],
                'massage' => $request['message'],
                'page_url' => $request['page_url'],
                'ip_address' => $request['ip_address'],
                 'file_name' => $fileUrl
            ];
            
            // if($email){
            //     \Mail::send('frontend.emails.product_query4', $data, function($message) use ($email){
            //         $message->from('sales@aticoindia.com');
            //         $message->to($email);
            //         $message->subject('Get Free Quote Submitted');
            //     });    
            // }
            //sales@aticoindia.com

            /*if($email){
                \Mail::send('frontend.emails.product_query4', $data, function($message) use ($email){
                    $message->from($email);
                    $message->to('teampoison90507@gmail.com');
                    $message->subject('Get Free Quote Received');
                });    
            }*/

             if($email){
                \Mail::send('frontend.emails.product_query1', $data, function($message) use ($request){
                     $message->from('sales@aticoindia.com',$request['name']);
                    $message->to('sales@aticoindia.com');
                    $message->subject('Product Query Received');
                });    
            }

            // if($email){
            //     \Mail::send('frontend.emails.product_query4', $data, function($message) use ($email){
            //         $message->from($email);
            //         $message->to('teampoison90507@gmail.com');
            //         $message->subject('Get Free Quote Received');
            //     });    
            // }
            
            \Session::start();
            \Session::put('message_reg', 'message_reg');

            return back()->with('success', 'We have received your message. Thank you!');
          
            
    	}
    	catch(\Exception $e){
            dd($e);
    		return back();
    	}

        
    }
    
   public function send_enquiry(Request $request)
{
    try {
        $inputs = $request->all();

        // Add debug statement to check if inputs are being received
  

        $validator = (new ProductQuery)->validate($inputs);

        // Add debug statement to check if validator is runnin
        if ($validator->fails()) {
        
            return back()->withErrors($validator)->withInput();
        }



        $email = $request['email'];
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'country' => $request['country'],
            'phone_number' => $request['phone_number'],
            'page_url' => $request['page_url'],
            'ip_address' => $request['ip_address'],
            'massage' => $request['message']
        ];

        if ($email) {
            \Mail::send('frontend.emails.product_query1', $data, function ($message) use ($email) {
                $message->from($email);
                $message->to('mvikrant@aol.com');
                $message->subject('Product Query Received');
            });
        }

        if ($email) {
            \Mail::send('frontend.emails.product_query1', $data, function ($message) use ($email) {
                $message->from($email);
                $message->to('mvikrant@aol.com');
                $message->subject('Product Query Received');
            });
        }
        



        return back()->with('success', 'We have received your message. Thank you!');
    } catch (\Exception $e) {
        // Log error message in console
        dd($e);
        return back();
    }
}


    public function index()
    {
        return view('admin.product_query.index');
    }

    public function productQueryPaginate(Request $request, $pageNumber = null)
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

            $data = (new ProductQuery)->getProductQuery($inputs, $start, $perPage);

            $totalnews = (new ProductQuery)->totalProductQuery($inputs);
            $total = $totalnews->total;
        } else {
            $data = (new ProductQuery)->getProductQuery($inputs, $start, $perPage);
            $totalnews = (new ProductQuery)->totalProductQuery($inputs);
            $total = $totalnews->total;
        }
        return view('admin.product_query.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

}
