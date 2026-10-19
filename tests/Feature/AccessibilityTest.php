<?php

declare(strict_types=1);

test('no page uses a sub-AA-contrast text opacity utility', function (): void {
    $bannedClasses = ['text-ink/40', 'text-ink/45', 'text-ink/50', 'text-ink/55', 'text-ink/60'];

    $pages = glob(resource_path('views/livewire/pages/*.blade.php'));
    $pages[] = resource_path('views/components/layouts/app.blade.php');

    foreach ($pages as $path) {
        $contents = file_get_contents($path);

        foreach ($bannedClasses as $class) {
            expect($contents)->not->toContain($class, "{$path} uses {$class}, which fails WCAG AA contrast against our cream background.");
        }
    }
});
