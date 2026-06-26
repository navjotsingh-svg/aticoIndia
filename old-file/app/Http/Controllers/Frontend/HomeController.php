<?php

namespace App\Http\Controllers\Frontend;
/**
 * :: Homepage Controller ::
 * To manage homepage.
 *
 **/

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\GroupCategory;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Faq;
use App\Models\Group;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\DB;
//require_once app_path('Helper/Shortcode.php');
//use App\Support\Shortcode;

class HomeController extends Controller{
    /**
     * Display a listing of resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        try{
            $products = Product::where('status', 1)->orderBy('id', 'desc')->take(8)->get();
            $blogs = Blog::where('status', '1')->take('4')->orderBy('id', 'desc')->get();
            $faqs = Faq::where('status', 1)->take(4)->orderBy('id', 'desc')->get();
            $groups = Group::where('status', 1)->take('8')->orderBy('sort', 'asc')->get();
            $latest_cats = \App\Models\SidebarCategory::join('categories', 'sidebar_categories.category_id', '=', 'categories.id')->select('categories.name', 'categories.slug', 'categories.id', 'categories.image')->take('8')->get();

            return view('frontend.home', compact('products', 'blogs', 'faqs', 'groups', 'latest_cats'));
        } catch(\Exception $e){
           // dd($e);
            return back();
        }
    }

    public function showCaptchaForm()
    {
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
    
        return view('frontend.captcha', compact('num1', 'num2'));
    }
    
    

    //About us Page Function
    public function aboutUsPage()
    {
        try{
            return view('frontend.pages.about_us');
        } catch(\Exception $e){
            return back();
        }
    }


    //Products Function
    public function productsPage()
    {
        try{
            return view('frontend.pages.products');
        } catch(\Exception $e){
            return back();
        }
    }

    //Product Detail Function
    public function productDetailPage($slug=null)
    {
        try{
            if(!$slug){
                return redirect()->route('404_page');
            }
            $product = Product::where('slug', $slug)->first();
            $keyword = Product::where('slug', $slug)->select('meta_title', 'meta_description', 'meta_tag', 'slug')->first();
            if(!$product){
                return redirect()->route('404_page');   
            }
            $product_reviews = ProductReview::where('product_id', $product['id'])->where('status', 1)->get();       
            return view('frontend.pages.product_detail', compact('product', 'product_reviews', 'keyword'));
        } catch(\Exception $e){
           // dd($e);
            return back();
        }
    }

    //Blog page Function
    public function blogPage()
    {
        try{
            $blogs = Blog::where('status', 1)->orderBy('id', 'desc')->get();
            //dd($blogs);
            return view('frontend.pages.blogs', compact('blogs'));
        } catch(\Exception $e){
            return back();
        }
    }

    //Blog Detail Function


public function blogDetailPage($slug)
{
    try{
        $blog = Blog::where('slug', $slug)->first();
        if(!$blog){
            return redirect()->route('404_page');
        }

        $keyword = Blog::where('slug', $slug)
            ->select('meta_title', 'meta_description', 'meta_tag')
            ->first();

        $latest_blogs = Blog::where('status', 1)
            ->where('id', '!=', $blog['id'])
            ->take('6')
            ->get();

        $blog_comments = BlogComment::where('blog_id', $blog['id'])
            ->where('status', 1)
            ->get();

        // 🔹 PROCESS DESCRIPTION (only if [products] exists)
        $content = render_blog_products($blog->description, $blog);

        return view(
            'frontend.pages.blog_detail',
            compact('blog', 'latest_blogs', 'blog_comments', 'keyword', 'content')
        );

    } catch(\Exception $e){
        return back();
    }
}

    public function blogDetailPage_bkup($slug)
    {
        try{
            $blog = Blog::where('slug', $slug)->first();
            if(!$blog){
                return redirect()->route('404_page');
            }
            $keyword = Blog::where('slug', $slug)->select('meta_title', 'meta_description', 'meta_tag')->first();
            
            $latest_blogs = Blog::where('status', 1)->where('id', '!=', $blog['id'])->take('6')->get();
            $blog_comments = BlogComment::where('blog_id', $blog['id'])->where('status', 1)->get();
          /*  $categoryIds = BlogCategory::where('blog_id', $blog['id'])
    ->pluck('category_id');
            $productIds = DB::table('product_categories')
            ->whereIn('category_id', $categoryIds)
            ->pluck('product_id')
            ->unique();

            $products = Product::whereIn('id', $productIds)
            ->paginate(12);*/
            return view('frontend.pages.blog_detail', compact('blog', 'latest_blogs', 'blog_comments', 'keyword'));//,'products'
        } catch(\Exception $e){
            return back();
        }
    }

    //Contact Us Function
    public function contactUsPage()
    {
        try{
            return view('frontend.pages.contact_us');
        } catch(\Exception $e){
            return back();
        }
    }

    //Faq Function
    public function faqPage()
    {
        try{
            $faqs = Faq::where('status',1)->orderBy('id', 'desc')->get();
            return view('frontend.pages.faq', compact('faqs'));
        } catch(\Exception $e){
            return back();
        }
    }
    //Certificate Function
    public function certificatePage()
    {
        try{
            return view('frontend.pages.certificate');
        } catch(\Exception $e){
            return back();
        }
    }

    //Lab Tender Function
    public function labTenderPage()
    {
        try{
            return view('frontend.pages.lab_tender');
        } catch(\Exception $e){
            return back();
        }
    }

     public function biologylabequipmentPage()
    {
        try{
            return view('frontend.pages.biology_lab_equipment');
        } catch(\Exception $e){
            return back();
        }
    }

    public function physicslabequipmentPage()
    {
        try{
            return view('frontend.pages.physics_lab_equipment');
        } catch(\Exception $e){
            return back();
        }
    }
     public function physicslabequipmentPageNigeria()
    {
        try{
            return view('frontend.pages.physics_lab_equipment_nigeria');
        } catch(\Exception $e){
            return back();
        }
    }
    public function laboratoryglasswaremanufacturerinmalaysia()
    {
        try{
             $categories = Category::where('parent_id', '379')->where('status', 1)->paginate(8);
             $categories2 = Category::whereIn('id', array('163,164','405','166','285'))->where('status', 1)->get();
           $categoryIds = [163, 164, 285, 166];

$products = DB::table('products as p')
    ->join('product_categories as pc', 'pc.product_id', '=', 'p.id')
    ->whereIn('pc.category_id', $categoryIds)
    ->select('p.*')
    ->distinct()
    ->paginate(12);
            return view('frontend.pages.laboratory_glassware_manufacturer_in_malaysia',compact('categories','categories2','products'));
        } catch(\Exception $e){
            return back();
        }
    }
     public function laboratoryglasswaremanufacturerivietnam()
    {
        try{
             $categories = Category::where('parent_id', '379')->where('status', 1)->paginate(8);
             $categories2 = Category::whereIn('id', array('163,164','405','166','285'))->where('status', 1)->get();
           $categoryIds = [163, 164, 285, 166];

$products = DB::table('products as p')
    ->join('product_categories as pc', 'pc.product_id', '=', 'p.id')
    ->whereIn('pc.category_id', $categoryIds)
    ->select('p.*')
    ->distinct()
    ->paginate(12);
            return view('frontend.pages.laboratory_glassware_manufacturer_in_vietnam',compact('categories','categories2','products'));
        } catch(\Exception $e){
            return back();
        }
    }
    public function educationallabequipmentPage()
    {
        try{
            return view('frontend.pages.educational_lab_equipment');
        } catch(\Exception $e){
            return back();
        }
    }

      public function labequipmentPage()
    {
        try{
            return view('frontend.pages.lab_equipment');
        } catch(\Exception $e){
            return back();
        }
    }

    //termServicePage Function
    public function termServicePage()
    {
        try{
            return view('frontend.pages.terms');
        } catch(\Exception $e){
            return back();
        }
    }

    //testimonial Function
    public function testimonialPage()
    {
        try{
            return view('frontend.pages.testimonials');
        } catch(\Exception $e){
            return back();
        }
    }

    //Categories Function
    public function getCategories($slug = null)
    {
        try{
          //  dd($slug);
            
            if(!$slug){
                
                return redirect()->route('404_page');
            }
            
            
            if($slug == 'mechanical-engineering'){
               $slug = 'mechanical-lab-equipment'; 
            }
            
            if($slug == 'material-testing-equipment'){
               $slug = 'material-testing-lab-equipment'; 
            }
            
            if($slug == 'research-lab-equipment'){
               $slug = 'laboratory-research-equipment'; 
            }
            
            if($slug == 'chemical-reaction-engineering-lab'){
               $slug = 'chemical-engineering-lab-equipment'; 
            }
            
            if($slug == 'fluid-mechanics-lab'){
               $slug = 'fluid-mechanics-lab-equipment'; 
            }
             
           // $category = Category::where('slug', $slug)->where('status', 1)->where('parent_id', 0)->first();
           $category = Category::where('slug', $slug)->where('status', 1)->first();
            //dd($category);
            $keyword = Category::where('slug', $slug)->where('status', 1)->select('meta_title', 'meta_description', 'meta_tag', 'slug','img_alt')->first();
            if(!$category){
                return back();
               // return redirect()->route('404_page'); 
               // $category = Category::where('slug', $slug)->first();
            }
            else if(!$category){
               
                return back();
                //return redirect()->route('404_page');   
            }
           
            if($category['parent_id'] == 0){
                 
                $category_ids = Category::where('slug', $slug)->where('status', 1)->pluck('id')->toArray();
                $categories = Category::whereIn('parent_id', $category_ids)->orwhereIn('second_parent_id', $category_ids)->orwhereIn('third_parent_id', $category_ids)->orwhereIn('four_parent_id', $category_ids)->where('status', 1)->get();
                $cat = Category::whereIn('id', $category_ids)->where('description', '!=', '')->first();
                $product_ids = ProductCategory::whereIn('category_id', $category_ids)->pluck('product_id')->toArray();
                    $products = Product::whereIn('id', $product_ids)->where('status', 1)
                    ->select('products.name', 'products.image', 'products.slug', 'products.description','products.img_alt')
                    ->get();
                if(count($categories) == 0){

                    $sub_sub_cat = $cat;
                   
                    $category_ids = Category::where('slug', $slug)->where('status', 1)->pluck('id')->toArray();
                    $product_ids = ProductCategory::whereIn('category_id', $category_ids)->pluck('product_id')->toArray();
                    $products = Product::whereIn('id', $product_ids)->where('status', 1)
                    ->select('products.name', 'products.image', 'products.slug', 'products.description','products.img_alt')
                    ->get();

                    return view('frontend.pages.products', compact('products', 'categories', 'sub_sub_cat', 'category', 'keyword'));
                }
                
            }
            else {
                $sub_cats = Category::where('parent_id', $category['id'])->select('id')->get();
                if(count($sub_cats) > 0){
                    $category_ids = Category::where('slug', $slug)->where('status', 1)->pluck('id')->toArray();
                    $cat = Category::whereIn('id', $category_ids)->where('description', '!=', '')->first();
                    $categories = Category::whereIn('parent_id', $category_ids)->where('status', 1)->get();
                    if(count($categories)>0){
                        $sub_cat = Category::where('id', $categories[0]['parent_id'])->first();
                    }
                    $product_ids = ProductCategory::whereIn('category_id', $category_ids)->pluck('product_id')->toArray();
                    $products = Product::whereIn('id', $product_ids)->where('status', 1)
                    ->select('products.name', 'products.image', 'products.slug', 'products.description','products.img_alt')
                    ->get();
                }
                else{
                   
                    $category_ids = Category::where('slug', $slug)->where('status', 1)->pluck('id')->toArray();
                
                    $cat = Category::whereIn('id', $category_ids)->where('description', '!=', '')->first();
                    if($cat){
                        $sub_sub_cat = $cat;                        
                    }
                    else{
                        $sub_sub_cat = Category::where('slug', $slug)->where('status', 1)->first();
                    }
                    if(isset($sub_sub_cat)){
                        $sub_cat = Category::where('id', $sub_sub_cat['parent_id'])->first();
                        if(isset($sub_cat)){
                            $cat = Category::where('id', $sub_cat['parent_id'])->first();
                        }
                    }
                    
                    $product_ids = ProductCategory::whereIn('category_id', $category_ids)->pluck('product_id')->toArray();
                    $products = Product::whereIn('id', $product_ids)->where('status', 1)
                    ->select('products.name', 'products.image', 'products.slug', 'products.description','products.img_alt')
                    ->get();
 
                    return view('frontend.pages.products', compact('products', 'cat', 'sub_cat', 'sub_sub_cat', 'category', 'keyword'));
                }
            }
            
         
            
            return view('frontend.pages.category', compact('categories', 'cat', 'category', 'keyword','products'));
        } catch(\Exception $e){
            dd($e);
            return back();
        }
    }

    //category Seach Page
    public function categorySearch(Request $request)
    {
        try{
            $inputs = $request->all();
            if(!isset($inputs['slug'])){
                $categories = Category::where('parent_id', 0)->where('name', 'LIKE', '%' . $inputs['q'] . '%')->where('status', 1)->orderBy('id', 'desc')->get(); 
                return view('frontend.pages.all_categories', compact('categories')); 
            }
            $slug = $inputs['slug'];

            $category = Category::where('slug', $slug)->where('status', 1)->first();
            if(!$category){
                return redirect()->route('404_page');   
            }

            if($category['parent_id'] == 0){
                $category_ids = Category::where('slug', $slug)->where('status', 1)->pluck('id')->toArray();
                $categories = Category::whereIn('parent_id', $category_ids)->where('name', 'LIKE', '%' . $inputs['q'] . '%')->where('status', 1)->get();
                $cat = Category::whereIn('id', $category_ids)->where('description', '!=', '')->first();
            }
            else{
                $sub_cats = Category::where('parent_id', $category['id'])->select('id')->get();
                if(count($sub_cats) > 0){
                    $category_ids = Category::where('slug', $slug)->where('status', 1)->pluck('id')->toArray();
                    $categories = Category::whereIn('parent_id', $category_ids)->where('name', 'LIKE', '%' . $inputs['q'] . '%')->where('status', 1)->get();
                    $cat = Category::whereIn('id', $category_ids)->where('description', '!=', '')->first();
                    if(count($categories)>0){
                        $sub_cat = Category::where('id', $categories[0]['parent_id'])->first();
                        //$cat = Category::where('id', $sub_cat['parent_id'])->first();
                    }
                }
                else{
                    $sub_sub_cat = Category::where('slug', $slug)->where('status', 1)->first();
                    if(isset($sub_sub_cat)){
                        $sub_cat = Category::where('id', $sub_sub_cat['parent_id'])->first();
                        if(isset($sub_cat)){
                            $cat = Category::where('id', $sub_cat['parent_id'])->first();
                        }
                    }

                    $category_ids = Category::where('slug', $slug)->where('status', 1)->pluck('id')->toArray();
                    $product_ids = ProductCategory::whereIn('category_id', $category_ids)->pluck('product_id')->toArray();
                    $products = Product::whereIn('id', $product_ids)->where('name', 'LIKE', '%' . $inputs['q'] . '%')->where('status', 1)
                    ->select('products.name', 'products.image', 'products.slug', 'products.description')
                    ->get();

                    return view('frontend.pages.products', compact('products', 'categories', 'cat', 'sub_cat', 'sub_sub_cat', 'category'));
                }
            }
            return view('frontend.pages.category', compact('categories', 'cat', 'category', 'sub_cat'));

        }
        catch(\Exception $e){
            //dd($e);
            return back();
        }
    }

    //Product Seach Page
    public function productSearch(Request $request)
    {
        try{
            $inputs = $request->all();
            $products = Product::where('name', 'LIKE', '%' . $inputs['q'] . '%')->where('status', 1)->orderBy('id', 'desc')->get(); 
            return view('frontend.pages.all_products', compact('products')); 
        }
        catch(\Exception $e){
            //dd($e);
            return back();
        }
    }


    //All Categories
    public function allCategories()
    {
        try{
            $categories = Category::where('parent_id', 0)->where('status', 1)->orderBy('id', 'desc')->select('name', 'slug', 'description', 'image','img_alt')->get();
            return view('frontend.pages.all_categories', compact('categories'));

        } catch(\Exception $e){
            //dd($e);
            return back();
        }
    }

    //All Products
    public function allProducts()
    {
        try{
            $products = Product::where('status', 1)->orderBy('id', 'desc')->select('name', 'slug', 'description', 'image')->get();
            return view('frontend.pages.all_products', compact('products'));

        } catch(\Exception $e){
            //dd($e);
            return back();
        }
    }

    //test Function
    public function groupCategory($group_id)
    {
        try{
            $categories = GroupCategory::join('categories', 'group_categories.category_id', '=', 'categories.id')->where('group_categories.group_id', $group_id)->select('categories.name', 'categories.slug', 'categories.short_name', 'categories.image', 'categories.description')->get();
            $group = Group::find($group_id);
            return view('frontend.pages.all_categories', compact('categories', 'group'));
        } catch(\Exception $e){
            //dd($e);
            return back();
        }
    }


    //test Function
    public function test()
    {
        try{
            return view('frontend.pages.home');
        } catch(\Exception $e){
            return back();
        }
    }

    public function replaceHTMLTagInDesc()
    {
        $products = Product::where('description', 'LIKE', '%' . '<img' . '%')->get();
        


       // dd($products);
        foreach ($products as $key => $value) {
            $desc = str_replace('[hr type="single" margin_top="4" margin_bottom="4"]', '', $value->description);
            Product::where('id', $value->id)->update(['description'=>$desc]);
        }
        //dd('fsfsd');
    }


    
 public function expPro(){
      try{
    $products =  Product::where('status', 1)->get();

 
      \Excel::create('$products', function($excel) use($products) {
            $excel->sheet('$products', function($sheet) use($products) {
                $excelData = [];
                $excelData[] = [
                'post_title',
                'post_name',
                'ID',
                'post_content',
                'post_status',
                'menu_order',
                'post_date',
                'post_author',
                'comment_status',
                'downloadable',
                'post_excerpt',
                'images',
                'Product Categories',
                
                ];
                foreach ($products as $key => $value) {
                $Category = "";   
                 $cat_p = ProductCategory::where('product_id', $value->id)->first();   
                if( $cat_p){
                $Category = Category::where('id', $cat_p->category_id)->first();
                }
                    
                $excelData[] = [
                $value->name,
                $value->slug,
                '5555'.$value->id,
                $value->description,
                'publish',
                0,
                $value->created_at,
                1,
                'open',
                'no',
                $value->description,
                'http://educational.monroemansions.com/wp-content/uploads/2020/08/'.$value->image,
               
               $Category  != '' ? $Category->name : '',
           
              
                ]; 
                }
                $sheet->fromArray($excelData, null, 'A1', true, false);
            });
            })->download('xlsx');
            
      } catch(\Exception $e){
          
        //  dd($e);
          
      }
        
    }

}
