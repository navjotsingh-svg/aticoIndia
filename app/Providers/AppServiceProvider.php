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
        $this->forgetStaleRouteCache();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.atico');

        View::share('countries', countriesList());

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
                'sidebarCategories' => sidebarCategories(),
            ]);
        };

        View::composer([
            'layouts.app',
            'home',
            'catalog.*',
            'blog.*',
            'contact',
            'faq',
            'lab-tenders',
            'terms-service',
            'certificates',
            'about',
            'errors.*',
        ], $catalogNav);

        View::composer('errors.404', function ($view): void {
            $view->with(
                'featuredCategories',
                Category::query()
                    ->whereNull('deleted_at')
                    ->where('status', 1)
                    ->whereIn('parent_id', ['0', 0, null])
                    ->orderBy('sort')
                    ->limit(8)
                    ->get()
            );
        });
    }

    /**
     * Drop a cached route file that predates the sitemap routes.
     * Laravel will keep serving the old cache until it is removed.
     */
    private function forgetStaleRouteCache(): void
    {
        $cached = $this->app->getCachedRoutesPath();

        if (! is_file($cached)) {
            return;
        }

        $contents = (string) @file_get_contents($cached);

        if ($contents !== '' && ! str_contains($contents, 'sitemap.index')) {
            @unlink($cached);
        }
    }
}
