<?php

declare(strict_types=1);

test('every marketing page responds with 200 and a unique title', function (string $uri, string $titleFragment): void {
    $response = $this->get($uri);

    $response->assertOk();
    $response->assertSee($titleFragment);
})->with([
    'home' => ['/', 'AmCore Systems'],
    'operating systems' => ['/operating-systems', 'Operating Systems'],
    'websites' => ['/websites', 'Websites'],
    'how we work' => ['/how-we-work', 'How We Work'],
    'about' => ['/about', 'About'],
    'faq' => ['/faq', 'FAQ'],
    'contact' => ['/contact', 'Book a Discovery Call'],
    'case studies' => ['/case-studies', 'Case Studies'],
    'privacy' => ['/privacy', 'Privacy Policy'],
    'terms' => ['/terms', 'Terms of Use'],
]);

test('the case studies page is not indexed', function (): void {
    $this->get('/case-studies')->assertSee('noindex, nofollow', false);
});

test('other pages do not carry the noindex tag', function (): void {
    $this->get('/')->assertDontSee('noindex, nofollow', false);
});

test('every indexable page has its own unique meta description', function (): void {
    $descriptions = collect([
        '/', '/operating-systems', '/websites', '/how-we-work', '/about', '/faq', '/contact', '/privacy', '/terms',
    ])->map(function (string $uri): string {
        preg_match('/<meta name="description" content="([^"]+)">/', $this->get($uri)->getContent(), $matches);

        return $matches[1] ?? '';
    });

    expect($descriptions)->each->not->toBeEmpty();
    expect($descriptions->unique())->toHaveCount($descriptions->count());
});
