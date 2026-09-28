<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/robots.txt', fn () => response(
    "User-agent: *\nDisallow: /case-studies\n\nSitemap: ".url('/sitemap.xml')."\n"
)->header('Content-Type', 'text/plain'))->name('robots');

Route::get('/sitemap.xml', function () {
    $routes = ['home', 'operating-systems', 'websites', 'how-we-work', 'about', 'faq', 'contact', 'privacy', 'terms'];

    $urls = collect($routes)->map(fn (string $name): string => '    <url><loc>'.route($name).'</loc></url>')->implode("\n");

    return response(
        "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n{$urls}\n</urlset>\n"
    )->header('Content-Type', 'application/xml');
})->name('sitemap');

Volt::route('/', 'pages.home')->name('home');
Volt::route('/operating-systems', 'pages.operating-systems')->name('operating-systems');
Volt::route('/websites', 'pages.websites')->name('websites');
Volt::route('/how-we-work', 'pages.how-we-work')->name('how-we-work');
Volt::route('/about', 'pages.about')->name('about');
Volt::route('/faq', 'pages.faq')->name('faq');
Volt::route('/contact', 'pages.contact')->name('contact');
Volt::route('/case-studies', 'pages.case-studies')->name('case-studies');
Volt::route('/privacy', 'pages.privacy')->name('privacy');
Volt::route('/terms', 'pages.terms')->name('terms');
