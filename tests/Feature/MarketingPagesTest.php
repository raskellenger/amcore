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
