<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/***
 * Admin Auth Routes
 * 
 */
Route::post('/upload-image', [App\Http\Controllers\BlogController::class,'upload']);

Route::get('/atico-admin', 'Auth\AuthController@getLogin')->name('admin');
Route::post('/atico-admin/login', 'Auth\AuthController@postLogin');
Route::get('/atico-admin/logout', array('as' => 'admin-logout','uses' => 'Auth\AuthController@adminLogout'));

Route::group(['middleware' => 'auth', 'after' => 'no-cache'], function () {

    Route::prefix('atico-admin')->group(function () {

            Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

            // Change Password Routes
            Route::any('myaccount', ['as' => 'setting.manage-account',
                'uses' => 'SettingController@myAccount']);

            // Change Password Routes

            // Category route start

            Route::resource('category', 'CategoryController', [
                'names' => [
                    'index' => 'category.index',
                    'create' => 'category.create',
                    'store' => 'category.store',
                    'edit' => 'category.edit',
                    'update' => 'category.update',
                ],
                'except' => ['show', 'destroy']
            ]);
            
            Route::any('category/paginate/{page?}', ['as' => 'category.paginate',
                'uses' => 'CategoryController@categoryPaginate']);
            Route::any('category/toggle/{id?}', ['as' => 'category.toggle',
                'uses' => 'CategoryController@categoryToggle']);
            Route::any('category/drop/{id?}', ['as' => 'category.drop',
                'uses' => 'CategoryController@drop']);

            Route::get('category-excel', 'CategoryController@exportCategory')->name('category.excel');

            Route::get('category-no-product', 'CategoryController@catNoProduct')->name('cat_no_product');
            Route::get('sub-category-no-product', 'SubCategoryController@subCatNoProduct')->name('sub_cat_no_product');
            Route::get('sub-sub-category-no-product', 'SubSubCategoryController@subSubCatNoProduct')->name('sub_sub_cat_no_product');

            Route::get('category-change-status', 'CategoryController@catChangeStatus')->name('cat_change_status');
            Route::get('sub-category-change-status', 'SubCategoryController@subCatChangeStatus')->name('sub_cat_change_status');
            Route::get('sub-sub-category-change-status', 'SubSubCategoryController@subSubCatChangeStatus')->name('sub_sub_cat_change_status');

            Route::get('category-product', 'CategoryController@categoryProduct')->name('category_product');
            Route::get('sub-category-product', 'SubCategoryController@subCategoryProduct')->name('sub_category_product');
            Route::get('replace-cat-name', 'CategoryController@replaceCatLine')->name('replace_cat_name');
            Route::get('duplicate-slug', 'CategoryController@getDuplicateSlug')->name('duplicate_slug');
            //Category Route End

            // Category route start
            Route::resource('sub_category', 'SubCategoryController', [
                'names' => [
                    'index' => 'sub_category.index',
                    'create' => 'sub_category.create',
                    'store' => 'sub_category.store',
                    'edit' => 'sub_category.edit',
                    'update' => 'sub_category.update',
                ],
                'except' => ['show', 'destroy']
            ]);
            Route::any('sub_category/paginate/{page?}', ['as' => 'sub_category.paginate',
                'uses' => 'SubCategoryController@subCategoryPaginate']);
            Route::any('sub_category/toggle/{id?}', ['as' => 'sub_category.toggle',
                'uses' => 'SubCategoryController@subCategoryToggle']);
            Route::any('sub_category/drop/{id?}', ['as' => 'sub_category.drop',
                'uses' => 'SubCategoryController@drop']);
            Route::get('sub-category-excel', 'SubCategoryController@exportSubCategory')->name('sub_category.excel');
            //Category Route End

            // Category route start
            Route::resource('sub_sub_category', 'SubSubCategoryController', [
                'names' => [
                    'index' => 'sub_sub_category.index',
                    'create' => 'sub_sub_category.create',
                    'store' => 'sub_sub_category.store',
                    'edit' => 'sub_sub_category.edit',
                    'update' => 'sub_sub_category.update',
                ],
                'except' => ['show', 'destroy']
            ]);
            Route::any('sub_sub_category/paginate/{page?}', ['as' => 'sub_sub_category.paginate',
                'uses' => 'SubSubCategoryController@subSubCategoryPaginate']);
            Route::any('sub_sub_category/toggle/{id?}', ['as' => 'sub_sub_category.toggle',
                'uses' => 'SubSubCategoryController@subSubCategoryToggle']);
            Route::any('sub_sub_category/drop/{id?}', ['as' => 'sub_sub_category.drop',
                'uses' => 'SubSubCategoryController@drop']);
            Route::get('get_sub_cat', 'CategoryController@getSubCategory')->name('get_sub_cat');
            Route::get('sub-sub-category-excel', 'SubSubCategoryController@exportSubSubCategory')->name('sub_sub_category.excel');
            //Category Route End


            //Question Import
             Route::get('product/import', ['as' => 'product.import',
                'uses' => 'ProductController@ProductImport']);
             Route::any('product/word/upload', ['as' => 'product-word.upload',
                'uses' => 'ProductController@ProductWordUpload']);

             //Category Import
             Route::get('category/import', 'CategoryController@importCategories')->name('category_import');
             Route::post('category-excel', 'CategoryController@importCategoryStore')->name('category-excel.upload');

             Route::get('get-products', 'ProductController@getProductImage')->name('get_product');

            //Product route start
            Route::resource('product', 'ProductController', [
                'names' => [
                    'index' => 'product.index',
                    'create' => 'product.create',
                    'store' => 'product.store',
                    'edit' => 'product.edit',
                    'update' => 'product.update',
                ],
                'except' => ['show', 'destroy']
            ]);
            Route::any('product/paginate/{page?}', ['as' => 'product.paginate',
                'uses' => 'ProductController@productPaginate']);
            Route::any('product/toggle/{id?}', ['as' => 'product.toggle',
                'uses' => 'ProductController@productToggle']);
            Route::any('product/drop/{id?}', ['as' => 'product.drop',
                'uses' => 'ProductController@drop']);

            Route::get('product-excel', 'ProductController@exportProduct')->name('product.excel');
            //Category Route End

            Route::get('get_prod_sub_cat', 'CategoryController@getProdSubCat')->name('get_prod_sub_cat');
            Route::get('get_prod_sub_sub_cat', 'CategoryController@getProdSubSubCat')->name('get_prod_sub_sub_cat');

            //Replace Category Image Path

            Route::get('category_image_path_change', 'CategoryController@CatImgPathChange'); 
            Route::get('product_image_path_change', 'ProductController@ProductImgPathChange'); 


            // Group route start
            Route::resource('group', 'GroupController', [
                'names' => [
                    'index' => 'group.index',
                    'create' => 'group.create',
                    'store' => 'group.store',
                    'edit' => 'group.edit',
                    'update' => 'group.update',
                ],
                'except' => ['show', 'destroy']
            ]);
            Route::any('group/paginate/{page?}', ['as' => 'group.paginate',
                'uses' => 'GroupController@groupPaginate']);
            Route::any('group/toggle/{id?}', ['as' => 'group.toggle',
                'uses' => 'GroupController@groupToggle']);
            Route::any('group/drop/{id?}', ['as' => 'group.drop',
                'uses' => 'GroupController@drop']);
            //Category Route End

            // ProductQuery route start
            Route::resource('product_query', 'ProductQueryController', [
                'names' => [
                    'index' => 'product_query.index',
                    'create' => 'product_query.create',
                    'edit' => 'product_query.edit',
                    'update' => 'product_query.update',
                ],
                'except' => ['show', 'destroy']
            ]);
            Route::any('product_query/paginate/{page?}', ['as' => 'product_query.paginate',
                'uses' => 'ProductQueryController@productQueryPaginate']);
            Route::any('product_query/drop/{id?}', ['as' => 'product_query.drop',
                'uses' => 'ProductQueryController@drop']);

            // Request Quote route start
            Route::resource('request_quote', 'RequestQuoteController', [
                'names' => [
                    'index' => 'request_quote.index',
                    'create' => 'request_quote.create',
                    'edit' => 'request_quote.edit',
                    'update' => 'request_quote.update',
                ],
                'except' => ['show', 'destroy']
            ]);
            Route::any('request_quote/paginate/{page?}', ['as' => 'request_quote.paginate',
                'uses' => 'RequestQuoteController@requestQuotePaginate']);
            Route::any('request_quote/drop/{id?}', ['as' => 'request_quote.drop',
                'uses' => 'RequestQuoteController@drop']);


            // Request Quote route start
            Route::resource('blog_comment', 'BlogCommentController', [
                'names' => [
                    'index' => 'blog_comment.index',
                    'create' => 'blog_comment.create',
                    'edit' => 'blog_comment.edit',
                    'update' => 'blog_comment.update',
                ],
                'except' => ['show', 'destroy']
            ]);
            Route::any('blog_comment/paginate/{page?}', ['as' => 'blog_comment.paginate',
                'uses' => 'BlogCommentController@blogCommentPaginate']);
            Route::any('blog_comment/drop/{id?}', ['as' => 'blog_comment.drop',
                'uses' => 'BlogCommentController@drop']);

            Route::any('blog_comment/toggle/{id?}', ['as' => 'blog_comment.toggle',
                'uses' => 'BlogCommentController@blogCommentToggle']);



            // Request Quote route start
            Route::resource('enquiry', 'EnquiryController', [
                'names' => [
                    'index' => 'enquiry.index',
                    'create' => 'enquiry.create',
                    'edit' => 'enquiry.edit',
                    'update' => 'enquiry.update',
                ],
                'except' => ['show', 'destroy']
            ]);
            Route::any('enquiry/paginate/{page?}', ['as' => 'enquiry.paginate',
                'uses' => 'EnquiryController@enquiryPaginate']);
            Route::any('enquiry/drop/{id?}', ['as' => 'enquiry.drop',
                'uses' => 'EnquiryController@drop']);
            //Category Route End


            //About

            Route::get('sidebar-categories/create', 'SidebarCategoryController@create')->name('sidebar_category.create');
            Route::post('sidebar-categories/store', 'SidebarCategoryController@store')->name('sidebar_category.store');

            Route::resource('product_review','ProductReviewController', [
                'names' => [
                    'index'     => 'product_review.index',
                    'create'    => 'product_review.create',
                    'store'     => 'product_reviewes.store',
                    'edit'      => 'product_review.edit',
                    'update'    => 'product_review.update',
                ],
                'except' => ['show','destroy']
            ]);

            Route::any('product_review/paginate/{page?}', ['as' => 'product_review.paginate',
                'uses' => 'ProductReviewController@productReviewPaginate']);
            Route::any('product_review/toggle/{id?}', ['as' => 'product_review.toggle',
                'uses' => 'ProductReviewController@productReviewToggle']);
            Route::any('product_review/drop/{id?}', ['as' => 'product_review.drop',
                'uses' => 'ProductReviewController@drop']);

            //Blog Start

            Route::resource('blog', 'BlogController', [
                'names' => [
                    'index' => 'blog.index',
                    'create' => 'blog.create',
                    'store' => 'blog.store',
                    'edit' => 'blog.edit',
                    'update' => 'blog.update',
                ],
                'except' => ['show', 'destroy']
            ]);
            Route::any('blog/paginate/{page?}', ['as' => 'blog.paginate',
                'uses' => 'BlogController@blogPaginate']);
            Route::any('blog/toggle/{id?}', ['as' => 'blog.toggle',
                'uses' => 'BlogController@blogToggle']);
            Route::any('blog/drop/{id?}', ['as' => 'blog.drop',
                'uses' => 'BlogController@drop']);

            // FAQ route start
            Route::resource('faq', 'FaqController', [
                'names' => [
                    'index' => 'faq.index',
                    'create' => 'faq.create',
                    'store' => 'faq.store',
                    'edit' => 'faq.edit',
                    'update' => 'faq.update',
                ],
                'except' => ['show', 'destroy']
            ]);
            Route::any('faq/paginate/{page?}', ['as' => 'faq.paginate',
                'uses' => 'FaqController@FaqPaginate']);
            Route::any('faq/toggle/{id?}', ['as' => 'faq.toggle',
                'uses' => 'FaqController@FaqToggle']);
            Route::any('faq/drop/{id?}', ['as' => 'faq.drop',
                'uses' => 'FaqController@drop']);

        Route::get('get-unallocated-categories', 'CategoryController@getUnAllocated')->name('get_unallocated_cats');

        Route::any('get-unallocated-categories/paginate/{page?}', ['as' => 'get_unallocated_cats_paginate',
                'uses' => 'CategoryController@unAllocatedCategoryPaginate']);

    });

});


/***
 * Frontend Routes
 * 
 */
//Home Page
Route::get('/', 'Frontend\HomeController@index')->name('home');

//Route::get('export-pro', 'Frontend\HomeController@expPro')->name('expPro');

//About us Page
Route::get('about-us', 'Frontend\HomeController@aboutUsPage')->name('about_us_page');

//Products Page
Route::get('products', 'Frontend\HomeController@productsPage')->name('products_page');

//Product Detail Page
Route::get('product/{slug?}', 'Frontend\HomeController@productDetailPage')->name('product_detail');
//Blog Page
Route::get('blogs', 'Frontend\HomeController@blogPage')->name('blog_page');

//Blog Detail Page
Route::get('blog/{slug?}', 'Frontend\HomeController@blogDetailPage')->name('blog_detail');
//Contact us Page
Route::get('contact-us', 'Frontend\HomeController@contactUsPage')->name('contact_us_page');
Route::post('contact-us', 'Frontend\HomeController@contactUsPage')->name('contact_us_pagePost');

//FAQ Page
Route::get('faq', 'Frontend\HomeController@faqPage')->name('faq_page');

//Certificate Page
Route::get('certificates', 'Frontend\HomeController@certificatePage')->name('certificate_page');

//Lab tenders Page
Route::get('lab-tenders', 'Frontend\HomeController@labTenderPage')->name('lab_tender_page');

Route::get('biology-lab-equipment-manufacturer-in-tamil-nadu', 'Frontend\HomeController@biologylabequipmentPage')->name('biology_lab_equipment_page');
Route::get('lab-equipment-supplier-in-delhi', 'Frontend\HomeController@labequipmentPage')->name('lab_equipment_page');
Route::get('physics-lab-equipment-manufacturer-in-mumbai', 'Frontend\HomeController@physicslabequipmentPage')->name('physics_lab_equipment_page');
Route::get('laboratory-glassware-manufacturer-in-malaysia', 'Frontend\HomeController@laboratoryglasswaremanufacturerinmalaysia')->name('laboratory_glassware_manufacturer_in_malaysia');
Route::get('laboratory-glassware-manufacturer-in-vietnam', 'Frontend\HomeController@laboratoryglasswaremanufacturerivietnam')->name('laboratory_glassware_manufacturer_in_vietnam');
Route::get('physics-lab-equipment-manufacturer-in-nigeria', 'Frontend\HomeController@physicslabequipmentPageNigeria')->name('physics_lab_equipment_page_nigeria');
Route::get('educational-lab-equipment-manufacturer-in-ambala', 'Frontend\HomeController@educationallabequipmentPage')->name('educational_lab_equipment_page');
//Lab tenders Page
Route::get('terms-service/', 'Frontend\HomeController@termServicePage')->name('terms_page');

//testimonial Page
Route::get('testimonial', 'Frontend\HomeController@testimonialPage')->name('testimonial_page');

//Category Page
Route::get('category/{slug?}', 'Frontend\HomeController@getCategories')->name('categories');

//product Query Store
Route::post('product-query/store', 'ProductQueryController@store')->name('product_query.store');
Route::delete('product_query/{id}', 'ProductQueryController@destroy')->name('product_query.destroy');

//Store Product Comment
    Route::post('product-review-store', 'Frontend\ProductReviewController@store')->name('product_review_store');

//Category Search
Route::post('category/search', 'Frontend\HomeController@categorySearch')->name('category_search');
Route::post('product/search', 'Frontend\HomeController@productSearch')->name('product_search');

//All Categories
Route::get('categories', 'Frontend\HomeController@allCategories')->name('all_categories');

//All Products
Route::get('products', 'Frontend\HomeController@allProducts')->name('all_products');


use App\Models\Enquiry;

Route::post('send-enquiry', function (Illuminate\Http\Request $request) {
    // Store the enquiry data in the database
    $enquiry = new Enquiry;
    $enquiry->name = $request->input('name');
    $enquiry->email = $request->input('email');
    $enquiry->country = $request->input('country');
    $enquiry->mobile_no = $request->input('mobile_no');
    $enquiry->message = $request->input('message');
    $enquiry->save();
    
    // Redirect the user to a thank you page or show a success message
 return redirect()->back();
    
})->name('send_enquiry');



Route::any('get-quote', 'ProductQueryController@get_quote')->name('get-quote');

//Rquest Quote Form
Route::post('request-quote-store', 'RequestQuoteController@store')->name('request_quote.store');
//Group Categories
Route::get('group/{id}', 'Frontend\HomeController@groupCategory')->name('group_categories');

//Enquiry Form
Route::post('enquiry-store', 'EnquiryController@store')->name('enquiry.store');
Route::delete('enquiry/{id}', 'EnquiryController@destroy')->name('enquiry.destroy');
Route::delete('enquiry/deleteSelected', 'EnquiryController@deleteSelected')->name('enquiry.deleteSelected');

//Replace HTML tags In product description
Route::get('replace-html-tag-prod-desc', 'Frontend\HomeController@replaceHTMLTagInDesc');

//Blog Comment Store
Route::post('blog-comment/store', 'BlogCommentController@store')->name('blog_comment.store');




//Group Categories
Route::get('group/{id}', 'Frontend\HomeController@groupCategory')->name('group_categories');

//Delete categories
Route::get('delete-categories', 'CategoryController@deleteInActive');

