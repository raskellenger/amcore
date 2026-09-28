<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('AmCore Systems — Operating systems for the trades');

view()->share('description', 'Operating systems for the trades: work orders, scheduling, invoicing, and more — configured to how your crew already works. Serving Greenville and the Upstate.');

?>

@php
$modules = [
    ['icon' => 'clipboard-document-list', 'name' => 'Work Orders', 'line' => "Crews always know the job, the address, and what's expected before they arrive."],
    ['icon' => 'phone', 'name' => 'Intake & Customer Contacts', 'line' => 'No more digging through three apps to find out who a customer is.'],
    ['icon' => 'calendar-days', 'name' => 'Scheduling & Dispatch', 'line' => 'Fewer double-bookings, fewer trucks driving in circles.'],
    ['icon' => 'banknotes', 'name' => 'Invoicing (QuickBooks-connected)', 'line' => "Bills go out the day the job's done, not three weeks later."],
    ['icon' => 'document-text', 'name' => 'Proposals & Estimating', 'line' => "Close the job while you're still standing in the driveway."],
    ['icon' => 'cube', 'name' => 'Inventory & Equipment', 'line' => 'Know what you have before you order more of it.'],
    ['icon' => 'chart-bar', 'name' => 'Reporting & Job Costing', 'line' => 'Stop guessing whether a job made money.'],
    ['icon' => 'chat-bubble-left-right', 'name' => 'Notifications & Messaging', 'line' => 'Everyone on the job sees the same information, at the same time.'],
];

$timeline = [
    'Discovery at your shop',
    'Build (about 2 weeks)',
    'Walkthrough and revisions',
    'Field test with a few crews on live jobs',
    'Turnover — goes live company-wide',
    'In-person training for every role',
    'Ongoing hosting, maintenance, and support',
];
@endphp

<div>
    {{-- Hero --}}
    <section class="border-b border-navy/10 bg-offwhite">
        <div class="mx-auto max-w-4xl px-6 py-24 text-center">
            <h1 class="font-heading text-4xl font-semibold text-navy sm:text-5xl">Operating systems for the trades.</h1>
            <p class="mx-auto mt-5 max-w-2xl text-lg text-ink/70">
                One system for work orders, scheduling, invoicing, and the paperwork that piles up between jobs — configured to how your crew already works.
            </p>
            <a href="{{ route('contact') }}" wire:navigate
                class="mt-8 inline-flex items-center rounded bg-brick px-6 py-3 font-semibold text-white transition hover:bg-brick/90">
                Book a Discovery Call
            </a>
        </div>
    </section>

    {{-- Pain points --}}
    <section class="mx-auto max-w-4xl px-6 py-20">
        <h2 class="font-heading text-2xl font-semibold text-navy">Sound familiar?</h2>
        <ul class="mt-6 grid gap-4 sm:grid-cols-2">
            @foreach ([
                "Hours lost re-typing the same work order three times.",
                "Crews driving back to the shop for paperwork instead of the next job.",
                "Invoices going out weeks after the job's done.",
                "No real picture of job cost, or who still owes you money.",
                "Details buried in texts and email nobody can find later.",
            ] as $pain)
                <li class="flex gap-3 rounded border border-navy/10 bg-white p-4 text-ink/80">
                    <span class="mt-1 h-1.5 w-1.5 shrink-0 rounded-full bg-brick"></span>
                    {{ $pain }}
                </li>
            @endforeach
        </ul>
    </section>

    {{-- Five pillars --}}
    <section class="border-y border-navy/10 bg-navy text-offwhite">
        <div class="mx-auto max-w-5xl px-6 py-20">
            <h2 class="font-heading text-2xl font-semibold">Five reasons this is different</h2>
            <ol class="mt-8 grid gap-8 sm:grid-cols-2">
                @foreach ([
                    ['Built for the people doing the work.', 'Phone-first. Voice-to-text notes. Works with no signal on site and syncs when you\'re back in range.'],
                    ['Configured to how you already work.', 'Your forms, your terms, your process — we build the system around your business, not the other way around.'],
                    ['We run it for you.', 'Hosting, updates, security, and daily backups are included. Something breaks, you call a real person.'],
                    ['Local, not faceless.', 'Based in Greenville. Discovery and training happen in person, at your shop.'],
                    ['Straightforward terms.', 'One setup fee. One monthly fee. No per-user fees. You own your data and can export it any time.'],
                ] as $i => [$headline, $body])
                    <li>
                        <p class="font-heading text-bronze">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</p>
                        <h3 class="mt-1 font-heading text-lg font-semibold">{{ $headline }}</h3>
                        <p class="mt-2 text-offwhite/75">{{ $body }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- Eight modules --}}
    <section class="mx-auto max-w-5xl px-6 py-20">
        <h2 class="font-heading text-2xl font-semibold text-navy">Eight modules, one system</h2>
        <p class="mt-2 max-w-2xl text-ink/70">Everything a trades business needs to run, in one place.</p>
        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($modules as $module)
                <div class="rounded border border-navy/10 bg-white p-5">
                    <flux:icon :name="$module['icon']" class="size-6 text-brick" aria-hidden="true" />
                    <h3 class="mt-3 font-heading font-semibold text-navy">{{ $module['name'] }}</h3>
                    <p class="mt-1 text-sm text-ink/70">{{ $module['line'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Timeline --}}
    <section class="border-y border-navy/10 bg-offwhite">
        <div class="mx-auto max-w-4xl px-6 py-20">
            <h2 class="font-heading text-2xl font-semibold text-navy">How it works</h2>
            <p class="mt-2 text-ink/70">About 60 days from kickoff to running on your own.</p>
            <ol class="mt-8 space-y-4">
                @foreach ($timeline as $i => $step)
                    <li class="flex items-center gap-4">
                        <span class="flex size-8 shrink-0 items-center justify-center rounded-full bg-navy font-heading text-sm text-white">{{ $i + 1 }}</span>
                        <span class="text-ink/80">{{ $step }}</span>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- Trades strip --}}
    <section class="mx-auto max-w-3xl px-6 py-20 text-center">
        <h2 class="font-heading text-2xl font-semibold text-navy">Built by people from the trades</h2>
        <p class="mt-4 text-ink/70">
            AmCore was started by people who've done the work — paint and drywall crews on national homebuilder jobs, residential repaint, trenching, crawlspaces, plumbing. And the paperwork side too: scheduling, billing, chasing down invoices. We built the system we wished we'd had.
        </p>
    </section>

    {{-- Websites cross-sell --}}
    <section class="border-y border-navy/10 bg-white">
        <div class="mx-auto flex max-w-4xl flex-col items-center gap-4 px-6 py-14 text-center">
            <h2 class="font-heading text-xl font-semibold text-navy">Need a website too?</h2>
            <p class="text-ink/70">We also build fast, mobile-first sites for trades businesses, built to get the phone to ring.</p>
            <a href="{{ route('websites') }}" wire:navigate class="font-semibold text-brick hover:underline">See Websites &rarr;</a>
        </div>
    </section>

    {{-- Final CTA --}}
    <section class="mx-auto max-w-3xl px-6 py-24 text-center">
        <h2 class="font-heading text-2xl font-semibold text-navy">Ready to see it running on your own jobs?</h2>
        <a href="{{ route('contact') }}" wire:navigate
            class="mt-6 inline-flex items-center rounded bg-brick px-6 py-3 font-semibold text-white transition hover:bg-brick/90">
            Book a Discovery Call
        </a>
    </section>
</div>
