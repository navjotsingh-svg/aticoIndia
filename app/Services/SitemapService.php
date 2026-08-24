<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Group;
use App\Models\Product;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;

class SitemapService
{
    /**
     * @return array<string, Collection<int, array{loc: string, lastmod: ?string, changefreq: string, priority: string}>>
     */
    public function sections(): array
    {
        return [
            'pages' => $this->pageUrls(),
            'categories' => $this->categoryUrls(),
            'products' => $this->productUrls(),
            'blogs' => $this->blogUrls(),
        ];
    }

    /**
     * @return array<int, array{loc: string, lastmod: ?string}>
     */
    public function indexEntries(): array
    {
        $base = rtrim(config('app.url'), '/');
        $now = now()->toAtomString();

        return collect($this->sections())
            ->map(function (Collection $urls, string $type) use ($base, $now): array {
                return [
                    'loc' => "{$base}/sitemap-{$type}.xml",
                    'lastmod' => $urls->max('lastmod') ?: $now,
                ];
            })
            ->values()
            ->all();
    }

    public function renderIndex(): string
    {
        return view('sitemap.index', [
            'sitemaps' => $this->indexEntries(),
        ])->render();
    }

    public function renderSection(string $type): string
    {
        $sections = $this->sections();

        if (! array_key_exists($type, $sections)) {
            abort(404);
        }

        return view('sitemap.urlset', [
            'urls' => $sections[$type],
        ])->render();
    }

    /**
     * @return array<string, string>
     */
    public function writeAll(string $directory): array
    {
        $written = [];

        $written['sitemap.xml'] = $this->writeFile(
            $directory.'/sitemap.xml',
            $this->renderIndex()
        );

        foreach ($this->sections() as $type => $urls) {
            $written["sitemap-{$type}.xml"] = $this->writeFile(
                $directory."/sitemap-{$type}.xml",
                view('sitemap.urlset', ['urls' => $urls])->render()
            );
        }

        return $written;
    }

    public function writeRobots(string $path): void
    {
        $sitemapUrl = rtrim(config('app.url'), '/').'/sitemap.xml';

        $content = implode(PHP_EOL, [
            'User-agent: *',
            'Allow: /',
            '',
            'Sitemap: '.$sitemapUrl,
            '',
        ]);

        file_put_contents($path, $content);
    }

    /**
     * @return Collection<int, array{loc: string, lastmod: ?string, changefreq: string, priority: string}>
     */
    private function pageUrls(): Collection
    {
        $pages = [
            ['route' => 'home', 'priority' => '1.0', 'changefreq' => 'daily'],
            ['route' => 'about', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['route' => 'faq', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['route' => 'lab-tenders', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['route' => 'contact', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['route' => 'terms', 'priority' => '0.4', 'changefreq' => 'yearly'],
            ['route' => 'certificates', 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['route' => 'categories.index', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['route' => 'products.index', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['route' => 'blog.index', 'priority' => '0.8', 'changefreq' => 'weekly'],
        ];

        return collect($pages)->map(fn (array $page): array => $this->entry(
            route($page['route']),
            null,
            $page['changefreq'],
            $page['priority'],
        ));
    }

    /**
     * @return Collection<int, array{loc: string, lastmod: ?string, changefreq: string, priority: string}>
     */
    private function categoryUrls(): Collection
    {
        $urls = Category::query()
            ->whereNull('deleted_at')
            ->where('status', 1)
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderBy('id')
            ->get(['slug', 'updated_at'])
            ->map(fn (Category $category): array => $this->entry(
                route('category.show', $category->slug),
                $category->updated_at,
                'weekly',
                '0.8',
            ));

        $groupUrls = Group::query()
            ->where('status', 1)
            ->where(function ($query): void {
                $query->whereNull('route')->orWhere('route', '');
            })
            ->orderBy('id')
            ->get(['id', 'updated_at'])
            ->map(fn (Group $group): array => $this->entry(
                route('group.categories', $group->id),
                $group->updated_at,
                'weekly',
                '0.7',
            ));

        return $urls->merge($groupUrls)->unique('loc')->values();
    }

    /**
     * @return Collection<int, array{loc: string, lastmod: ?string, changefreq: string, priority: string}>
     */
    private function productUrls(): Collection
    {
        return Product::query()
            ->whereNull('deleted_at')
            ->where('status', 1)
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderBy('id')
            ->get(['slug', 'updated_at'])
            ->map(fn (Product $product): array => $this->entry(
                route('products.show', $product->slug),
                $product->updated_at,
                'weekly',
                '0.6',
            ));
    }

    /**
     * @return Collection<int, array{loc: string, lastmod: ?string, changefreq: string, priority: string}>
     */
    private function blogUrls(): Collection
    {
        return Blog::query()
            ->whereNull('deleted_at')
            ->where('status', 1)
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderByDesc('id')
            ->get(['slug', 'updated_at'])
            ->map(fn (Blog $blog): array => $this->entry(
                route('blog.show', $blog->slug),
                $blog->updated_at,
                'monthly',
                '0.7',
            ));
    }

    /**
     * @return array{loc: string, lastmod: ?string, changefreq: string, priority: string}
     */
    private function entry(
        string $loc,
        mixed $lastmod,
        string $changefreq,
        string $priority,
    ): array {
        return [
            'loc' => $loc,
            'lastmod' => $this->formatLastmod($lastmod),
            'changefreq' => $changefreq,
            'priority' => $priority,
        ];
    }

    private function formatLastmod(mixed $value): ?string
    {
        if ($value instanceof CarbonInterface) {
            return $value->toAtomString();
        }

        if (is_string($value) && $value !== '') {
            return date(DATE_ATOM, strtotime($value));
        }

        return null;
    }

    private function writeFile(string $path, string $contents): string
    {
        file_put_contents($path, $contents);

        return $path;
    }
}
