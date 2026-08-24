<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [HomeController::class, 'about'])->name('about');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/lab-tenders', [HomeController::class, 'labTenders'])->name('lab-tenders');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');
Route::get('/terms-service', [HomeController::class, 'terms'])->name('terms');
Route::get('/certificates', [HomeController::class, 'certificates'])->name('certificates');

Route::get('/categories', [CatalogController::class, 'categories'])->name('categories.index');
Route::get('/group/{id}', [CatalogController::class, 'groupCategories'])->name('group.categories');
Route::get('/category/{slug}', [CatalogController::class, 'category'])->name('category.show');
Route::get('/products', [CatalogController::class, 'products'])->name('products.index');
Route::get('/product/{slug}', [CatalogController::class, 'product'])->name('products.show');
Route::get('/products/{slug}', function (string $slug) {
    return redirect()->route('products.show', $slug, 301);
});

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.index');
Route::get('/sitemap-{type}.xml', [SitemapController::class, 'section'])
    ->where('type', 'pages|categories|products|blogs')
    ->name('sitemap.section');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

Route::post('/enquiry', [InquiryController::class, 'contact'])->name('enquiry.store');
Route::post('/product-query', [InquiryController::class, 'product'])->name('product-query.store');
Route::post('/request-quote', [InquiryController::class, 'requestQuote'])->name('request-quote.store');
Route::post('/quote-enquiry', [InquiryController::class, 'quoteEnquiry'])->name('quote-enquiry.store');
