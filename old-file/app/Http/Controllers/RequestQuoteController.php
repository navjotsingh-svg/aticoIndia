<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestQuote;

class RequestQuoteController extends Controller
{
    public function store(Request $request)
    {
    	try{
    		$inputs = $request->all();
    		$validator = (new RequestQuote)->validate($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }
            (new RequestQuote)->store($inputs);
            return back()->with('success', 'We have received your message. Thank you!');
    	}
    	catch(\Exception $e){
    		return back();
    	}
    }

    public function index()
    {
        return view('admin.request_quote.index');
    }

    public function requestQuotePaginate(Request $request, $pageNumber = null)
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

            $data = (new RequestQuote)->getRequestQuote($inputs, $start, $perPage);

            $totalnews = (new RequestQuote)->totalRequestQuote($inputs);
            $total = $totalnews->total;
        } else {
            $data = (new RequestQuote)->getRequestQuote($inputs, $start, $perPage);
            $totalnews = (new RequestQuote)->totalRequestQuote($inputs);
            $total = $totalnews->total;
        }
        return view('admin.request_quote.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

}
