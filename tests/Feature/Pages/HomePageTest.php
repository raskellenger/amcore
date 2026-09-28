<?php

declare(strict_types=1);

test('the home page shows the hero, pain points, pillars, modules, and timeline', function (): void {
    $response = $this->get('/');

    $response->assertOk();
    $response->assertSee('Operating systems for the trades.');
    $response->assertSee('Book a Discovery Call');
    $response->assertSee('Hours lost re-typing the same work order three times.');
    $response->assertSee('Built for the people doing the work.');
    $response->assertSee('Work Orders');
    $response->assertSee('Notifications & Messaging');
    $response->assertSee('Discovery at your shop');
    $response->assertSee('Built by people from the trades');
    $response->assertSee('See Websites');
});
