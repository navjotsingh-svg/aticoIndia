<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductReview;


class ProductReviewController extends Controller
{
    public function index()
    {
        return view('admin.product_review.index');
    }

    public function productReviewPaginate(Request $request, $pageNumber = null)
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

            $data = (new ProductReview)->getProductReview($inputs, $start, $perPage);
            $totalGameMaster = (new ProductReview)->totalProductReview($inputs);
            $total = $totalGameMaster->total;
        } else {

            $data = (new ProductReview)->getProductReview($inputs, $start, $perPage);
            //dd($data);
            $totalGameMaster = (new ProductReview)->totalProductReview();
            $total = $totalGameMaster->total;
        }

        return view('admin.product_review.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

    public function productReviewToggle($id = null)
    {
         if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }

        try {
            $game = ProductReview::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('product_review.product_review')));
        }

        $game->update(['status' => !$game->status]);
        $response = ['status' => 1, 'data' => (int)$game->status . '.gif'];
        // return json response
        return json_encode($response);
    }


    public function drop($id)
    {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }

        $result = (new ProductReview)->find($id);
        if (!$result) {
            // use ajax return response not abort because ajaz request abort not works
            abort(401);
        }

        try {
            // get the unit w.r.t id
             $result = (new ProductReview)->find($id);
          
             (new ProductReview)->permanentlyDelete($id);
             $response = ['status' => 1, 'message' => lang('messages.deleted', lang('product_review.product_review'))];
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }



    



}
