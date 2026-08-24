<?php

namespace App\Console\Commands;

use App\Services\SitemapService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate {--ping : Notify Google and Bing about the sitemap URL}';

    protected $description = 'Generate XML sitemap files in public/ and update robots.txt';

    public function handle(SitemapService $sitemap): int
    {
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
        $this->info('Sitemap index: '.rtrim(config('app.url'), '/').'/sitemap.xml');

        if ($this->option('ping')) {
            $this->pingSearchEngines();
        }

        return self::SUCCESS;
    }

    private function pingSearchEngines(): void
    {
        $sitemapUrl = urlencode(rtrim(config('app.url'), '/').'/sitemap.xml');
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
