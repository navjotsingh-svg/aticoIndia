<?php

namespace App\Http\Controllers;

use App\Services\SitemapService;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __construct(
        private readonly SitemapService $sitemap,
    ) {}

    public function index(): Response
    {
        return $this->xmlResponse($this->sitemap->renderIndex());
    }

    public function section(string $type): Response
    {
        return $this->xmlResponse($this->sitemap->renderSection($type));
    }

    private function xmlResponse(string $content): Response
    {
        return response($content, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
