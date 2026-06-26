<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DynamicShortcode
{
    public static $map = [
        'productlist' => 'shortcodes.productlist',
        'product'     => 'shortcodes.product-single',
    ];

    /**
     * Render shortcodes inside $content.
     *
     * @param string $content
     * @param array $context  Optional associative array of context values (e.g. ['blog' => $blog, 'blog_id' => $blog->id])
     * @return string
     */
    public static function render($content, $context = [])
    {
        return preg_replace_callback('/\[(\w+)(.*?)\]/s', function ($m) use ($context) {

            $code = strtolower($m[1]);
            $attrString = trim($m[2] ?? '');
            $attrs = self::parseAttributes($attrString);

            // Resolve placeholder tokens in attributes using $context
            $attrs = self::resolvePlaceholders($attrs, $context);

            $viewVars = $attrs;
            $view = $attrs['view'] ?? (self::$map[$code] ?? null);
            if (!$view || !view()->exists($view)) {
                return $m[0]; // return original token if view missing
            }

            try {
                // Detect Product model (common namespaces)
                $possibleProduct = ['App\Product', 'App\\Models\\Product'];
                $ProductClass = null;
                foreach ($possibleProduct as $p) {
                    if (class_exists($p)) {
                        $ProductClass = $p;
                        break;
                    }
                }

                if (!$ProductClass) {
                    return view($view, $viewVars)->render();
                }

                $P = $ProductClass;

                // Single product by id
                if (!empty($attrs['id'])) {
                    $product = $P::find($attrs['id']);
                    $viewVars['product'] = $product;
                    return view($view, $viewVars)->render();
                }

                // ids list
                if (!empty($attrs['ids'])) {
                    $ids = array_values(array_filter(array_map('trim', explode(',', $attrs['ids']))));
                    $products = $P::whereIn('id', $ids)
                        ->orderByRaw("FIELD(id," . implode(',', $ids) . ")")
                        ->get();
                    $viewVars['products'] = $products;
                    return view($view, $viewVars)->render();
                }

                // Special case: blog_id => your exact query using BlogCategory and product_categories pivot
                if (!empty($attrs['blog_id'])) {
                    $possibleBlogCategory = ['App\BlogCategory', 'App\\Models\\BlogCategory'];
                    $BlogCategoryClass = null;
                    foreach ($possibleBlogCategory as $bc) {
                        if (class_exists($bc)) {
                            $BlogCategoryClass = $bc;
                            break;
                        }
                    }

                    if ($BlogCategoryClass) {
                        $categoryIds = $BlogCategoryClass::where('blog_id', $attrs['blog_id'])->pluck('category_id');
                    } else {
                        $categoryIds = DB::table('blog_categories')->where('blog_id', $attrs['blog_id'])->pluck('category_id');
                    }

                    if (empty($categoryIds) || collect($categoryIds)->isEmpty()) {
                        $viewVars['products'] = collect();
                        return view($view, $viewVars)->render();
                    }

                    $productIds = DB::table('product_categories')
                        ->whereIn('category_id', $categoryIds)
                        ->pluck('product_id')
                        ->unique()
                        ->values();

                    if ($productIds->isEmpty()) {
                        $viewVars['products'] = collect();
                        return view($view, $viewVars)->render();
                    }

                    $query = $P::whereIn('id', $productIds);

                    $orderBy = $attrs['order'] ?? '-created_at';
                    $dir = 'asc';
                    $col = $orderBy;
                    if (Str::startsWith($orderBy, '-')) {
                        $dir = 'desc';
                        $col = ltrim($orderBy, '-');
                    }
                    try {
                        $query->orderBy($col, $dir);
                    } catch (\Exception $e) {
                        $query->orderBy('created_at', 'desc');
                    }

                    $perPage = isset($attrs['limit']) ? (int)$attrs['limit'] : 12;
                    $products = $query->paginate($perPage);

                    $viewVars['products'] = $products;
                    return view($view, $viewVars)->render();
                }

                // Default listing
                $query = $P::query();

                if (!empty($attrs['category'])) {
                    $query->where('category_id', $attrs['category']);
                }
                if (!empty($attrs['slug'])) {
                    $query->where('slug', $attrs['slug']);
                }
                if (!empty($attrs['search'])) {
                    $s = $attrs['search'];
                    $query->where(function($q) use ($s) {
                        $q->where('name', 'like', "%{$s}%")
                          ->orWhere('description', 'like', "%{$s}%");
                    });
                }

                $orderBy = $attrs['order'] ?? '-created_at';
                $dir = 'asc';
                $col = $orderBy;
                if (Str::startsWith($orderBy, '-')) {
                    $dir = 'desc';
                    $col = ltrim($orderBy, '-');
                }
                try {
                    $query->orderBy($col, $dir);
                } catch (\Exception $e) {
                    $query->orderBy('created_at', 'desc');
                }

                if (isset($attrs['paginate']) && in_array(strtolower($attrs['paginate']), ['0','false','no'])) {
                    $limit = isset($attrs['limit']) ? (int)$attrs['limit'] : 6;
                    $products = $query->limit($limit)->get();
                } else {
                    $perPage = isset($attrs['limit']) ? (int)$attrs['limit'] : 6;
                    $products = $query->paginate($perPage);
                }

                $viewVars['products'] = $products;
                return view($view, $viewVars)->render();

            } catch (\Exception $e) {
                return $m[0]; // if an error occurs, keep the original shortcode
            }

        }, $content);
    }

    /**
     * Parse attributes like id="5" ids='1,2,3' limit=6 flag
     */
    protected static function parseAttributes($text)
    {
        $attrs = [];
        if (!$text) return $attrs;

        $pattern = '/(\w+)\s*=\s*"([^"]*)"|(\w+)\s*=\s*\'([^\']*)\'|(\w+)\s*=\s*([^\s"\']+)|(\w+)/';
        preg_match_all($pattern, $text, $matches, PREG_SET_ORDER);

        foreach ($matches as $m) {
            if (!empty($m[1])) {
                $attrs[$m[1]] = $m[2];
            } elseif (!empty($m[3])) {
                $attrs[$m[3]] = $m[4];
            } elseif (!empty($m[5])) {
                $attrs[$m[5]] = $m[6];
            } elseif (!empty($m[7])) {
                $attrs[$m[7]] = true;
            }
        }

        return $attrs;
    }

    /**
     * Replace placeholder tokens in attribute values with values from $context.
     * Supported placeholder forms:
     *   {blog_id}     -> looks for $context['blog_id']
     *   {blog.id}     -> dot notation: $context['blog']->id or $context['blog']['id']
     *   {{ blog.id }} -> spaced curly braces also supported
     *
     * @param array $attrs
     * @param array $context
     * @return array
     */
    protected static function resolvePlaceholders(array $attrs, array $context)
    {
        foreach ($attrs as $k => $v) {
            if (!is_string($v)) {
                continue;
            }

            // detect single or double curlies: {key}, {{ key }}, {key.sub}
            if (preg_match('/^\s*\{\{\s*([a-zA-Z0-9_.]+)\s*\}\}\s*$/', $v, $m) ||
                preg_match('/^\s*\{\s*([a-zA-Z0-9_.]+)\s*\}\s*$/', $v, $m)) {

                $key = $m[1];

                // get value from context (support dot notation)
                $replacement = self::getContextValue($context, $key);

                // if found, convert to string / numeric; else keep original
                if (!is_null($replacement)) {
                    $attrs[$k] = $replacement;
                }
            }
        }

        return $attrs;
    }

    /**
     * Resolve a dot-notated key against context.
     * Example keys: blog_id  OR blog.id OR blog.author.email
     *
     * Supports arrays and objects.
     */
    protected static function getContextValue(array $context, $dotKey)
    {
        $parts = explode('.', $dotKey);
        $first = array_shift($parts);

        if (!array_key_exists($first, $context)) {
            return null;
        }

        $value = $context[$first];

        foreach ($parts as $part) {
            if (is_array($value) && array_key_exists($part, $value)) {
                $value = $value[$part];
            } elseif (is_object($value) && isset($value->{$part})) {
                $value = $value->{$part};
            } else {
                return null;
            }
        }

        return $value;
    }
}
