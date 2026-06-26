<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SidebarCategory;
use App\Models\Category;

class SidebarCategoryController extends Controller
{
    public function  create()
    {
    	$sidebar_category = SidebarCategory::first();
        $cats = Category::leftjoin('categories as sub', 'categories.id', '=', 'sub.parent_id')->where('categories.status', '1')->where('categories.parent_id', 0)->orderBy('categories.name')->pluck('categories.name', 'categories.id')->toArray();
        $group_cats = SidebarCategory::pluck('category_id')->toArray();
        return view('admin.sidebar_category.create', compact('sidebar_category', 'cats', 'group_cats'));
    }

    public function  store(Request $request)
    {
        $inputs = $request->all();

        try 
        {
        	$sidebar_category = SidebarCategory::all();
        	if(count($sidebar_category)>0){
                SidebarCategory::truncate();
            	$validator = (new SidebarCategory)->validate($inputs);
        	}
        	else{
        		$validator = (new SidebarCategory)->validate($inputs);	
        	}

            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }

            for ($i=0; $i < count($inputs['category_id']); $i++) { 
                $groupCat = [
                    'category_id' => $inputs['category_id'][$i],
                    'created_by' => \Auth::User()->id,
                    'updated_by' => \Auth::User()->id,
                ];
                (new SidebarCategory)->store($groupCat);
            }
       
            return redirect()->route('sidebar_category.create')
                ->with('success', lang('messages.created', lang('sidebar_category.sidebar_category')));
        } catch (\Exception $exception) {
            dd($exception);
            return redirect()->route('sidebar_category.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

}
