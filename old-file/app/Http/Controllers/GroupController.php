<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Group;
use App\Models\GroupCategory;

class GroupController extends Controller
{
    public function index()
    {
        return view('admin.group.index');
    }

    public function  create()
    {	
        $cats = Category::leftjoin('categories as sub', 'categories.id', '=', 'sub.parent_id')->where('categories.status', '1')->where('categories.parent_id', 0)->orderBy('categories.name')->pluck('categories.name', 'categories.id')->toArray();
        $group_cats = [];
        return view('admin.group.create', compact('cats', 'group_cats'));
    }

    public function store(Request $request)
    {
        try{
            $inputs = $request->all();
            $validator = (new Group)->validate($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }
         
            $inputs = $inputs + [
                'created_by' => \Auth::user()->id,
                'status'    => 1,
            ];
            $group_id = (new Group)->store($inputs);

            for ($i=0; $i < count($inputs['category_id']); $i++) { 
                $groupCat = [
                    'group_id' => $group_id,
                    'category_id' => $inputs['category_id'][$i],
                ];
                (new GroupCategory)->store($groupCat);
            }

            return redirect()->route('group.index')
                ->with('success', lang('messages.created', lang('group.group')));
        }
        catch (\Exception $exception) {
            //dd($exception);
            return redirect()->route('group.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

    public function groupPaginate(Request $request, $pageNumber = null)
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

            $data = (new Group)->getGroup($inputs, $start, $perPage);

            $totalnews = (new Group)->totalGroup($inputs);
            $total = $totalnews->total;
        } else {
            $data = (new Group)->getGroup($inputs, $start, $perPage);
            //dd($data);
            $totalnews = (new Group)->totalGroup($inputs);
            $total = $totalnews->total;
        }
        return view('admin.group.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

    public function groupToggle($id = null)
    {
         if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }

        try {
            $group = Group::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('group.group')));
        }

        $group->update(['status' => !$group->status]);
        $response = ['status' => 1, 'data' => (int)$group->status . '.gif'];
        // return json response
        return json_encode($response);
    }

    public function edit($id = null)
    {
        $result = (new Group)->find($id);
        if (!$result) {
            abort(401);
        }
        $cats = Category::leftjoin('categories as sub', 'categories.id', '=', 'sub.parent_id')->where('categories.status', '1')->where('categories.parent_id', 0)->orderBy('categories.name')->pluck('categories.name', 'categories.id')->toArray();
        $group_cats = GroupCategory::where('group_id', $id)->pluck('category_id')->toArray();
        return view('admin.group.create', compact('result', 'cats', 'group_cats'));
    }

    public function update(Request $request, $id = null)
    {
        $result = (new Group)->find($id);
        if (!$result) {
            abort(401);
        }

        try {
            $inputs = $request->all();
            $validator = (new Group)->validate($inputs, $id);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }

          
            $inputs = $inputs + [
                'updated_by' => \Auth::user()->id
            ];
            (new Group)->store($inputs, $id);    

            GroupCategory::where('group_id', $id)->delete();

            for ($i=0; $i < count($inputs['category_id']); $i++) { 
                $groupCat = [
                    'group_id' => $id,
                    'category_id' => $inputs['category_id'][$i],
                ];
                (new GroupCategory)->store($groupCat);
            }

            return redirect()->route('group.index')
                ->with('success', lang('messages.updated', lang('group.group')));

        } catch (\Exception $exception) {
            return redirect()->route('group.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }

   
    
    public function drop($id)
    {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }

        $result = (new Group)->find($id);
        if (!$result) {
            // use ajax return response not abort because ajaz request abort not works
            abort(401);
        }

        try {
            // get the unit w.r.t id
             $result = (new Group)->find($id);
          
             (new Group)->permanentlyDelete($id);
             $response = ['status' => 1, 'message' => lang('messages.deleted', lang('group.group'))];
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }



}

