<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductReview;

class ProductReviewController extends Controller
{
    public function store(Request $request)
    {
        validator($request->all(), [
            'review' => 'required',
            'rating' => 'required',
            'name' => 'required',
            'email' => 'required',
           
        ])->validate();
    	try{
    		$inputs = $request->all();
            $inputs = $inputs + [	
                'status' => 0,
            ];          
            (new ProductReview)->store($inputs);         
            return response(['message' => trans('common.created', ['attribute' => 'Product Review'])], 200);

            //return back()->with('success', 'record successfully submitted.');
    	}
    	catch(\Exception $e){
            //dd($e);
    		return back();
    	}
    }
}
