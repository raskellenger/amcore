<?php

declare(strict_types=1);

test('the home page shows the hero, pain points, pillars, and modules', function (): void {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('Paperwork is out.');
    $response->assertSee('Your system is in.');
    $response->assertSee('Book a Discovery Call');
    $response->assertSee('Hours lost re-typing the same work order three times.');
    $response->assertSee('Built around your shop.');
    $response->assertSee('Get the work');
    $response->assertSee('Know your numbers');
    $response->assertDontSee('weeks from kickoff');
    $response->assertDontSee('Build (about 2 weeks)');
    $response->assertSee('Built by people from the trades');
    $response->assertSee('See Websites');
});

test('the home hero is a video backdrop, not a stock photo', function (): void {
    $response = $this->get('/');

    $response->assertSee('videos/hero.mp4', false);
    $response->assertDontSee('New Customer or New Lead');
    $response->assertDontSee("I'm on a pile of apps", false);
    $response->assertDontSee('Greenville, SC · Built for the trades');
    $response->assertDontSee('home-hero');
    $response->assertDontSee('Napkin estimate');
});

test('the problem section covers hopping between systems and shared passwords', function (): void {
    $response = $this->get('/');

    $response->assertSee('Hopping between systems to track jobs, contacts, sales, and finances.');
    $response->assertSee('Multiple logins, probably all sharing the same password.');
});

test('the home page explains the operating system is an all-in-one', function (): void {
    $this->get('/')
        ->assertSee('Your books stay in QuickBooks.')
        ->assertDontSee('We run it for you.');
});

test('how we work lists undated stages with separate owner, field, and office discovery', function (): void {
    $response = $this->get('/how-we-work');

    $response->assertOk();
    $response->assertSee('Discovery with the owner');
    $response->assertSee('Discovery with the field');
    $response->assertSee('Discovery with the office');
});

test('the faq is written in the customer voice and drops the going-out-of-business question', function (): void {
    $response = $this->get('/faq');

    $response->assertOk();
    $response->assertSee('What if we decide to stop working with AmCore?');
    $response->assertSee('Do you charge by the seat?');
    $response->assertDontSee('goes out of business');
    $response->assertSee("We're all on paper. Can you move us?");
    $response->assertSee('We already use QuickBooks. What happens to it?');
});
