<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\ImportWord;
use App\Models\Product;
use App\Models\ProductOld;
use App\Models\ProductCodeOld;
use App\Models\Term;
use App\Models\TermTaxonomy;
use App\Models\Category;
use App\Models\TermMeta;
use App\Models\ProductCategory;
use App\Models\TermRelationship;

class ProductController extends Controller
{
    public function ProductImport()
    {
        return view('admin.product.product_import');
    }

    public function ProductWordUpload(Request $request)
    {
        $validator = (new Product)->validateProductImportFile($request->all());
        if( $validator->fails() ) {
            return back()->withErrors($validator)->withInput($request->all());
        }
        if ($request->has('file')) {
         try{
            $dataAr = ImportWord::import((String) $request->file);
            dd($dataAr);
            \DB::beginTransaction();
            foreach ($dataAr as $key => $question) {
                $validator = (new Product)->validateQuestionImport($question);
                if( $validator->fails() ) {
                    return back()->withErrors($validator)->withInput($question);
                }      
                if($question['english_language'] == "English"){
                    $category = Category::where('name', $question['category'])->where('status', '1')->first();
                    if(isset($category)){   
                        $category_id = $category['id'];
                        $level = Level::where('name', $question['level'])->where('status', '1')->where('category_id', $category_id)->first();
                        if(isset($level)){
                            $level_id = $level['id'];
                        }
                        else{
                            $levelInput = [
                                'name' => $question['level'],
                                'status' => 1,
                                'category_id' => $category_id,
                            ];
                            $level_id = (new Level)->store($levelInput);
                        }
                    }
                    else{
                        $level = Level::where('name', $question['level'])->first();
                        if(isset($level)){
                            $category_id = $level['category_id'];
                            $level_id = $level['id'];
                        }else{
                            $catInput = [
                                'name' => $question['category'],
                                'status' => 1,
                            ];
                            $category_id = (new Category)->store($catInput);
                            $levelStore = [
                                'category_id' => $category_id,
                                'name' =>  $question['level'],
                                'status' => 1
                            ];
                            $level_id = (new Level)->store($levelStore);
                        }
                    }

                    $inputs = [
                        'question_type_id' => '1',
                        'category_id' => $category_id,
                        'level_id' => $level_id,
                        'status' => 1,
                        'created_by' => \Auth::User()->id,
                        'question' => $question['english_question'],
                        'description' => isset($question['english_description']) ? $question['english_description'] : '',
                        'language_id' => 1,
                        'media' => 'import',
                    ];
                    $question_id = (new Product)->store($inputs);
                    $inputs = $inputs + [
                        'question_id' => $question_id,
                    ];
                    $question_language_id = (new ProductLanguage)->store($inputs);
                    /*dd('dfsfsa');*/
                    $inputs = $inputs + [
                        'question_language_id' => $question_language_id,
                    ];
                    foreach ($question['english_multiple_answer'] as $key => $eng_multiple_answer) {
                        $inputs = $inputs + [
                            'multiple_answer' => $eng_multiple_answer,
                            'right_answer'    =>  '0'
                        ];
                        (new EnglishMultipleAnswer)->store($inputs);
                        unset($inputs['multiple_answer']); 
                    }

                    $eng_mult_answers = EnglishMultipleAnswer::where('question_language_id', $question_language_id)->get();
                    $eng_ans_id = $question['english_right_answer'] - 1;
                    EnglishMultipleAnswer::where('id', $eng_mult_answers[$eng_ans_id]['id'])->update(['right_answer' => '1']);
                } 

                if($question['hindi_language'] == "Hindi")
                {
                    if(!isset($inputs['question_id'])){
                        $category = Category::where('name', $question['category'])->where('status', '1')->first();

                        $category = Category::where('name', $question['category'])->where('status', '1')->first();
                        if(isset($category)){   
                            $category_id = $category['id'];
                            $level = Level::where('name', $question['level'])->where('status', '1')->where('category_id', $category_id)->first();
                            if(isset($level)){
                                $level_id = $level['id'];
                            }
                            else{
                                $levelInput = [
                                    'name' => $question['level'],
                                    'status' => 1,
                                    'category_id' => $category_id,
                                ];
                                $level_id = (new Level)->store($levelInput);
                            }
                        }
                        else{
                            $level = Level::where('name', $question['level'])->first();
                            if(isset($level)){
                                $category_id = $level['category_id'];
                                $level_id = $level['id'];
                            }else{
                                $catInput = [
                                    'name' => $question['category'],
                                    'status' => 1,
                                ];
                                $category_id = (new Category)->store($catInput);
                                $levelStore = [
                                    'category_id' => $category_id,
                                    'name' =>  $question['level'],
                                    'status' => 1
                                ];
                                $level_id = (new Level)->store($levelStore);
                            }
                        }


                        $inputs = [
                            'question_type_id' => '1',
                            'category_id' => $category_id,
                            'level_id' => $level_id,
                            'status' => 1,
                            'created_by' => \Auth::User()->id,
                        ];
                        $question_id = (new Product)->store($inputs);
                        $inputs = $inputs + [
                            'question_id' => $question_id,
                        ];
                    }
                    //dd($inputs['question_id']);
                    unset($inputs['question_type_id']);
                    unset($inputs['question']);
                    unset($inputs['description']);
                    unset($inputs['language_id']);
                    unset($inputs['question_language_id']);
                    unset($inputs['right_answer']);

                    $inputs = $inputs + [
                        'language_id' => '2',
                        'question' => $question['hindi_question'],
                        'description' => isset($question['hindi_description']) ? $question['hindi_description'] : '',
                    ];
                    //dd($inputs);
                    $question_language_id = (new ProductLanguage)->store($inputs);
                    $inputs = $inputs + [
                        'question_language_id' => $question_language_id,
                        'right_answer'  =>  0,
                    ];

                    foreach ($question['hindi_multiple_answer'] as $key => $hin_multiple_answer) {
                        $inputs = $inputs + [
                            'multiple_answer' => $hin_multiple_answer,
                            'right_answer'    =>  '0'
                        ];
                        (new HindiMultipleAnswer)->store($inputs);
                        unset($inputs['multiple_answer']); 
                    }

                    $hin_mult_answers = HindiMultipleAnswer::where('question_language_id', $question_language_id)->get();
                    $hin_ans_id = $question['hindi_right_answer'] - 1;
                    HindiMultipleAnswer::where('id', $hin_mult_answers[$hin_ans_id]['id'])->update(['right_answer' => '1']);
                   
                    unset($inputs['category_id']);
                    unset($inputs['level_id']);
                    unset($inputs['status']);
                    unset($inputs['created_by']);
                    unset($inputs['question_id']);
                    unset($inputs['language_id']);
                    unset($inputs['question']);
                    unset($inputs['description']);
                    unset($inputs['question_language_id']);
                    unset($inputs['right_answer']);
                }   
            }
            \DB::commit();
            return redirect()->route('question.index')
                    ->with('success', lang('messages.created', lang('question.question')));
         }
         catch(\Exception $exception){
            //dd($exception); 
            \DB::rollBack();
            return back()->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
       }
    }

    public function getProductFromPrev()
    {
        $modelitem = new ProductOld;
        $modelitem->setConnection('mysql2');
        $ab = $modelitem->where('id', '>', '14999')->where('id', '<', '20000')->where('post_status', 'publish')->where('post_type', 'products')->get();
        //dd(count($ab));

        foreach ($ab as $key => $value) {
            $inputs = [
                'id' => $value->ID,
                'name' => $value->post_title,
                'description' => $value->post_content,
                'slug' => $value->post_name,
                'created_at' => $value->post_date,
                'updated_at' => $value->post_modified,
                'status' => 1
            ];
            (new Product)->store($inputs);
        }
        dd('gsdfgdf');
    }

    public function getProductImage()
    {
        $products_no_img = Product::whereNull('image')->pluck('id')->toArray();

        $modelitem = new ProductOld;
        $modelitem->setConnection('mysql2');

        $ab = $modelitem->whereIn('id', $products_no_img)->get();
        //dd($ab);
        //dd(count($ab));

        foreach ($ab as $key => $value) {
            $product_image = $modelitem->Where('post_title', 'like', '%' . $value->post_title . '%')->where('ID', '>', $value->ID)->first();
            if($product_image){
                dd($product_image);
                $inputs = [
                    'image' => $product_image['guid'],
                ];
                (new Product)->store($inputs, $value->ID);
            }
        }

        dd('gsdfgdf');
    }

    public function getProductCode()
    {
        $modelitem = new ProductCodeOld;
        $modelitem->setConnection('mysql2');
        $ab = $modelitem->where('meta_id', '>', '399999')->where('meta_id', '<', '1000000')->where('meta_key', 'sku')->get();
        //dd(count($ab));

        foreach ($ab as $key => $value) {
            $prod = Product::find($value->post_id);
            if($prod){
                $inputs = [
                    'product_code' => $value->meta_value,
                ];
                (new Product)->store($inputs, $value->post_id);
            }
        }
        dd('gsdfgdf');
    }

    public function getProductCategory()
    {
        try{
            $modelitem = new TermRelationship;
            $modelitem->setConnection('mysql2');
            $ab = $modelitem->where('object_id', '>', '14999')->where('object_id', '<', '20000')->get();
            //dd(count($ab));
            \DB::beginTransaction();
            foreach ($ab as $key => $value) {
                $prod = Product::find($value->object_id);
                if($prod){
                    $termTaxonomy = new TermTaxonomy;
                    $termTaxonomy->setConnection('mysql2');
                    $prd_cats = $termTaxonomy->where('term_taxonomy_id', $value->term_taxonomy_id)->get();
                    foreach ($prd_cats as $key => $cat) {
                        $inputs = [
                            'product_id' => $value->object_id,
                            'category_id' => $cat->term_id,
                        ];
                        (new ProductCategory)->store($inputs);
                        if($cat->parent != 0){
                            $prod_cat_exist = ProductCategory::where('product_id', $value->object_id)->where('category_id', $cat->parent)->first();
                            if(!$prod_cat_exist){
                                $inputsNew = [
                                    'product_id' => $value->object_id,
                                    'category_id' => $cat->parent,
                                ];
                                (new ProductCategory)->store($inputsNew);
                            }
                        }
                    }
                }
            }
            \DB::commit();
            dd('gsdfgdf');
        }
        catch(\Exception $e){
            \DB::rollBack(); 
            dd($e);
            return back();
        }
        
    }

    public function getCategories()
    {
        $modelitem = new Term;
        $modelitem->setConnection('mysql2');
        $ab = $modelitem->where('term_id', '>', 299)->where('term_id', '<', 1000)->get();

        foreach ($ab as $key => $value) {
            $inputs = [
                'id' => $value->term_id,
                'name' => $value->name,
                'slug' => $value->slug,
                'status' => 1
            ];
            (new Category)->store($inputs);
        }
        dd('gsdfgdf');
    }

    public function getCategoryDescription()
    {
        $modelitem = new TermTaxonomy;
        $modelitem->setConnection('mysql2');
        $ab = $modelitem->where('term_id', '>', 299)->where('term_id', '<', 1000)->get();

        foreach ($ab as $key => $value) {
            $prod = Category::find($value->term_id);
            if($prod){
                $inputs = [
                    'description' => $value->description,
                ];
                (new Category)->store($inputs, $value->term_id);
            }
        }
        dd('gsdfgdf');
    }

    public function getCategoryImage()
    {
        $modelitem = new TermMeta;
        $modelitem->setConnection('mysql2');
        $ab = $modelitem->where('meta_key', 'category_image')->get();
        //dd($ab);

        foreach ($ab as $key => $value) {
            $prod = Category::find($value->term_id);
            if($prod){
                $inputs = [
                    'image' => $value->meta_value,
                ];
                (new Category)->store($inputs, $value->term_id);
            }
        }
        dd('gsdfgdf');
    }

    public function getCategoryParentId()
    {
        $modelitem = new TermTaxonomy;
        $modelitem->setConnection('mysql2');
        $ab = $modelitem->where('term_id', '>', '299')->where('term_id', '<', '1000')->get();
        //dd($ab);

        foreach ($ab as $key => $value) {
            $prod = Category::find($value->term_id);
            if($prod){
                $inputs = [
                    'parent_id' => $value->parent,
                ];
                (new Category)->store($inputs, $value->term_id);
            }
        }
        dd('gsdfgdf');
    }

    public function index()
    {   
        return view('admin.product.index');
    }

    public function productPaginate(Request $request, $pageNumber = null)
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

            $data = (new Product)->getProduct($inputs, $start, $perPage);

            $totalnews = (new Product)->totalProduct($inputs);
            $total = $totalnews->total;
        } else {
            $data = (new Product)->getProduct($inputs, $start, $perPage);
            $totalnews = (new Product)->totalProduct($inputs);
            $total = $totalnews->total;
        }
        return view('admin.product.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

    public function productToggle($id = null)
    {
         if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }

        try {
            $category = Product::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('product.product')));
        }

        $category->update(['status' => !$category->status]);
        $response = ['status' => 1, 'data' => (int)$category->status . '.gif'];
        // return json response
        return json_encode($response);
    }

    public function drop($id)
    {
        if (!\Request::ajax()) {
            return lang('messages.server_error');
        }

        $result = (new Product)->find($id);
        if (!$result) {
            // use ajax return response not abort because ajaz request abort not works
            abort(401);
        }

        try {
            // get the unit w.r.t id
             $result = (new Product)->find($id);
          
             (new Product)->permanentlyDelete($id);
             $response = ['status' => 1, 'message' => lang('messages.deleted', lang('product.product'))];
        }
        catch (Exception $exception) {
            $response = ['status' => 0, 'message' => lang('messages.server_error')];
        }        
        // return json response
        return json_encode($response);
    }


    public function create()
    {   
        $cats = Category::leftjoin('categories as sub', 'categories.id', '=', 'sub.parent_id')->where('categories.status', '1')->where('categories.parent_id', 0)->orderBy('categories.name')->pluck('categories.name', 'categories.id')->toArray();
        return view('admin.product.create', compact('cats'));
    }

    public function store(Request $request)
    {
        try{
            $inputs = $request->all();
            $validator = (new Product)->validate($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }
            
            $slug =  $inputs['slug'];//strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $inputs['name'])));

            $product = Product::where('slug', $slug)->first();
            if(isset($product)){
                $latest_cat = Product::orderBy('id', 'desc')->first();
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
                'slug'  =>  $slug,
                'image'  =>  $image
            ];
            \DB::beginTransaction();
            $product_id = (new Product)->store($inputs);

            for ($i=0; $i < count($inputs['category_id']); $i++) { 
                $productCatInput = [
                    'product_id' => $product_id,
                    'category_id' => $inputs['category_id'][$i],
                ];
                (new ProductCategory)->store($productCatInput); 
                unset($productCatInput['category_id']);
            }
            \DB::commit();
            return redirect()->route('product.index')
                ->with('success', lang('messages.created', lang('product.product')));
        }
        catch (\Exception $exception) {
            \DB::rollBack();
            //dd($exception);
            return redirect()->route('product.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }


    public function edit($id = null)
    {
        $result = (new Product)->find($id);
        if (!$result) {
            abort(401);
        }

        $product_cats = ProductCategory::where('product_id', $id)->pluck('category_id')->toArray();
        $selected_cats = Category::whereIn('id', $product_cats)->where('parent_id', 0)->pluck('id')->ToArray();

        $selected_sub_cats = Category::whereIn('id', $product_cats)->whereIn('parent_id', $selected_cats)->pluck('id')->toArray();

        $selected_sub_sub_cats = Category::whereIn('id', $product_cats)->whereIn('parent_id', $selected_sub_cats)->pluck('id')->toArray();

        $cats = Category::leftjoin('categories as sub', 'categories.id', '=', 'sub.parent_id')->where('categories.status', '1')->where('categories.parent_id', 0)->orderBy('categories.name')->pluck('categories.name', 'categories.id')->toArray();
        //dd($cats);
        $sub_cats = Category::whereIn('parent_id', $selected_cats)->where('status', 1)->orderBy('name')->get();

        $sub_sub_cats = Category::whereIn('parent_id', $selected_sub_cats)->where('status', 1)->orderBy('name')->get();

        return view('admin.product.create', compact('result', 'cats', 'sub_cats', 'sub_sub_cats', 'product_cats'));
    }

    public function update(Request $request, $id = null)
    {
        $result = (new Product)->find($id);
        if (!$result) {
            abort(401);
        }

        try {
            $inputs = $request->all();
            $validator = (new Product)->validate($inputs, $id);
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

            $slug = $inputs['slug'];//strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $inputs['name'])));
            $category = Product::where('slug', $slug)->where('id', '!=', $id)->first();
            if(isset($category)){
                $latest_cat = Product::where('id', '!=', $id)->orderBy('id', 'desc')->first();
                $cat_name = $inputs['name'] . '-' . $latest_cat['id'];
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cat_name)));
            }

            $inputs = $inputs + [
                'updated_by' => \Auth::user()->id,
                //'slug' => $slug
            ];
            \DB::beginTransaction();
            (new Product)->store($inputs, $id);  

            ProductCategory::where('product_id', $id)->delete();

            for ($i=0; $i < count($inputs['category_id']); $i++) { 
                $productCatInput = [
                    'product_id' => $id,
                    'category_id' => $inputs['category_id'][$i],
                ];
                (new ProductCategory)->store($productCatInput); 
                unset($productCatInput['category_id']);
            }
            \DB::commit();
            return redirect()->route('product.index')
                ->with('success', lang('messages.updated', lang('product.product')));

        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->route('product.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }

    //Product Image Path Change

    public function ProductImgPathChange()
    {
        $products = Product::whereNotNull('image')->get();
        foreach ($products as $key => $value) {
            $inputs['image'] = str_replace('https://www.aticoexport.com/wp-content/uploads/2014/02/', '', $value->image);
            (new Product)->store($inputs, $value->id);
        }
        dd('dsfsdfs');
    }

    //Product Image Path Change VI

    public function ProductImgPathChangeVI()
    {
        $products = Product::whereNotNull('image')->Where('image', 'like', '%' . 'https://www.aticoexport.com' . '%')->get();

        $modelitem = new ProductOld;
        $modelitem->setConnection('mysql2');
       
        foreach ($products as $key => $value) {
            $prod_img = $modelitem->where('post_parent', $value->id)->where('post_type', 'attachment')->first();
            if($prod_img){
                Product::where('id', $value->id)->update(['image'=> $prod_img['guid']]);
            }
        }

        dd('fsdf');

    }

    public function exportProduct()
    {
        $userData = Product::all();
        \Excel::create('Product', function($excel) use($userData) {

            $excel->sheet('user', function($sheet) use($userData) {


             $sheet->cell(1, function($row) { 
                $row->setBackground('#ee891b'); 
            });


                $excelData = [];
                $excelData[] = [
                    'Product Name',
                    'Categories',
                    'Product Code',
                    'Slug',
                    'Description',
                    'Status',
                    'Date',
                ];

                foreach ($userData as $key => $value) {
                    $excelData[] = [
                        $value->name,
                        getProductCatsName(getProductCats($value->id)),
                        $value->product_code,
                        $value->slug,
                        strip_tags($value->description),
                        $value->status,
                        $value->created_at
                    ];                    
                }

                $sheet->fromArray($excelData, null, 'A1', true, false);

            });

        })->download('xlsx');

    }


}
