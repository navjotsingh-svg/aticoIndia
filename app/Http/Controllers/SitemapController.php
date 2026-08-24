<?php

namespace App\Http\Controllers;

use App\Services\SitemapService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function __construct(
        private readonly SitemapService $sitemap,
    ) {}

    public function index(Request $request): Response
    {
        $this->prepareBaseUrl($request);

        return $this->xmlResponse($this->sitemap->renderIndex($request));
    }

    public function section(Request $request, string $type): Response
    {
        $this->prepareBaseUrl($request);

        return $this->xmlResponse($this->sitemap->renderSection($type, $request));
    }

    public function robots(Request $request): Response
    {
        $this->prepareBaseUrl($request);

        $sitemapUrl = rtrim($this->sitemap->baseUrl(), '/').'/sitemap.xml';

        $content = implode(PHP_EOL, [
            'User-agent: *',
            'Allow: /',
            '',
            'Sitemap: '.$sitemapUrl,
            '',
        ]);

        return response($content, 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    private function prepareBaseUrl(Request $request): void
    {
        URL::forceRootUrl($this->sitemap->baseUrl($request));
    }

    private function xmlResponse(string $content): Response
    {
        return response($content, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
