<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;

test('every file in public/images/brand is actually referenced somewhere', function (): void {
    $brandFiles = File::files(public_path('images/brand'));

    $haystack = collect(File::allFiles(resource_path('views')))
        ->push(...File::allFiles(resource_path('css')))
        ->map(fn ($file): string => $file->getContents())
        ->implode("\n");

    foreach ($brandFiles as $file) {
        $this->assertStringContainsString(
            $file->getFilename(),
            $haystack,
            "public/images/brand/{$file->getFilename()} exists but is never referenced — remove it or wire it in."
        );
    }
});
