<?php

namespace App\Http\Middleware;

use App\Http\Controllers\SitemapController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServeSitemap
{
    /**
     * Serve sitemap and robots responses before route matching.
     *
     * Hostinger/LiteSpeed often keeps a stale `route:cache` after deploys.
     * This middleware keeps /sitemap.xml and /robots.txt working even when
     * those routes are missing from the cached route file.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethod('GET') && ! $request->isMethod('HEAD')) {
            return $next($request);
        }

        $path = ltrim($request->getPathInfo(), '/');
        $controller = app(SitemapController::class);

        if ($path === 'sitemap.xml') {
            return $controller->index($request);
        }

        if (preg_match('/^sitemap-(pages|categories|products|blogs)\.xml$/', $path, $matches) === 1) {
            return $controller->section($request, $matches[1]);
        }

        if ($path === 'robots.txt') {
            return $controller->robots($request);
        }

        return $next($request);
    }
}
