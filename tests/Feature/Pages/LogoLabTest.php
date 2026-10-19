<?php

declare(strict_types=1);

test('the logo lab is an unindexed set of A marks', function (): void {
    $response = $this->get('/logo-lab');

    $response->assertOk();
    $response->assertSee('noindex, nofollow', false);
    $response->assertSee('The keystone');
    $response->assertSee('The level');
    $response->assertSee('The through-line');
    $response->assertSee('The rafter');
    $response->assertSee('AmCore');
});
