<?php

namespace App\Helpers;

use App\Product;
use App\BlogCategory;
use Illuminate\Support\Facades\DB;

class Shortcode
{
    public static function renderProducts($content, $blog)
    {
        // If no shortcode, return content as-is
        if (strpos($content, '[products]') === false) {
            return $content;
        }

        // Get selected categories
        $categoryIds = BlogCategory::where('blog_id', $blog->id)
            ->pluck('category_id');

        if ($categoryIds->isEmpty()) {
            return str_replace('[products]', '', $content);
        }

        // Get product IDs
        $productIds = DB::table('product_categories')
            ->whereIn('category_id', $categoryIds)
            ->pluck('product_id')
            ->unique();

        if ($productIds->isEmpty()) {
            return str_replace('[products]', '', $content);
        }

        // Get products
        $products = Product::whereIn('id', $productIds)->paginate(12);

        // Render blade
        $html = view('shortcodes.products', compact('products'))->render();

        // Replace shortcode with HTML
        return str_replace('[products]', $html, $content);
    }
}
