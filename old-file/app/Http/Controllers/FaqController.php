<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        return view('admin.faq.index');
    }

    public function  create()
    {	
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        try{
            $inputs = $request->all();
            $validator = (new Faq)->validate($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }
        
            $inputs = $inputs + [
                'created_by' => \Auth::user()->id,
                'status'    => 1
            ];
            (new Faq)->store($inputs);
            return redirect()->route('faq.index')
                ->with('success', lang('messages.created', lang('faq.faq')));
        }
        catch (\Exception $exception) {
            return redirect()->route('faq.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

    public function FaqPaginate(Request $request, $pageNumber = null)
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

            $data = (new Faq)->getFaq($inputs, $start, $perPage);

            $totalnews = (new Faq)->totalFaq($inputs);
            $total = $totalnews->total;
        } else {
            $data = (new Faq)->getFaq($inputs, $start, $perPage);
            //dd($data);
            $totalnews = (new Faq)->totalFaq($inputs);
            $total = $totalnews->total;
        }
        return view('admin.faq.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

    public function FaqToggle($id = null)
    {
         if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }

        try {
            $rule = Faq::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('faq.faq')));
        }

        $rule->update(['status' => !$rule->status]);
        $response = ['status' => 1, 'data' => (int)$rule->status . '.gif'];
        // return json response
        return json_encode($response);
    }

    public function edit($id = null)
    {
        $result = (new Faq)->find($id);
        if (!$result) {
            abort(401);
        }
        return view('admin.faq.create', compact('result'));
    }

    public function update(Request $request, $id = null)
    {
        $result = (new Faq)->find($id);
        if (!$result) {
            abort(401);
        }

        try {
            $inputs = $request->all();
            $validator = (new Faq)->validate($inputs, $id);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }


            $inputs = $inputs + [
                'updated_by' => \Auth::user()->id
            ];
            (new Faq)->store($inputs, $id);
            return redirect()->route('faq.index')
                ->with('success', lang('messages.updated', lang('faq.faq')));

        } catch (\Exception $exception) {
            return redirect()->route('faq.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }

    public function drop($id)
    {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }

        $result = (new Faq)->find($id);
        if (!$result) {
            // use ajax return response not abort because ajaz request abort not works
            abort(401);
        }

        try {
            // get the unit w.r.t id
             $result = (new Faq)->find($id);
          
             (new Faq)->permanentlyDelete($id);
             $response = ['status' => 1, 'message' => lang('messages.deleted', lang('faq.faq'))];
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }




}

