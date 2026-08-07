<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Group;
use App\Models\GroupCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function categories()
    {
        $categories = Category::query()
            ->whereNull('deleted_at')
            ->where('status', 1)
            ->where(function ($query): void {
                $query->where('parent_id', 0)
                    ->orWhere('parent_id', '0')
                    ->orWhereNull('parent_id');
            })
            ->orderByDesc('id')
            ->get(['id', 'name', 'short_name', 'slug', 'description', 'image', 'img_alt']);

        return view('catalog.categories', compact('categories'));
    }

    public function groupCategories(int $id)
    {
        $group = Group::query()
            ->where('status', 1)
            ->findOrFail($id);

        if (! empty($group->route)) {
            return redirect()->route('category.show', $group->route, 301);
        }

        $categories = GroupCategory::query()
            ->join('categories', 'group_categories.category_id', '=', 'categories.id')
            ->where('group_categories.group_id', $group->id)
            ->where('categories.status', 1)
            ->whereNull('categories.deleted_at')
            ->orderBy('categories.sort')
            ->select(
                'categories.id',
                'categories.name',
                'categories.short_name',
                'categories.slug',
                'categories.description',
                'categories.image',
                'categories.img_alt',
            )
            ->get();

        $groupContent = null;

        if (! empty($group->route)) {
            $groupContent = Category::query()
                ->whereNull('deleted_at')
                ->where('status', 1)
                ->where('slug', $group->route)
                ->first([
                    'id',
                    'name',
                    'slug',
                    'description',
                    'image',
                    'img_alt',
                    'meta_title',
                    'meta_description',
                ]);
        }

        return view('catalog.group-categories', compact('categories', 'group', 'groupContent'));
    }

    public function category(Request $request, string $slug)
    {
        $category = Category::query()
            ->whereNull('deleted_at')
            ->where('status', 1)
            ->where('slug', $slug)
            ->firstOrFail();

        $menuGroup = Group::query()
            ->where('status', 1)
            ->where('route', $slug)
            ->first();

        $isGroupLanding = $menuGroup !== null;

        if ($isGroupLanding) {
            $childCategories = GroupCategory::query()
                ->join('categories', 'group_categories.category_id', '=', 'categories.id')
                ->where('group_categories.group_id', $menuGroup->id)
                ->where('categories.status', 1)
                ->whereNull('categories.deleted_at')
                ->orderBy('categories.sort')
                ->select(
                    'categories.id',
                    'categories.name',
                    'categories.short_name',
                    'categories.slug',
                    'categories.description',
                    'categories.image',
                    'categories.img_alt',
                )
                ->get();

            $categoryIdsForProducts = $this->categoryIdsForProductListing(
                (int) $category->id,
                $childCategories
            );
        } else {
            $childCategories = Category::query()
                ->whereNull('deleted_at')
                ->where('status', 1)
                ->where('parent_id', $category->id)
                ->orderBy('name')
                ->get(['id', 'name', 'short_name', 'slug', 'description', 'image', 'img_alt']);

            $categoryIdsForProducts = $this->categoryIdsForProductListing(
                (int) $category->id,
                $childCategories
            );
        }

        $productIds = DB::table('product_categories')
            ->whereIn('category_id', $categoryIdsForProducts)
            ->pluck('product_id')
            ->unique()
            ->values();

        $search = trim((string) $request->query('search', ''));

        $products = Product::query()
            ->whereNull('deleted_at')
            ->whereIn('id', $productIds)
            ->where('status', 1)
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($inner) use ($search): void {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('product_code', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->latest('id')
            ->paginate(24)
            ->withQueryString();

        $groups = \App\Models\Group::where('status', 1)->orderBy('sort', 'asc')->select('id', 'route', 'sort', 'name')->get();
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
        return view('catalog.category-products', compact('category', 'products', 'search', 'groups', 'childCategories', 'isGroupLanding'));
    }

    public function products(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $products = Product::query()
            ->whereNull('deleted_at')
            ->where('status', 1)
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($inner) use ($search): void {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('product_code', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->latest('id')
            ->paginate(24)
            ->withQueryString();

            $groups = \App\Models\Group::where('status', 1)->orderBy('sort', 'asc')->select('id', 'route', 'sort', 'name')->get();
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

        return view('catalog.products', compact('products', 'search', 'groups'));
    }

    public function product(string $slug)
    {
        $product = Product::query()
            ->whereNull('deleted_at')
            ->where('slug', $slug)
            ->firstOrFail();

            $groups = \App\Models\Group::where('status', 1)->orderBy('sort', 'asc')->select('id', 'route', 'sort', 'name')->get();
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

        return view('catalog.product', compact('product', 'groups'));
    }

    /**
     * Use products from the category itself; if none exist, include subcategory trees.
     *
     * @param  \Illuminate\Support\Collection<int, object>|array<int, object>  $childCategories
     * @return array<int, int>
     */
    private function categoryIdsForProductListing(int $categoryId, $childCategories): array
    {
        $hasDirectProducts = DB::table('product_categories')
            ->where('category_id', $categoryId)
            ->exists();

        if ($hasDirectProducts) {
            return [$categoryId];
        }

        $childIds = collect($childCategories)
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->filter()
            ->values()
            ->all();

        if ($childIds === []) {
            return [$categoryId];
        }

        $subcategoryTreeIds = [];

        foreach ($childIds as $childId) {
            $subcategoryTreeIds[] = $childId;
            $subcategoryTreeIds = array_merge(
                $subcategoryTreeIds,
                $this->descendantCategoryIds($childId)
            );
        }

        return array_values(array_unique($subcategoryTreeIds));
    }

    /**
     * @return array<int, int>
     */
    private function descendantCategoryIds(int $categoryId): array
    {
        $descendants = [];
        $queue = [$categoryId];

        while ($queue !== []) {
            $currentId = array_shift($queue);

            $children = Category::query()
                ->whereNull('deleted_at')
                ->where('status', 1)
                ->where('parent_id', $currentId)
                ->pluck('id')
                ->all();

            foreach ($children as $childId) {
                $childId = (int) $childId;

                if (! in_array($childId, $descendants, true)) {
                    $descendants[] = $childId;
                    $queue[] = $childId;
                }
            }
        }

        return $descendants;
    }
}
