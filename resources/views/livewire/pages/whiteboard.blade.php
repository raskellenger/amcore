<?php

use App\Actions\Whiteboard\WhiteboardDocument;
use function Livewire\Volt\{computed, layout, mount, state, title};

layout('components.layouts.app');
title('Whiteboard — AmCore Systems');

view()->share('description', 'Internal whiteboard for AmCore. Not linked, not indexed.');

state([
    'note' => '',
    'author' => 'david',
    'lane' => 'ideas',
    'added' => '',
]);

mount(function (): void {
    abort_unless(app()->environment(['local', 'testing']), 404);
});

$board = computed(function (): array {
    $board = WhiteboardDocument::fromConfig()->read();

    usort($board['sections'], function (array $a, array $b): int {
        $rank = fn (string $heading): int => $heading === 'Ideas: David / Alexander' ? 0 : 1;

        return $rank($a['heading']) <=> $rank($b['heading']);
    });

    return $board;
});

$addNote = function (): void {
    $this->added = '';
    $this->added = WhiteboardDocument::fromConfig()->append($this->note, $this->lane, $this->author);
    $this->note = '';
};

$toggle = function (string $heading, string $rawLine): void {
    WhiteboardDocument::fromConfig()->toggle($heading, $rawLine);
};

?>

<div class="mx-auto max-w-[1200px] px-6 py-16">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <h1 class="font-heading text-3xl font-medium text-cream">Whiteboard</h1>
        <button type="button" wire:click="$refresh" class="rounded border border-steel px-3 py-2 text-sm font-semibold text-cream">
            Reload the file
        </button>
    </div>

    <p class="mt-4 max-w-2xl text-lg text-cream/80">
        Claude's notes and Grok's notes are already here. A note you add is written into WHITEBOARD.md, which is the file both of us read.
    </p>
    <p class="mt-3 max-w-2xl text-slate">
        Internal only. Not linked. Not indexed. Nothing here goes on the public site until you say so.
        The labs are at <a href="{{ route('hero-lab') }}" class="underline" wire:navigate>hero lab</a>
        and <a href="{{ route('logo-lab') }}" class="underline" wire:navigate>logo lab</a>.
    </p>

    @if ($added !== '')
        <p class="mt-4 font-semibold text-cream">On the board as {{ $added }}.</p>
    @endif

    @error('board')
        <p class="mt-4 text-sm text-signal">{{ $message }}</p>
    @enderror

    <form wire:submit="addNote" class="mt-8 rounded border border-steel bg-graphite p-5">
        <label for="note" class="block text-sm font-semibold text-cream">Your note</label>
        <textarea id="note" wire:model="note" rows="3" required
            @error('note') aria-invalid="true" aria-describedby="note-error" @enderror
            class="mt-1 w-full rounded border border-steel bg-carbon px-3 py-2 text-base focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick"
            placeholder="What should we remember?"></textarea>
        @error('note') <p id="note-error" class="mt-1 text-sm text-signal">{{ $message }}</p> @enderror

        <div class="mt-4 grid gap-4 sm:grid-cols-2">
            <div>
                <label for="author" class="block text-sm font-semibold text-cream">Who is writing</label>
                <select id="author" wire:model="author"
                    class="mt-1 w-full rounded border border-steel bg-graphite px-3 py-2 text-base focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick">
                    <option value="david">David</option>
                    <option value="alexander">Alexander</option>
                </select>
                @error('author') <p class="mt-1 text-sm text-signal">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="lane" class="block text-sm font-semibold text-cream">Where it goes</label>
                <select id="lane" wire:model="lane"
                    class="mt-1 w-full rounded border border-steel bg-graphite px-3 py-2 text-base focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick">
                    <option value="ideas">My notes</option>
                    <option value="questions">Open questions</option>
                    <option value="decisions">Decisions made</option>
                    <option value="next">Next up</option>
                </select>
                @error('lane') <p class="mt-1 text-sm text-signal">{{ $message }}</p> @enderror
            </div>
        </div>

        <button type="submit" wire:loading.attr="disabled" wire:target="addNote"
            class="mt-4 inline-flex items-center rounded bg-brick px-6 py-3 text-sm font-medium text-cream transition hover:bg-brick/90 disabled:opacity-60">
            <span wire:loading.remove wire:target="addNote">Add to the board</span>
            <span wire:loading wire:target="addNote">Adding...</span>
        </button>
    </form>

    <div class="mt-8 flex flex-wrap items-start gap-4 pb-8">
        @foreach ($this->board['sections'] as $section)
            <section @class([
                'w-full rounded border bg-carbon p-4 sm:w-72',
                'border-brick' => $section['heading'] === 'Ideas: David / Alexander',
                'border-steel' => $section['heading'] !== 'Ideas: David / Alexander',
            ])>
                <h2 class="font-heading text-xl font-medium text-cream">{{ $section['heading'] }}</h2>

                <div class="mt-4 space-y-3">
                    @forelse ($section['items'] as $item)
                        @if ($item['kind'] === 'prose')
                            <p class="text-sm text-slate">{{ $item['text'] }}</p>
                        @elseif ($item['kind'] === 'check')
                            <button type="button"
                                wire:click="toggle({{ \Illuminate\Support\Js::from($section['heading']) }}, {{ \Illuminate\Support\Js::from($item['raw']) }})"
                                class="w-full rounded border border-steel bg-graphite p-4 text-left">
                                <span class="text-sm font-semibold text-cream">{{ $item['checked'] ? 'Reopen' : 'Mark done' }}</span>
                                <span @class(['mt-2 block text-base', 'text-slate line-through' => $item['checked']])>{{ $item['text'] }}</span>
                            </button>
                        @else
                            <article class="rounded border border-steel bg-graphite p-4">
                                <p class="text-base">{{ $item['text'] }}</p>
                            </article>
                        @endif
                    @empty
                        <p class="text-sm text-slate">Nothing in this column yet.</p>
                    @endforelse
                </div>
            </section>
        @endforeach
    </div>
</div>
