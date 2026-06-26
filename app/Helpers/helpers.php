<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SidebarCategory;

function countriesList(): array
{
    return [
        'Afghanistan', 'Albania', 'Algeria', 'American Samoa', 'Andorra', 'Angola', 'Argentina',
        'Armenia', 'Australia', 'Austria', 'Azerbaijan', 'Bahrain', 'Bangladesh', 'Belgium',
        'Bhutan', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria', 'Cambodia', 'Cameroon', 'Canada',
        'Chile', 'China', 'Colombia', 'Congo', 'Croatia', 'Cyprus', 'Czech Republic', 'Denmark',
        'Djibouti', 'Egypt', 'Ethiopia', 'Finland', 'France', 'Germany', 'Ghana', 'Greece',
        'Hong Kong', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland',
        'Israel', 'Italy', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kuwait', 'Kyrgyzstan',
        'Laos', 'Latvia', 'Lebanon', 'Lithuania', 'Luxembourg', 'Malaysia', 'Maldives', 'Malta',
        'Mexico', 'Mongolia', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia', 'Nepal',
        'Netherlands', 'New Zealand', 'Nigeria', 'Norway', 'Oman', 'Pakistan', 'Palestine',
        'Panama', 'Papua New Guinea', 'Peru', 'Philippines', 'Poland', 'Portugal', 'Qatar',
        'Romania', 'Russia', 'Rwanda', 'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles',
        'Singapore', 'Slovakia', 'Slovenia', 'Somalia', 'South Africa', 'South Korea', 'Spain',
        'Sri Lanka', 'Sudan', 'Sweden', 'Switzerland', 'Syria', 'Taiwan', 'Tajikistan',
        'Tanzania', 'Thailand', 'Tunisia', 'Turkey', 'Turkmenistan', 'Uganda', 'Ukraine',
        'United Arab Emirates', 'United Kingdom', 'United States', 'Uruguay', 'Uzbekistan',
        'Vanuatu', 'Venezuela', 'Vietnam', 'Yemen', 'Zambia', 'Zimbabwe',
    ];
}

function groupMenuUrl(object $group): string
{
    if (($group->route ?? '') === 'global-engineering-tenders') {
        return '#';
    }

    return route('category.show', $group->route);
}

function sidebarCategories()
{
    $cats = SidebarCategory::query()
        ->join('categories', 'sidebar_categories.category_id', '=', 'categories.id')
        ->where('categories.status', 1)
        ->whereNull('categories.deleted_at')
        ->orderBy('sidebar_categories.id')
        ->select(
            'categories.id',
            'categories.name',
            'categories.short_name',
            'categories.slug',
        )
        ->get();

    foreach ($cats as $cat) {
        $cat->sub_cats = Category::query()
            ->where('parent_id', $cat->id)
            ->where('status', 1)
            ->whereNull('deleted_at')
            ->orderBy('name')
            ->select('id', 'name', 'short_name', 'slug')
            ->get();
    }

    return $cats;
}

function getAllProductCats(int $productId)
{
    $linked = ProductCategory::query()
        ->join('categories', 'product_categories.category_id', '=', 'categories.id')
        ->where('product_categories.product_id', $productId)
        ->where('categories.status', 1)
        ->whereNull('categories.deleted_at')
        ->select('categories.id', 'categories.name', 'categories.slug', 'categories.short_name', 'categories.parent_id')
        ->get();

    return $linked->map(function ($cat) {
        $current = $cat;

        while ($current->parent_id && $current->parent_id !== '0' && $current->parent_id !== 0) {
            $parent = Category::query()
                ->where('id', $current->parent_id)
                ->where('status', 1)
                ->whereNull('deleted_at')
                ->select('id', 'name', 'slug', 'short_name', 'parent_id')
                ->first();

            if (! $parent) {
                break;
            }

            $current = $parent;
        }

        return $current;
    })->unique('id')->values();
}

function getRelatedProducts(int $productId, int $limit = 8)
{
    $categoryIds = ProductCategory::query()
        ->where('product_id', $productId)
        ->pluck('category_id')
        ->toArray();

    if ($categoryIds === []) {
        return collect();
    }

    $expandedCategoryIds = collect($categoryIds);

    foreach ($categoryIds as $categoryId) {
        $category = Category::query()
            ->where('id', $categoryId)
            ->select('id', 'parent_id')
            ->first();

        if (! $category) {
            continue;
        }

        $childIds = Category::query()
            ->where('parent_id', $category->id)
            ->where('status', 1)
            ->whereNull('deleted_at')
            ->pluck('id');

        $expandedCategoryIds = $expandedCategoryIds->merge($childIds);

        if ($category->parent_id && $category->parent_id !== '0' && $category->parent_id !== 0) {
            $expandedCategoryIds->push($category->parent_id);

            $siblingIds = Category::query()
                ->where('parent_id', $category->parent_id)
                ->where('status', 1)
                ->whereNull('deleted_at')
                ->pluck('id');

            $expandedCategoryIds = $expandedCategoryIds->merge($siblingIds);
        }
    }

    $relatedIds = ProductCategory::query()
        ->whereIn('category_id', $expandedCategoryIds->unique()->values()->all())
        ->where('product_id', '!=', $productId)
        ->pluck('product_id')
        ->unique()
        ->values()
        ->toArray();

    return Product::query()
        ->whereIn('id', $relatedIds)
        ->where('status', 1)
        ->whereNull('deleted_at')
        ->latest('id')
        ->limit($limit)
        ->get(['id', 'name', 'slug', 'image', 'description', 'img_alt']);
}

function getGroups() {
    $groups = \App\Models\Group::where('status', 1)->orderBy('sort', 'asc')->select('id', 'route', 'sort', 'name', 'image', 'meta_description')->get();
    if(count($groups)>0){
        foreach ($groups as $key => $group) {
            $group['categories'] = \App\Models\GroupCategory::join('categories', 'group_categories.category_id', '=', 'categories.id')
            ->where('group_categories.group_id', $group->id)
            ->where('categories.status', 1)
            ->orderBy('categories.sort', 'asc')
            ->select('categories.id', 'categories.slug', 'categories.name', 'categories.short_name', 'categories.description', 'categories.image')
            ->get();

            foreach ($group['categories'] as $key => $sub_category) {
                $sub_category['sub_categories'] = \App\Models\Category::where('parent_id', $sub_category->id)
                ->where('status', 1)
                ->orderBy('name', 'asc')
                ->select('id', 'name', 'short_name', 'slug')
                ->get();
            }
        }
    }
    return $groups;
    //dd(groups);
}















?>