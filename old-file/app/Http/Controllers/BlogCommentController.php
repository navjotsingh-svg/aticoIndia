<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogComment;

class BlogCommentController extends Controller
{
    public function store(Request $request)
    {
    	try{
    		$inputs = $request->all();
    		$validator = (new BlogComment)->validate($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }
            $inputs = $inputs + ['status'=>0];
            (new BlogComment)->store($inputs);
            return back()->with('success', 'We have received your comment. Thank you!');
    	}
    	catch(\Exception $e){
    		return back();
    	}
    }

    public function index()
    {
        return view('admin.blog_comment.index');
    }

    public function blogCommentPaginate(Request $request, $pageNumber = null)
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

            $data = (new BlogComment)->getBlogComment($inputs, $start, $perPage);

            $totalnews = (new BlogComment)->totalBlogComment($inputs);
            $total = $totalnews->total;
        } else {
            $data = (new BlogComment)->getBlogComment($inputs, $start, $perPage);
            $totalnews = (new BlogComment)->totalBlogComment($inputs);
            $total = $totalnews->total;
        }
        return view('admin.blog_comment.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

    public function blogCommentToggle($id = null)
    {
         if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }

        try {
            $blog_comment = BlogComment::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('blog_comment.blog_comment')));
        }

        $blog_comment->update(['status' => !$blog_comment->status]);
        $response = ['status' => 1, 'data' => (int)$blog_comment->status . '.gif'];
        // return json response
        return json_encode($response);
    }

    public function drop($id)
    {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }

        $result = (new BlogComment)->find($id);
        if (!$result) {
            // use ajax return response not abort because ajaz request abort not works
            abort(401);
        }

        try {
            // get the unit w.r.t id
             $result = (new BlogComment)->find($id);
          
             (new BlogComment)->permanentlyDelete($id);
             $response = ['status' => 1, 'message' => lang('messages.deleted', lang('blog_comment.blog_comment'))];
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }


}
