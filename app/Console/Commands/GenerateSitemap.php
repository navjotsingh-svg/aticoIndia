<?php

namespace App\Console\Commands;

use App\Services\SitemapService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate {--ping : Notify Google and Bing about the sitemap URL}';

    protected $description = 'Generate static XML sitemap files in public/ (optional; /sitemap.xml is served dynamically by default)';

    public function handle(SitemapService $sitemap): int
    {
        $baseUrl = $sitemap->baseUrl();

        if (! $this->isPublicUrl($baseUrl)) {
            $this->warn('APP_URL is not set to a public domain. Set APP_URL=https://dev.aticoindia.com in .env before generating static files.');
        }

        if ($this->option('ping') && ! $this->isPublicUrl($baseUrl)) {
            $this->error('Cannot ping search engines until APP_URL is set to your live domain.');

            return self::FAILURE;
        }

        $directory = public_path();

        $written = $sitemap->writeAll($directory);
        $sitemap->writeRobots($directory.'/robots.txt');

        $counts = collect($sitemap->sections())->map->count();

        foreach ($written as $filename => $path) {
            $this->line("Written: {$filename}");
        }

        $this->info('Sitemap summary:');
        $this->table(
            ['Section', 'URLs'],
            $counts->map(fn (int $count, string $type) => [$type, $count])->values()->all()
        );

        $this->info('Total URLs: '.$counts->sum());
        $this->info('Sitemap index: '.rtrim($sitemap->baseUrl(), '/').'/sitemap.xml');

        if ($this->option('ping')) {
            $this->pingSearchEngines($sitemap);
        }

        return self::SUCCESS;
    }

    private function isPublicUrl(string $url): bool
    {
        return $url !== '' && ! preg_match('#^https?://(localhost|127\.0\.0\.1)(:\d+)?$#i', $url);
    }

    private function pingSearchEngines(SitemapService $sitemap): void
    {
        $sitemapUrl = urlencode(rtrim($sitemap->baseUrl(), '/').'/sitemap.xml');
        $endpoints = [
            'Google' => "https://www.google.com/ping?sitemap={$sitemapUrl}",
            'Bing' => "https://www.bing.com/ping?sitemap={$sitemapUrl}",
        ];

        foreach ($endpoints as $engine => $endpoint) {
            try {
                $response = Http::timeout(15)->get($endpoint);
                $status = $response->successful() ? 'OK' : 'Failed ('.$response->status().')';
            } catch (\Throwable $exception) {
                $status = 'Failed ('.$exception->getMessage().')';
            }

            $this->line("Ping {$engine}: {$status}");
        }
    }
}
