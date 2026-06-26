<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Models\BlogCategory;
class BlogController extends Controller
{
    public function index()
{
    $blogs = Blog::orderBy('id', 'desc')->get();
    return view('admin.blog.index', compact('blogs'));
}


    public function  create()
    {	
         $cats = Category::leftjoin('categories as sub', 'categories.id', '=', 'sub.parent_id')->where('categories.status', '1')->where('categories.parent_id', 0)->orderBy('categories.name')->pluck('categories.name', 'categories.id')->toArray();
        return view('admin.blog.create', compact('cats'));
    }
    public function store(Request $request)
{
    try {

        // ---------------------------
        // VALIDATION
        // ---------------------------
        $inputs = $request->all();

        $validator = (new Blog)->validate($inputs);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // ---------------------------
        // SLUG GENERATION
        // ---------------------------
        unset($inputs['slug']);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $inputs['name'])));
        $inputs['slug'] = $slug;

        // ---------------------------
        // IMAGE UPLOAD
        // ---------------------------
        $image = null;

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $destinationPath = public_path('/uploads/blog_images/');
            $file->move($destinationPath, $imageName);

            $image = $imageName;
        }

        unset($inputs['image']);

        // ---------------------------
        // BLOG DATA
        // ---------------------------
        $inputs['created_by'] = \Auth::id();
        $inputs['status']     = $request->filled('status') ? $request->status : 0;
        $inputs['image']      = $image;

        // ---------------------------
        // DATABASE TRANSACTION
        // ---------------------------
        \DB::beginTransaction();

        $blog_id = (new Blog)->store($inputs);

        // ---------------------------
        // BLOG CATEGORIES (OPTIONAL)
        // ---------------------------
        $categories = $request->input('category_id', []);

        if (is_array($categories)) {
            foreach ($categories as $categoryId) {
                (new BlogCategory)->store([
                    'blog_id'     => $blog_id,
                    'category_id' => $categoryId,
                ]);
            }
        }

        \DB::commit();

        return redirect()->route('blog.index')
            ->with('success', lang('messages.created', lang('blog.blog')));

    } catch (\Exception $exception) {

        \DB::rollBack();

        return redirect()->route('blog.create')
            ->withInput()
            ->with('error', lang('messages.server_error') . $exception->getMessage());
    }
}

    public function store_bkup(Request $request)
    {
        try{
            $inputs = $request->all();
            $validator = (new Blog)->validate($inputs);
            if( $validator->fails() ) {
                return back()->withErrors($validator)->withInput();
            }

            unset($inputs['slug']);
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $inputs['name'])));
            $inputs = $inputs + [ 'slug' => $slug ];

            if(isset($inputs['image']) or !empty($inputs['image']))
            {
            	$image_name = rand(100000, 999999);
	            $fileName = '';
	            if($file = $request->hasFile('image')) 
	            {
	                $file = $request->file('image') ;
	                $img_name = $file->getClientOriginalName();
	                $fileName = $image_name.$img_name;
	                $destinationPath = public_path().'/uploads/blog_images/' ;
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
                'status'    => isset($request->status)?$request->status:0,
                'image'	=>	$image
            ];
            \DB::beginTransaction();
           $blog_id = (new Blog)->store($inputs);
           for ($i=0; $i < count($inputs['category_id']); $i++) { 
                $blogCatInput = [
                    'blog_id' => $blog_id,
                    'category_id' => $inputs['category_id'][$i],
                ];
                (new BlogCategory)->store($blogCatInput); 
                unset($blogCatInput['category_id']);
            }
            \DB::commit();
            return redirect()->route('blog.index')
                ->with('success', lang('messages.created', lang('blog.blog')));
        }
        catch (\Exception $exception) {
            return redirect()->route('blog.create')
                ->withInput()
                ->with('error', lang('messages.server_error').$exception->getMessage());
        }
    }

    public function blogPaginate(Request $request, $pageNumber = null)
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

            $data = (new Blog)->getBlogs($inputs, $start, $perPage);

            $totalblog = (new Blog)->totalBlogs($inputs);
            $total = $totalblog->total;
        } else {
            $data = (new Blog)->getBlogs($inputs, $start, $perPage);
            $totalblog = (new Blog)->totalBlogs($inputs);
            $total = $totalblog->total;
        }
        return view('admin.blog.load_data', compact('inputs', 'data', 'total', 'page', 'perPage'));
    }

    public function blogToggle($id = null)
    {
         if (!\Request::isMethod('post') && !\Request::ajax()) {
            return lang('messages.server_error');
        }

        try {
            $blog = Blog::find($id);
        } catch (\Exception $exception) {
            return lang('messages.invalid_id', string_manip(lang('blog.blog')));
        }

        $blog->update(['status' => !$blog->status]);
        $response = ['status' => 1, 'data' => (int)$blog->status . '.gif'];
        // return json response
        return json_encode($response);
    }
    
    public function upload(Request $request)
{
    if ($request->hasFile('upload')) {

        $file = $request->file('upload');

        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('uploads'), $filename);

        return response()->json([
            'url' => asset('uploads/' . $filename)
        ]);
    }

    return response()->json([
        'error' => 'No file uploaded'
    ], 400);
}

    public function edit($id = null)
    {
         $product_cats = BlogCategory::where('blog_id', $id)->pluck('category_id')->toArray();
        $selected_cats = Category::whereIn('id', $product_cats)->where('parent_id', 0)->pluck('id')->ToArray();

        $selected_sub_cats = Category::whereIn('id', $product_cats)->whereIn('parent_id', $selected_cats)->pluck('id')->toArray();

        $selected_sub_sub_cats = Category::whereIn('id', $product_cats)->whereIn('parent_id', $selected_sub_cats)->pluck('id')->toArray();

        $cats = Category::leftjoin('categories as sub', 'categories.id', '=', 'sub.parent_id')->where('categories.status', '1')->where('categories.parent_id', 0)->orderBy('categories.name')->pluck('categories.name', 'categories.id')->toArray();
        //dd($cats);
        $sub_cats = Category::whereIn('parent_id', $selected_cats)->where('status', 1)->orderBy('name')->get();

        $sub_sub_cats = Category::whereIn('parent_id', $selected_sub_cats)->where('status', 1)->orderBy('name')->get();

        $result = (new Blog)->find($id);
        if (!$result) {
            abort(401);
        }
        return view('admin.blog.create', compact('result', 'cats', 'sub_cats', 'sub_sub_cats', 'product_cats'));
    }

    public function update(Request $request, $id = null)
    {
        $result = (new Blog)->find($id);
        if (!$result) {
            abort(401);
        }

        try {
            $inputs = $request->all();
            // $validator = (new Blog)->validate($inputs, $id);
            // if( $validator->fails() ) {
            //     return back()->withErrors($validator)->withInput();
            // }
$dateFields = ['created_at', 'updated_at', 'published_at']; // Add your datetime fields
        foreach ($dateFields as $field) {
            if (isset($inputs[$field]) && $inputs[$field] === '') {
                $inputs[$field] = null;
            }
        }
            unset($inputs['slug']);
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $inputs['name'])));
            $inputs = $inputs + [ 'slug' => $slug ];

            if(isset($inputs['image']) or !empty($inputs['image']))
            {
            	$image_name = rand(100000, 999999);
	            $fileName = '';
	            if($file = $request->hasFile('image')) 
	            {
	                $file = $request->file('image') ;
	                $img_name = $file->getClientOriginalName();
	                $fileName = $image_name.$img_name;
	                $destinationPath = public_path().'/uploads/blog_images/' ;
	                $file->move($destinationPath, $fileName);
	            }
	            $image = $fileName;
            }
            else{
            	$image = $result['image'];
            }


            unset($inputs['image']);
            $inputs = $inputs + [
                'updated_by' => \Auth::user()->id,
                'status'	=>	isset($request->status) ? $request->status : '0',
                'image'	=>	$image
            ];
            \DB::beginTransaction();
            (new Blog)->store($inputs, $id);
             BlogCategory::where('blog_id', $id)->delete();

            for ($i=0; $i < count($inputs['category_id']); $i++) { 
                $blogCatInput = [
                    'blog_id' => $id,
                    'category_id' => $inputs['category_id'][$i],
                ];
                (new BlogCategory)->store($blogCatInput); 
                unset($blogCatInput['category_id']);
            }
            \DB::commit();
            return redirect()->route('blog.index')
                ->with('success', lang('messages.updated', lang('blog.blog')));

        } catch (\Exception $exception) {
            dd($exception);
            return redirect()->route('blog.edit', [$id])
                ->withInput()
                ->with('error', lang('messages.server_error'));
        }
    }
}
