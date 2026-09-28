<?php

declare(strict_types=1);

test('unknown routes render the branded 404 page', function (): void {
    $this->get('/nothing-here')
        ->assertNotFound()
        ->assertSee("We couldn't find that page.", false);
});

test('robots.txt disallows case studies and points to the sitemap', function (): void {
    $response = $this->get('/robots.txt');

    $response->assertOk();
    $response->assertSee('Disallow: /case-studies', false);
    $response->assertSee('Sitemap: '.url('/sitemap.xml'), false);
});

test('every response carries baseline security headers', function (): void {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertHeader('X-Content-Type-Options', 'nosniff');
    $response->assertHeader('X-Frame-Options', 'DENY');
    $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
});

test('no route ever lists, shows, or exposes a lead', function (): void {
    $routeNames = collect(app('router')->getRoutes())
        ->map(fn ($route) => $route->getName())
        ->filter();

    expect($routeNames->filter(fn (string $name): bool => str_contains($name, 'lead')))->toBeEmpty();
});

test('every page has a favicon, apple touch icon, and og:image', function (): void {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('images/brand/icon-32.png', false);
    $response->assertSee('images/brand/icon-180.png', false);
    $response->assertSee('images/brand/og-image.png', false);
});

test('no analytics script renders until a provider is configured', function (): void {
    config(['services.analytics.script_url' => null]);

    $this->get('/')->assertDontSee('data-domain', false);
});

test('the analytics script renders once a provider is configured', function (): void {
    config([
        'services.analytics.script_url' => 'https://analytics.example/script.js',
        'services.analytics.domain' => 'amcoresystems.com',
    ]);

    $response = $this->get('/');

    $response->assertSee('data-domain="amcoresystems.com"', false);
    $response->assertSee('src="https://analytics.example/script.js"', false);
});

test('every page carries LocalBusiness structured data for Greenville SC', function (): void {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('LocalBusiness', false);
    $response->assertSee('Greenville', false);
});

test('sitemap.xml lists every indexable page', function (): void {
    $response = $this->get('/sitemap.xml');

    $response->assertOk();
    $response->assertSee(route('home'), false);
    $response->assertSee(route('contact'), false);
    $response->assertSee(route('privacy'), false);
    $response->assertDontSee(route('case-studies'), false);
});
