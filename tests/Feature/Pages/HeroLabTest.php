<?php

declare(strict_types=1);

test('the hero lab is an unindexed sandbox for four business-not-job ideas', function (): void {
    $response = $this->get('/hero-lab');

    $response->assertOk();
    $response->assertSee('noindex, nofollow', false);
    $response->assertSee('Run the business, not the job.');
    $response->assertSee('The puzzle');
    $response->assertSee('Solve the problem');
    $response->assertSee('Napkin estimate');
    $response->assertSee('The key ring');
    $response->assertSee('Pull the extra keys');
    $response->assertSee('Off your desk');
    $response->assertSee('Get out of the job');
    $response->assertSee('Your week');
    $response->assertSee('See the business');
    $response->assertDontSee('game-changer');
    $response->assertDontSee('seamless');
});
