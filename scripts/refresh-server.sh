#!/usr/bin/env bash
set -euo pipefail

# Run from the Laravel project root on the server, e.g.:
# cd /path/to/atico-india && bash scripts/refresh-server.sh

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT_DIR"

echo "==> Refreshing Laravel caches..."
php artisan optimize:clear
php artisan view:clear
php artisan config:clear
php artisan route:clear
php artisan cache:clear

echo "==> Running database migrations..."
php artisan migrate --force

echo "==> Removing stale static sitemap/robots files (sitemap is served dynamically)..."
rm -f public/sitemap.xml public/sitemap-*.xml public/robots.txt

echo "==> Rebuilding optimized caches (optional, for production)..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Done."
echo "If changes still do not appear, restart PHP-FPM/Apache and hard-refresh the browser (Ctrl+Shift+R)."
