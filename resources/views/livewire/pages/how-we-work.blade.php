<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('How We Work — AmCore Systems');

?>

@php
$timeline = [
    ['Discovery at your shop.', 'We sit down with your team, look at your actual paperwork, and see how jobs really move from call to invoice.'],
    ['Build (about 2 weeks).', 'We configure the system around what we saw — your forms, your terms, your process.'],
    ['Walkthrough and revisions.', "You see it running, and tell us what's off before anyone touches it on a real job."],
    ['Field test.', 'A few crews run it on live jobs, so problems surface before the whole company depends on it.'],
    ['Turnover.', 'It goes live company-wide.'],
    ['Training.', 'In person, at your shop, for every role that touches it — office and field.'],
    ['Ongoing support.', "Hosting, maintenance, and a real person to call, for as long as you're running it."],
];
@endphp

<div class="mx-auto max-w-3xl px-6 py-24">
    <h1 class="font-heading text-4xl font-semibold text-navy">How We Work</h1>
    <p class="mt-4 text-lg text-ink/70">About 60 days from a first conversation to running the system company-wide, on your own.</p>

    <h2 class="mt-14 font-heading text-xl font-semibold text-navy">The timeline</h2>
    <ol class="mt-6 space-y-6">
        @foreach ($timeline as $i => [$headline, $body])
            <li class="flex gap-4">
                <span class="flex size-8 shrink-0 items-center justify-center rounded-full bg-navy font-heading text-sm text-white">{{ $i + 1 }}</span>
                <div>
                    <p class="font-semibold text-navy">{{ $headline }}</p>
                    <p class="mt-1 text-ink/70">{{ $body }}</p>
                </div>
            </li>
        @endforeach
    </ol>

    <h2 class="mt-14 font-heading text-xl font-semibold text-navy">What we need from you</h2>
    <p class="mt-3 text-ink/80">
        Time with the people who actually do the work — office and field. Copies of the paperwork you use today: work orders, estimates, invoices. And a few crews willing to run it on real jobs before the full rollout.
    </p>

    <div class="mt-14">
        <a href="{{ route('contact') }}" wire:navigate class="inline-flex items-center rounded bg-brick px-6 py-3 font-semibold text-white transition hover:bg-brick/90">
            Book a Discovery Call
        </a>
    </div>
</div>
