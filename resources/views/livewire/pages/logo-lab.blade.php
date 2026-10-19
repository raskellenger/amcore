<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('Logo Lab — AmCore Systems');

view()->share('description', 'Internal sandbox for AmCore logo ideas. Not linked, not indexed.');

?>

@php
    $markA = 'M 50 8 L 94 94 L 76 94 L 69.9 74 L 30.1 74 L 24 94 L 6 94 Z M 50 24 L 65.7 60 L 34.3 60 Z';
@endphp

<div class="mx-auto max-w-5xl px-6 py-16">
    <h1 class="font-heading text-3xl font-medium text-cream">Logo lab</h1>
    <p class="mt-3 max-w-2xl text-lg text-cream/80">Four marks. Each one is the letter A, and each one still works when the word is gone.</p>
    <p class="mt-4 max-w-2xl text-lg text-cream/80">
        AmCore builds the operating system a trades company runs on. The mark should say that, and it should say it came from the work, not from a software catalog.
    </p>
    <p class="mt-3 max-w-2xl text-slate">Internal only. Not linked. Not indexed. The logo on the site is unchanged.</p>

    <div class="mt-12 space-y-10">

        {{-- 1. Keystone --}}
        <section class="rounded border border-steel bg-graphite p-5 sm:p-8">
            <h2 class="font-heading text-2xl font-medium text-cream">1. The keystone</h2>
            <p class="mt-2 max-w-2xl text-cream/80">The A is the structure. The brick stone is the one piece that keeps it standing. That piece is the system.</p>

            <div class="mt-6 flex flex-wrap items-center gap-8">
                <svg viewBox="0 0 100 100" class="h-40 w-40 shrink-0 text-cream" role="img" aria-label="Keystone A">
                    <path fill="currentColor" fill-rule="evenodd" d="{{ $markA }}" />
                    <polygon fill="#A6372F" points="42,55 58,55 68,78 32,78" />
                </svg>
                <div>
                    <p class="font-sans text-5xl font-semibold leading-none tracking-tight text-cream sm:text-6xl">AmCore</p>
                    <p class="mt-2 text-base text-slate">Systems</p>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap items-end gap-6">
                @foreach ([64, 32, 16] as $size)
                    <svg viewBox="0 0 100 100" class="text-cream" style="height: {{ $size }}px; width: {{ $size }}px" aria-hidden="true">
                        <path fill="currentColor" fill-rule="evenodd" d="{{ $markA }}" />
                        <polygon fill="#A6372F" points="42,55 58,55 68,78 32,78" />
                    </svg>
                @endforeach
                <div class="bg-graphite p-4 text-cream">
                    <svg viewBox="0 0 100 100" class="h-16 w-16" aria-hidden="true">
                        <path fill="currentColor" fill-rule="evenodd" d="{{ $markA }}" />
                        <polygon fill="#A6372F" points="42,55 58,55 68,78 32,78" />
                    </svg>
                </div>
            </div>
        </section>

        {{-- 2. Level --}}
        <section class="rounded border border-steel bg-graphite p-5 sm:p-8">
            <h2 class="font-heading text-2xl font-medium text-cream">2. The level</h2>
            <p class="mt-2 max-w-2xl text-cream/80">The bar of the A is a level. The work has a way to see what is true: which jobs made money, who still owes you, who is out tomorrow.</p>

            <div class="mt-6 flex flex-wrap items-center gap-8">
                <svg viewBox="0 0 100 100" class="h-40 w-40 shrink-0 text-cream" role="img" aria-label="Level A">
                    <path fill="currentColor" fill-rule="evenodd" d="{{ $markA }}" />
                    <rect x="30" y="59" width="40" height="16" rx="8" fill="currentColor" />
                    <rect x="33" y="62" width="34" height="10" rx="5" fill="#F3ECDD" />
                    <circle cx="50" cy="67" r="3.2" fill="#A6372F" />
                </svg>
                <div>
                    <p class="font-sans text-5xl font-semibold leading-none tracking-tight text-cream sm:text-6xl">AmCore</p>
                    <p class="mt-2 text-base text-slate">Systems</p>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap items-end gap-6">
                @foreach ([64, 32, 16] as $size)
                    <svg viewBox="0 0 100 100" class="text-cream" style="height: {{ $size }}px; width: {{ $size }}px" aria-hidden="true">
                        <path fill="currentColor" fill-rule="evenodd" d="{{ $markA }}" />
                        <rect x="30" y="59" width="40" height="16" rx="8" fill="currentColor" />
                        <rect x="33" y="62" width="34" height="10" rx="5" fill="#F3ECDD" />
                        <circle cx="50" cy="67" r="3.2" fill="#A6372F" />
                    </svg>
                @endforeach
                <div class="bg-graphite p-4 text-cream">
                    <svg viewBox="0 0 100 100" class="h-16 w-16" aria-hidden="true">
                        <path fill="currentColor" fill-rule="evenodd" d="{{ $markA }}" />
                        <rect x="30" y="59" width="40" height="16" rx="8" fill="currentColor" />
                        <rect x="33" y="62" width="34" height="10" rx="5" fill="#292929" />
                        <circle cx="50" cy="67" r="3.2" fill="#A6372F" />
                    </svg>
                </div>
            </div>
        </section>

        {{-- 3. Through-line --}}
        <section class="rounded border border-steel bg-graphite p-5 sm:p-8">
            <h2 class="font-heading text-2xl font-medium text-cream">3. The through-line</h2>
            <p class="mt-2 max-w-2xl text-cream/80">One bar runs through the A and past it. One system runs through the company: the estimate, the crew, the invoice, the job cost.</p>

            <div class="mt-6 flex flex-wrap items-center gap-8">
                <svg viewBox="0 0 100 100" class="h-40 w-40 shrink-0 text-cream" role="img" aria-label="Through-line A">
                    <path fill="currentColor" fill-rule="evenodd" d="{{ $markA }}" />
                    <rect x="0" y="59" width="100" height="16" fill="#A6372F" />
                </svg>
                <div>
                    <p class="font-sans text-5xl font-semibold leading-none tracking-tight text-cream sm:text-6xl">AmCore</p>
                    <p class="mt-2 text-base text-slate">Systems</p>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap items-end gap-6">
                @foreach ([64, 32, 16] as $size)
                    <svg viewBox="0 0 100 100" class="text-cream" style="height: {{ $size }}px; width: {{ $size }}px" aria-hidden="true">
                        <path fill="currentColor" fill-rule="evenodd" d="{{ $markA }}" />
                        <rect x="0" y="59" width="100" height="16" fill="#A6372F" />
                    </svg>
                @endforeach
                <div class="bg-graphite p-4 text-cream">
                    <svg viewBox="0 0 100 100" class="h-16 w-16" aria-hidden="true">
                        <path fill="currentColor" fill-rule="evenodd" d="{{ $markA }}" />
                        <rect x="0" y="59" width="100" height="16" fill="#A6372F" />
                    </svg>
                </div>
            </div>
        </section>

        {{-- 4. Rafter --}}
        <section class="rounded border border-steel bg-graphite p-5 sm:p-8">
            <h2 class="font-heading text-2xl font-medium text-cream">4. The rafter</h2>
            <p class="mt-2 max-w-2xl text-cream/80">Two rafters and a collar tie. People who have framed a roof know that tie keeps the two sides from spreading. Everyone else reads an A.</p>

            <div class="mt-6 flex flex-wrap items-center gap-8">
                <svg viewBox="0 0 100 100" class="h-40 w-40 shrink-0 text-cream" role="img" aria-label="Rafter A">
                    <polygon fill="currentColor" points="8,94 26,94 46,28 28,22" />
                    <polygon fill="currentColor" points="92,94 74,94 54,28 72,22" />
                    <polygon fill="currentColor" points="24,32 50,4 76,32" />
                    <rect x="24" y="50" width="52" height="12" fill="#A6372F" />
                </svg>
                <div>
                    <p class="font-sans text-5xl font-semibold leading-none tracking-tight text-cream sm:text-6xl">AmCore</p>
                    <p class="mt-2 text-base text-slate">Systems</p>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap items-end gap-6">
                @foreach ([64, 32, 16] as $size)
                    <svg viewBox="0 0 100 100" class="text-cream" style="height: {{ $size }}px; width: {{ $size }}px" aria-hidden="true">
                        <polygon fill="currentColor" points="8,94 26,94 46,28 28,22" />
                        <polygon fill="currentColor" points="92,94 74,94 54,28 72,22" />
                        <polygon fill="currentColor" points="24,32 50,4 76,32" />
                        <rect x="24" y="50" width="52" height="12" fill="#A6372F" />
                    </svg>
                @endforeach
                <div class="bg-graphite p-4 text-cream">
                    <svg viewBox="0 0 100 100" class="h-16 w-16" aria-hidden="true">
                        <polygon fill="currentColor" points="8,94 26,94 46,28 28,22" />
                        <polygon fill="currentColor" points="92,94 74,94 54,28 72,22" />
                        <polygon fill="currentColor" points="24,32 50,4 76,32" />
                        <rect x="24" y="50" width="52" height="12" fill="#A6372F" />
                    </svg>
                </div>
            </div>
        </section>
    </div>
</div>
