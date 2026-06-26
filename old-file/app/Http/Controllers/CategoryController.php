<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Group;

class CategoryController extends Controller
{
    public function index()
    {
        $statuses = [
            '1'=>'Active',
            '2'=>'Non-active',
            ''=>'All',
        ];
        $groups = (new Group)->pluckAllGroups();
        return view('admin.category.index', compact('statuses', 'groups'));
    }

    public function  create()
    {	
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        try{
            $inputs = $request->all();
            $validator = (new Category)->validate($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }

            $slug = $inputs['slug'];//strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $inputs['name'])));

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
                'parent_id'    => 0,
                'slug'	=>	$slug,
                'image'  =>  $image,
              //  'img_alt' => $inputs['img_alt'],
            ];
            //dd($inputs);
            (new Category)->store($inputs);
            return redirect()->route('category.index')
                ->with('success', lang('messages.created', lang('category.category')));
        }
        catch (\Exception $exception) {
            //dd($exception);
            return redirect()->route('category.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

    public function categoryPaginate(Request $request, $pageNumber = null)
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

            $data = (new Category)->getCategory($inputs, $start, $perPage);

            $totalnews = (new Category)->totalCategory($inputs);
            $total = $totalnews->total;
        } else {
            $data = (new Category)->getCategory($inputs, $start, $perPage);
            //dd($data);
            $totalnews = (new Category)->totalCategory($inputs);
            $total = $totalnews->total;
        }
        return view('admin.category.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

    public function categoryToggle($id = null)
    {
         if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }

        try {
            $category = Category::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('category.category')));
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
        return view('admin.category.create', compact('result'));
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
                unset($inputs['image']);
                $inputs['image'] = $fileName;
            }

            /*$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $inputs['name'])));
            $category = Category::where('slug', $slug)->where('id', '!=', $id)->first();
            if(isset($category)){
            	$latest_cat = Category::where('id', '!=', $id)->orderBy('id', 'desc')->first();
            	$cat_name = $inputs['name'] . '-' . $latest_cat['id'];
            	$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cat_name)));
            }*/
            $inputs = $inputs + [
                'updated_by' => \Auth::user()->id,
                /*'slug' => $slug*/
            ];
            (new Category)->store($inputs, $id);    
            return redirect()->route('category.index')
                ->with('success', lang('messages.updated', lang('category.category')));

        } catch (\Exception $exception) {
            return redirect()->route('category.edit', [$id])
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
             $response = ['status' => 1, 'message' => lang('messages.deleted', lang('category.category'))];
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

    public function importCategoryStore(Request $request)
    {
        try{
            if($request->has('file') && isset($request->file))
            {
                $excelFile = $request->file('file');
                if(!in_array($excelFile->getClientOriginalExtension(), ['xls','xlsx'])){
                    return redirect()->route('upload_record_evidence', $inputs['record_id'])
                        ->withInput($inputs)
                        ->withErrors(['File must be in excel format']);
                }

                if($request->hasFile('file')){      
                    $errorReport = [];          
                    \Excel::load($excelFile, function($reader) use ($errorReport) {
                        $excelData = [];
                        $insertdata = [];
                        $excelData = $reader->all();
                        $firstrow = $reader->first()->toArray();
                        //dd($firstrow);

                        $validateCol = ['name', 'slug'];
                        
                        foreach ($validateCol as $k => $v) {
                            if(!array_key_exists($v, $firstrow)){
                                $errorReport[] = ['This '. str_replace("_"," ",string_manip($v,'UC')) . ' Field does\' exists in excel file.'];
                            }
                        }

                        if(!empty($errorReport)){
                            return redirect()->route('category_import')->withErrors($errorReport);
                        }
                        else{
                            foreach ($excelData->toArray() as $key => $value) {
                                if(!empty($value['name'])
                                ){
                                    $insertdata[] = array(
                                        'id' => $value['id'],
                                        'name' => $value['name'],
                                        'parent_id'    => isset($value['parent_id'])?$value['parent_id']:'',
                                        'slug'    => isset($value['slug'])?$value['slug']:'',
                                    );
                                }                  
                            } 
                            
                            (new Category)->multipleStore($insertdata);
                        }                   
                    });

                }

            }

            return back()->with('success', 'success');

        }
        catch(\Exception $e){
            dd($e);
            return back();
        }
    }

    public function getSubCategory(Request $request)
    {
        $sub_cats = Category::where('parent_id', $request->cat_id)->get();
        return view('admin.sub_sub_category.sub_cat', compact('sub_cats'));
    }


    public function getProdSubCat(Request $request)
    {
        $sub_cats = [];
        if($request->cat_id){
            $sub_cats = Category::whereIn('parent_id', $request->cat_id)->get();
        }
        return view('admin.product.sub_cats', compact('sub_cats'));
    }

    public function getProdSubSubCat(Request $request)
    {
        $sub_sub_cats = [];
        if($request->cat_id){
            $sub_sub_cats = Category::whereIn('parent_id', $request->cat_id)->get();
        }
        return view('admin.product.sub_sub_cats', compact('sub_sub_cats'));
    }

    //Category Image Path Change

    public function CatImgPathChange()
    {
        $cats = Category::whereNotNull('image')->get();
        foreach ($cats as $key => $value) {
            $inputs['image'] = str_replace('https://www.aticoexport.com/wp-content/uploads/2015/06/', '', $value->image);
            (new Category)->store($inputs, $value->id);
        }
        dd('dsfsdfs');
    }

    public function exportCategory()
    {
        $userData = Category::all();
        \Excel::create('Category', function($excel) use($userData) {

            $excel->sheet('user', function($sheet) use($userData) {


             $sheet->cell(1, function($row) { 
                $row->setBackground('#ee891b'); 
            });


                $excelData = [];
                $excelData[] = [
                    'Name',
                    'Short Name',
                    'Description',
                    'Slug',
                    'Status',
                    'Date',
                ];

                foreach ($userData as $key => $value) {
                    $excelData[] = [
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

    public function catNoProduct()
    {
        $categories = Category::where('parent_id',0)->where('status', 1)->select('id', 'name', 'slug')->get();
        foreach ($categories as $key => $cat) {
            $cat['sub_cats'] = Category::where('parent_id', $cat->id)->select('id', 'name', 'slug')->get();
            foreach ($cat['sub_cats'] as $key => $sub_cat) {
                if(count($sub_cat)>0){
                    $cat['sub_cat'] .= $sub_cat['name'] . ' OR ' . $sub_cat['slug'] . ' AND ';
                }
            }
            $product_cat_ids = ProductCategory::where('category_id', $cat->id)->pluck('product_id')->toArray();
            $products = Product::whereIn('id', $product_cat_ids)->select('name', 'slug', 'id')->get();
            foreach ($products as $key => $product) {
                if(count($product)>0){
                    $cat['product'] .= $product['name'] . ' OR ' . $product['slug'] . ' AND ';
                }   
            }
        }



        \Excel::create('Category', function($excel) use($categories) {

        $excel->sheet('user', function($sheet) use($categories) {


        $sheet->cell(1, function($row) { 
            $row->setBackground('#ee891b'); 
        });


        $excelData = [];
        $excelData[] = [
            'Category Name',
            'Category Slug',
            'Sub Category',
            'Products',
        ];

        foreach ($categories as $key => $value) {
            $excelData[] = [
                $value->name,
                $value->slug,
                $value->sub_cat,
                $value->product
            ];                    
        }

        $sheet->fromArray($excelData, null, 'A1', true, false);

        });

        })->download('xlsx');

    }

    public function catChangeStatus()
    {
        $categories = Category::where('parent_id',0)->select('id', 'name', 'slug')->get();
        foreach ($categories as $key => $cat) {
            $cat['sub_cats'] = Category::where('parent_id', $cat->id)->select('id', 'name', 'slug')->get();
            foreach ($cat['sub_cats'] as $key => $sub_cat) {
                if(count($sub_cat)>0){
                    $cat['sub_cat'] .= $sub_cat['name'] . ' OR ' . $sub_cat['slug'] . ' AND ';
                }
            }
            $product_cat_ids = ProductCategory::where('category_id', $cat->id)->pluck('product_id')->toArray();
            $products = Product::whereIn('id', $product_cat_ids)->where('status', 1)->select('name', 'slug', 'id')->get();
            foreach ($products as $key => $product) {
                if(count($product)>0){
                    $cat['product'] .= $product['name'] . ' OR ' . $product['slug'] . ' AND ';
                }   
            }
        }
        $new = [];
        foreach ($categories as $key => $value) {
            if(!isset($value['sub_cat']) && !isset($value['product'])){
                Category::where('id', $value->id)->update(['status'=>0]);
            }
        }
        dd('dsfsdf');

    }

    public function categoryProduct()
    {
        try{
            $cat_ids = Category::where('parent_id', 0)->where('status', 1)->pluck('id')->toArray();
            $cat_products = ProductCategory::whereIn('category_id', $cat_ids)->pluck('product_id')->toArray();

            $sub_cat_ids = Category::whereIn('parent_id', $cat_ids)->where('status', 1)->pluck('id')->toArray();

            $sub_cat_products = ProductCategory::whereIn('category_id', $sub_cat_ids)->pluck('product_id')->toArray();

            $sub_sub_cat_ids = Category::whereIn('parent_id', $sub_cat_ids)->where('status', 1)->pluck('id')->toArray();

            $sub_sub_cat_products = ProductCategory::whereIn('category_id', $sub_sub_cat_ids)->pluck('product_id')->toArray();
            $other_cat_products = array_merge($sub_cat_products, $sub_sub_cat_products);

            $ab = array_diff($cat_products, $other_cat_products);
            $products_cat = array_unique($ab);
            
            $cat_have_sb = Category::whereIn('parent_id', $cat_ids)->pluck('parent_id')->toArray();

            $cat_without_sub = array_diff($cat_ids, $cat_have_sb);
            

            $product_categories = ProductCategory::whereIn('product_id', $products_cat)->whereIn('category_id', $cat_have_sb)->pluck('category_id')->toArray();

            $new_product_categories = ProductCategory::whereIn('product_id', $products_cat)->whereIn('category_id', $cat_have_sb)->select('id', 'category_id', 'product_id')->orderBy('category_id')->get();


            $new_prod_cats = array_unique($product_categories);     


            foreach ($new_prod_cats as $key => $value) {
                    $sub_cat_name  = Category::find($value)->name . ' glassware equipment';

                    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $sub_cat_name)));

                    $category = Category::where('slug', $slug)->first();
                    if(isset($category)){
                        $latest_cat = Category::orderBy('id', 'desc')->first();
                        $cat_name = $sub_cat_name . '-' . $latest_cat['id'];
                        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cat_name)));
                    }

                   $catInputs = [
                    'name' => $sub_cat_name,
                    'slug' => $slug,
                    'created_by' => \Auth::user()->id,
                    'status'    => 1,
                    'parent_id'    => $value,
                   ];
                   (new Category)->store($catInputs);
               }   


               foreach ($new_product_categories as $key => $value) {
                   $new_sub_cat = Category::where('parent_id', $value->category_id)->orderBy('id', 'desc')->first();
                   $productCatInput = [
                    'product_id' => $value->product_id,
                    'category_id' => $new_sub_cat['id'],
                    'created_by' => \Auth::user()->id,
                    'status'    => 1,
                   ];
                   (new ProductCategory)->store($productCatInput);
               }
               dd('sdfsdf');
                

        }
        catch(\Exception $e){
            dd($e);
        }
    }

    public function replaceCatLine()
    {
        $categories = Category::where('name', 'LIKE', '%' . 'Manufacturer, Supplier &amp; Exporter in India' . '%')->get();

        foreach ($categories as $key => $value) {
            $name = str_replace('Manufacturer, Supplier &amp; Exporter in India', '', $value->name);
            Category::where('id', $value->id)->update(['name'=>$name]);
        }
        dd('fsfsd');
    }

    public function getDuplicateSlug()
    {
        $categories = Category::where('status', 1)->pluck('slug', 'id')->toArray();
        foreach ($categories as $key => $value) {
            $cat_slug = Category::where('slug', $value)->where('status', 1)->get();
            if(count($cat_slug) < 2){
                unset($categories[$key]);
            }
        }
        dd($categories);
    }

    public function deleteInActive()
    {
        Category::where('status', 0)->Forcedelete();
        dd('fsdfds');
    }

    public function getUnAllocated()
    {
        try{
            return view('admin.unallocated_category.index');
        }
        catch(\Exception $e){
            return back();
        }
    }

    public function unAllocatedCategoryPaginate(Request $request, $pageNumber = null)
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

            $data = (new Category)->getUnAllocatedCategory($inputs, $start, $perPage);

            $totalnews = (new Category)->totalUnAllocatedCategory($inputs);
            $total = $totalnews->total;
        } else {
            $data = (new Category)->getUnAllocatedCategory($inputs, $start, $perPage);
            //dd($data);
            $totalnews = (new Category)->totalUnAllocatedCategory($inputs);
            $total = $totalnews->total;
        }
        return view('admin.unallocated_category.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }


}

