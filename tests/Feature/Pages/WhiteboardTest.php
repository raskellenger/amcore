<?php

declare(strict_types=1);

use App\Actions\Whiteboard\WhiteboardDocument;
use Illuminate\Support\Facades\File;
use Livewire\Volt\Volt;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

function whiteboardFixture(): string
{
    $path = storage_path('framework/testing/whiteboard.md');

    File::ensureDirectoryExists(dirname($path));
    File::put($path, <<<'MD'
# AmCore site whiteboard

Shared board.

## Decisions made
- Product is called the operating system.

## Open questions (David / Alexander)
- [ ] Do we replace QuickBooks, or connect to it?

## Ideas: Claude
- C1. Home hero stays a draft until David picks.

## Ideas: Grok
- G1. Ship the puzzle.

## Ideas: David / Alexander
(Write on the board. Real-world stuff we'd never think of goes here.)

## Next up
- [ ] Review the labs.

MD);

    config(['amcore.whiteboard_path' => $path]);

    return $path;
}

test('the whiteboard shows the shared notes and is not public', function (): void {
    whiteboardFixture();

    $response = $this->get('/whiteboard');

    $response->assertOk();
    $response->assertSee('noindex, nofollow', false);
    $response->assertSee('C1. Home hero stays a draft until David picks.');
    $response->assertSee('G1. Ship the puzzle.');
    $response->assertSee('Do we replace QuickBooks, or connect to it?');
    $response->assertSee('Your note');
    $response->assertSee('Add to the board');
    $response->assertSee('Ideas: David / Alexander');

    $this->get('/sitemap.xml')->assertDontSee('/whiteboard', false);
});

test('a note from the board is appended to the markdown and other lanes stay put', function (): void {
    $path = whiteboardFixture();
    $real = file_get_contents(base_path('WHITEBOARD.md'));

    Volt::test('pages.whiteboard')
        ->set('note', "Crews start at seven.\nNot at the office.")
        ->set('author', 'david')
        ->set('lane', 'ideas')
        ->call('addNote')
        ->assertHasNoErrors()
        ->assertSet('note', '')
        ->assertSee('D1. Crews start at seven. Not at the office.');

    $saved = file_get_contents($path);

    expect($saved)->toContain('- [ ] D1. Crews start at seven. Not at the office.')
        ->and($saved)->toContain('- C1. Home hero stays a draft until David picks.')
        ->and($saved)->toContain('- G1. Ship the puzzle.')
        ->and($saved)->not->toContain('Write on the board')
        ->and(substr_count($saved, "\n## "))->toBe(6);

    Volt::test('pages.whiteboard')
        ->set('note', 'Alexander: the shop still has the paper board.')
        ->set('author', 'alexander')
        ->set('lane', 'ideas')
        ->call('addNote')
        ->assertHasNoErrors();

    expect(file_get_contents($path))->toContain('- [ ] A1. Alexander: the shop still has the paper board.');
    expect(file_get_contents(base_path('WHITEBOARD.md')))->toBe($real);
});

test('an empty note is refused and the file is left alone', function (): void {
    $path = whiteboardFixture();
    $before = file_get_contents($path);

    Volt::test('pages.whiteboard')
        ->set('note', "   \n")
        ->call('addNote')
        ->assertHasErrors(['note'])
        ->assertSee('Write a note before adding it to the board.');

    expect(file_get_contents($path))->toBe($before);
});

test('checking a box marks that line done and does not rewrite another lane', function (): void {
    $path = whiteboardFixture();

    Volt::test('pages.whiteboard')
        ->call('toggle', 'Open questions (David / Alexander)', '- [ ] Do we replace QuickBooks, or connect to it?')
        ->assertHasNoErrors();

    $saved = file_get_contents($path);

    expect($saved)->toContain('- [x] Do we replace QuickBooks, or connect to it?')
        ->and($saved)->toContain('- C1. Home hero stays a draft until David picks.');

    Volt::test('pages.whiteboard')
        ->call('toggle', 'Ideas: Claude', '- C1. Home hero stays a draft until David picks.')
        ->assertHasErrors(['board']);

    expect(file_get_contents($path))->toBe($saved);
});

test('the whiteboard is closed outside the local site', function (): void {
    $path = whiteboardFixture();
    $before = file_get_contents($path);

    app()['env'] = 'production';

    $this->get('/whiteboard')->assertNotFound();

    expect(fn () => WhiteboardDocument::fromConfig()->append('Do not write this.', 'ideas', 'david'))
        ->toThrow(NotFoundHttpException::class);

    expect(file_get_contents($path))->toBe($before);
});
