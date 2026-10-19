<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('Websites — AmCore Systems');

view()->share('description', 'Fast, mobile-first websites for trades businesses, built to get the phone to ring.');

?>

<div class="mx-auto max-w-3xl px-6 py-24">
    <span class="eyebrow mb-5">Websites</span>
    <h1 class="font-heading text-4xl font-medium text-cream">Fast, mobile-first websites built to get the phone to ring.</h1>
    <p class="mt-4 text-lg text-slate">
        Not to win design awards. If your current site was built ten years ago (or never really built at all), this is the fix.
    </p>

    <x-photo name="websites-example" ratio="4/3" label="A finished local trades site, truck, or sign" class="mt-10" />

    <h2 class="mt-14 font-heading text-xl font-medium text-cream">How it works</h2>
    <ol class="mt-6 space-y-4">
        @foreach ([
            'Quick call about your business and what a customer needs to see',
            'We build a simple, fast site around that',
            'You review, we revise, it goes live',
        ] as $i => $step)
            <li class="flex items-center gap-4">
                <span class="flex size-8 shrink-0 items-center justify-center rounded-full bg-graphite font-heading text-sm text-cream">{{ $i + 1 }}</span>
                <span class="text-cream/80">{{ $step }}</span>
            </li>
        @endforeach
    </ol>

    <div class="mt-14">
        <a href="{{ route('contact') }}" wire:navigate class="inline-flex items-center rounded bg-brick px-6 py-3 text-sm font-medium text-cream transition hover:bg-brick/90 btn-arrow">
            Request a Quote
        </a>
    </div>
</div>
