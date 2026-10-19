<?php

declare(strict_types=1);

test('stock draft photos never render outside the local environment', function (): void {
    // The suite boots as "testing", so stock-draft images must not appear even though the files exist locally.
    $this->get('/')->assertOk()->assertDontSee('stock-draft', false)->assertSee('[PLACEHOLDER: photo]', false);
});

test('the stock draft folder is git-ignored so it cannot be committed', function (): void {
    expect(file_get_contents(base_path('.gitignore')))->toContain('/public/images/stock-draft/');
});
