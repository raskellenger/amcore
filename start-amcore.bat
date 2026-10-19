@echo off
cd /d "%~dp0"
echo AmCore local site: http://127.0.0.1:8000  (hero lab: /hero-lab)
php artisan serve --host=127.0.0.1 --port=8000
