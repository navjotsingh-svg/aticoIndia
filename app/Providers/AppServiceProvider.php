<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.atico');

        $catalogNav = function ($view): void {
            $allCategories = Category::query()
                ->whereNull('deleted_at')
                ->where('status', 1)
                ->select(['id', 'name', 'short_name', 'slug', 'parent_id', 'sort'])
                ->orderBy('sort')
                ->get();

            $byParent = $allCategories->groupBy(
                fn (Category $category): string => (string) ($category->parent_id ?? '0')
            );

            $rootCategories = $byParent->get('0', collect())->values();

            $menuCategories = $rootCategories
                ->map(function (Category $category) use ($byParent): Category {
                    $category->children = $byParent->get((string) $category->id, collect())->take(14)->values();
                    return $category;
                })
                ->take(10)
                ->values();

            $footerCategories = $rootCategories
                ->map(function (Category $category) use ($byParent): Category {
                    $category->children = $byParent->get((string) $category->id, collect())->values();
                    return $category;
                })
                ->values();

            $view->with([
                'menuCategories' => $menuCategories,
                'footerCategories' => $footerCategories,
                'groups' => getGroups(),
                'countries' => countriesList(),
                'sidebarCategories' => sidebarCategories(),
            ]);
        };

        View::composer([
            'layouts.app',
            'home',
            'catalog.*',
            'blog.*',
        ], $catalogNav);
    }
}
