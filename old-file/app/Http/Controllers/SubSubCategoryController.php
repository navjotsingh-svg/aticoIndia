<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\Product;

class SubSubCategoryController extends Controller
{
    public function index()
    {
        $statuses = [
            '1'=>'Active',
            '2'=>'Non-active',
            ''=>'All',
        ];
        $categories = (new Category)->pluckAllParentCats();
        return view('admin.sub_sub_category.index', compact('statuses', 'categories'));
    }

    public function  create()
    {	
    	$categories = (new Category)->pluckCategoriesWithSub();
        return view('admin.sub_sub_category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try{
            $inputs = $request->all();
            $validator = (new Category)->validateSub($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $inputs['name'])));
            $category = Category::where('slug', $slug)->first();
            if(isset($category)){
            	$latest_cat = Category::orderBy('id', 'desc')->first();
            	$cat_name = $inputs['name'] . '-' . $latest_cat['id'];
            	$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cat_name)));
            }

            if(isset($inputs['image']) or !empty($inputs['image']))
            {
                $image_name = rand(100000, 999999);
                $fileName = '';
                if($file = $request->hasFile('image')) 
                {
                    $file = $request->file('image') ;
                    $img_name = $file->getClientOriginalName();
                    $fileName = $image_name.$img_name;
                    $destinationPath = public_path().'/uploads/product_images/' ;
                    $file->move($destinationPath, $fileName);
                }
                $image = $fileName;
            }
            else{
                $image = null;
            }

	        unset($inputs['image']);
            $inputs = $inputs + [
                'created_by' => \Auth::user()->id,
                'status'    => 1,
                'slug'	=>	$slug,
                'image'  =>  $image
            ];
            //dd($inputs);
            (new Category)->store($inputs);
            return redirect()->route('sub_sub_category.index')
                ->with('success', lang('messages.created', lang('sub_sub_category.sub_sub_category')));
        }
        catch (\Exception $exception) {
            return redirect()->route('sub_sub_category.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

    public function subSubCategoryPaginate(Request $request, $pageNumber = null)
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

            $data = (new Category)->getSubSubCategory($inputs, $start, $perPage);

            $totalnews = (new Category)->totalSubSubCategory($inputs);
            $total = $totalnews->total;
        } else {
            $data = (new Category)->getSubSubCategory($inputs, $start, $perPage);
            //dd($data);
            $totalnews = (new Category)->totalSubSubCategory($inputs);
            $total = $totalnews->total;
        }
        return view('admin.sub_sub_category.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

    public function subSubCategoryToggle($id = null)
    {
         if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }

        try {
            $category = Category::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('sub_sub_category.sub_sub_category')));
        }

        $category->update(['status' => !$category->status]);
        $response = ['status' => 1, 'data' => (int)$category->status . '.gif'];
        // return json response
        return json_encode($response);
    }

    public function edit($id = null)
    {
        $result = (new Category)->find($id);
        if (!$result) {
            abort(401);
        }
        $cat = Category::where('id', $result['parent_id'])->first();
        $cats = Category::where('parent_id', $cat['parent_id'])->get();
        return view('admin.sub_sub_category.create', compact('result', 'cats'));
    }

    public function update(Request $request, $id = null)
    {
        $result = (new Category)->find($id);
        if (!$result) {
            abort(401);
        }

        try {
            $inputs = $request->all();
            $validator = (new Category)->validate($inputs, $id);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }

            if(isset($inputs['image']) or !empty($inputs['image']))
            {
            	$image_name = rand(100000, 999999);
	            $fileName = '';
	            if($file = $request->hasFile('image')) 
	            {
	                $file = $request->file('image') ;
	                $img_name = $file->getClientOriginalName();
	                $fileName = $image_name.$img_name;
	                $destinationPath = public_path().'/uploads/product_images/' ;
	                $file->move($destinationPath, $fileName);
	            }
	            $image = $fileName;
            }
            else{
            	$image = $result['image'];
            }

           /* $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $inputs['name'])));
            $category = Category::where('slug', $slug)->where('id', '!=', $id)->first();
            if(isset($category)){
            	$latest_cat = Category::where('id', '!=', $id)->orderBy('id', 'desc')->first();
            	$cat_name = $inputs['name'] . '-' . $latest_cat['id'];
            	$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cat_name)));
            }*/

            unset($inputs['image']);
            $inputs = $inputs + [
                'updated_by' => \Auth::user()->id,
                'image'	=>	$image,
                /*'slug' => $slug*/
            ];
            (new Category)->store($inputs, $id);
            return redirect()->route('sub_sub_category.index')
                ->with('success', lang('messages.updated', lang('sub_sub_category.sub_sub_category')));

        } catch (\Exception $exception) {
            return redirect()->route('sub_sub_category.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }

   
    
    public function drop($id)
    {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }

        $result = (new Category)->find($id);
        if (!$result) {
            // use ajax return response not abort because ajaz request abort not works
            abort(401);
        }

        try {
            // get the unit w.r.t id
             $result = (new Category)->find($id);
          
             (new Category)->permanentlyDelete($id);
             $response = ['status' => 1, 'message' => lang('messages.deleted', lang('sub_sub_category.sub_sub_category'))];
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }

    public function importCategories()   
    {
        return view('admin.category.import');
    }


    public function exportSubSubCategory()
    {
        $userData = Category::join('categories as cat', 'categories.parent_id', 'cat.id')
            ->join('categories as main_cat', 'cat.parent_id', 'main_cat.id')
            ->where('main_cat.parent_id', '=', 0)
            ->select('categories.id','categories.name','categories.slug',
             'categories.status','cat.name as cat_name',
             'main_cat.name as main_cat_name', 'categories.created_at', 'categories.short_name', 'categories.description')->get();
        \Excel::create('Sub-Sub-Category', function($excel) use($userData) {

            $excel->sheet('user', function($sheet) use($userData) {


             $sheet->cell(1, function($row) { 
                $row->setBackground('#ee891b'); 
            });


                $excelData = [];
                $excelData[] = [
                    'Category',
                    'Sub Category',
                    'Sub Sub Category',
                    'Short Name',
                    'Description',
                    'Slug',
                    'Status',
                    'Date',
                ];

                foreach ($userData as $key => $value) {
                    $excelData[] = [
                        $value->main_cat_name,
                        $value->cat_name,
                        $value->name,
                        $value->short_name,
                        strip_tags($value->description),
                        $value->slug,
                        $value->status,
                        $value->created_at
                    ];                    
                }

                $sheet->fromArray($excelData, null, 'A1', true, false);

            });

        })->download('xlsx');

    }



    public function subSubCatNoProduct()
    {
        $categories = Category::join('categories as cat', 'categories.parent_id', 'cat.id')
            ->join('categories as main_cat', 'cat.parent_id', 'main_cat.id')
            ->where('main_cat.parent_id', '=', 0)
            ->where('categories.status', 1)
            ->select('categories.id','categories.name','categories.slug','categories.status','cat.name as cat_name','main_cat.name as main_cat_name', 'main_cat.slug as main_cat_slug', 'cat.slug as cat_slug')->get();


        foreach ($categories as $key => $cat) {            
            $product_cat_ids = ProductCategory::where('category_id', $cat->id)->pluck('product_id')->toArray();
            $products = Product::whereIn('id', $product_cat_ids)->select('name', 'slug', 'id')->get();
            foreach ($products as $key => $product) {
                if(count($product)>0){
                    $cat['product'] .= $product['name'] . ' OR ' . $product['slug'] . ' AND ';
                }   
            }
        }

            \Excel::create('Sub Sub Category', function($excel) use($categories) {

            $excel->sheet('user', function($sheet) use($categories) {


             $sheet->cell(1, function($row) { 
                $row->setBackground('#ee891b'); 
            });


                $excelData = [];
                $excelData[] = [
                    'Sub Sub Category Name',
                    'Sub Sub Category Slug',
                    'Category Name',
                    'Category Slug',
                    'Sub Category Name',
                    'Sub Category Slug',
                    'Products'
                ];

                foreach ($categories as $key => $value) {
                    $excelData[] = [
                        $value->name,
                        $value->slug,
                        $value->main_cat_name,
                        $value->main_cat_slug,
                        $value->cat_name,
                        $value->cat_slug,
                        $value->product
                    ];                    
                }

                $sheet->fromArray($excelData, null, 'A1', true, false);

            });

        })->download('xlsx');

    }

    public function subSubCatChangeStatus()
    {
        $categories = Category::join('categories as cat', 'categories.parent_id', 'cat.id')
            ->join('categories as main_cat', 'cat.parent_id', 'main_cat.id')
            ->where('main_cat.parent_id', '=', 0)
            ->select('categories.id','categories.name','categories.slug','categories.status','cat.name as cat_name','main_cat.name as main_cat_name', 'main_cat.slug as main_cat_slug', 'cat.slug as cat_slug')->get();


        foreach ($categories as $key => $cat) {            
            $product_cat_ids = ProductCategory::where('category_id', $cat->id)->pluck('product_id')->toArray();
            $products = Product::whereIn('id', $product_cat_ids)->select('name', 'slug', 'id')->get();
            foreach ($products as $key => $product) {
                if(count($product)>0){
                    $cat['product'] .= $product['name'] . ' OR ' . $product['slug'] . ' AND ';
                }   
            }
        }

        //$new = [];
        foreach ($categories as $key => $value) {
            if(!isset($value['product'])){
                //$new[] .= $value['id'];
                Category::where('id', $value->id)->update(['status'=>0]);
            }
        }
        dd('fsdfsdff');

    }

   
}
