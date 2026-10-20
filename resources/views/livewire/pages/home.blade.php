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

@endphp

<div>
    {{-- Hero: the workflow map. New lead to five-star review, tracked the whole way. No stock photo. --}}
    <section class="border-b border-steel">
        <div class="mx-auto grid w-full max-w-[1200px] items-center gap-10 px-6 py-16 lg:grid-cols-2 lg:py-24">
            <div>
                <span class="eyebrow">Upstate, South Carolina · Built for the trades</span>
                <h1 class="mt-5 text-4xl font-medium leading-[1.1] text-cream sm:text-[56px]">Operating systems for the trades.</h1>
                <p class="mt-5 max-w-xl text-lg text-cream/80">
                    One system for work orders, scheduling, invoicing, and the paperwork that piles up between jobs — configured to how your crew already works.
                </p>
                <div class="mt-8 grid gap-3 sm:grid-cols-2">
                    <a href="{{ route('contact') }}" wire:navigate class="hover-card block rounded border border-steel bg-graphite p-4 text-cream">
                        <span class="font-heading font-medium">I'm on a pile of apps</span>
                        <span class="mt-1 block text-sm text-cream/70">Too many logins, tabs, and keys.</span>
                    </a>
                    <a href="{{ route('contact') }}" wire:navigate class="hover-card block rounded border border-steel bg-graphite p-4 text-cream">
                        <span class="font-heading font-medium">I'm on paper</span>
                        <span class="mt-1 block text-sm text-cream/70">Binders, carbon copies, a filing cabinet.</span>
                    </a>
                </div>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('contact') }}" wire:navigate
                        class="inline-flex items-center rounded bg-brick px-6 py-3 text-sm font-medium text-cream transition hover:bg-brick/90 btn-arrow">
                        Book a Discovery Call
                    </a>
                    <a href="{{ route('how-we-work') }}" wire:navigate class="inline-flex items-center rounded border border-cream/40 px-6 py-3 text-sm font-medium text-cream transition hover:border-cream btn-arrow">
                        How we work
                    </a>
                </div>
            </div>

            <div>
                <div class="overflow-hidden rounded bg-carbon p-4 sm:p-6">
                    <div class="flex flex-wrap items-baseline justify-between gap-2">
                        <p class="font-heading text-lg font-medium text-cream">The workflow</p>
                        <p class="text-slate">Tracked start to finish.</p>
                    </div>
                    <div class="mt-6 flex flex-col items-center py-2">
                        <div class="flex flex-col items-center gap-2 text-center">
                            <span class="icon-chip"><flux:icon name="map-pin" class="size-5" aria-hidden="true" /></span>
                            <p class="font-heading text-base font-medium text-cream">New Customer or New Lead</p>
                        </div>
                        <div class="my-4 h-20 border-l-2 border-dashed border-brick/70" aria-hidden="true"></div>
                        <div class="flex flex-col items-center gap-2 text-center">
                            <span class="icon-chip"><flux:icon name="map-pin" class="size-5" aria-hidden="true" /></span>
                            <p class="font-heading text-base font-medium text-cream">Final Invoice Paid, 5-Star Review Completed</p>
                        </div>
                    </div>
                </div>
                <p class="mt-4 text-cream/80">We track every job in the workflow, start to finish — specific to how your business runs, not somebody else's process.</p>
            </div>
        </div>
    </section>

    {{-- Pain points --}}
    <section class="mx-auto max-w-4xl px-6 py-20">
        <span class="eyebrow mb-4">The problem</span>
        <h2 class="font-heading text-2xl font-medium text-cream">Sound familiar?</h2>
        <p class="mt-3 max-w-2xl text-slate">Work orders are only the start. Jobs, contacts, sales, and finances all live in different places.</p>
        <ul class="mt-6 grid gap-4 sm:grid-cols-2">
            @foreach ([
                "Hours lost re-typing the same work order three times.",
                "Crews driving back to the shop for paperwork instead of the next job.",
                "Invoices going out weeks after the job's done.",
                "No real picture of job cost, or who still owes you money.",
                "Details buried in texts and email nobody can find later.",
                "Hopping between systems to track jobs, contacts, sales, and finances.",
                "Multiple logins, probably all sharing the same password.",
            ] as $pain)
                <li class="hover-card flex gap-3 rounded border border-steel bg-graphite p-4 text-cream/80">
                    <span class="mt-1 h-1.5 w-1.5 shrink-0 rounded-full bg-brick"></span>
                    {{ $pain }}
                </li>
            @endforeach
        </ul>
    </section>

    {{-- What it replaces --}}
    <section class="mx-auto max-w-5xl px-6 pb-20">
        <span class="eyebrow mb-4">Why we call it an operating system</span>
        <h2 class="font-heading text-2xl font-medium text-cream sm:text-3xl">One place for the whole job.</h2>
        <p class="mt-3 max-w-2xl text-lg text-cream/80">Not an ERP. Not a CRM. Not a project-management tool. It's all of them, built as one thing, with more modules you can turn on as you grow.</p>
        <div class="mt-8 grid gap-5 md:grid-cols-2">
            <div class="rounded border border-steel bg-graphite p-6">
                <p class="mono text-xs text-slate">TODAY</p>
                <ul class="mt-3 space-y-2 text-cream/80">
                    <li>A login for the books</li>
                    <li>A login for the schedule</li>
                    <li>A tab for the customer list</li>
                    <li>A binder for the paperwork</li>
                    <li>A text thread for everything else</li>
                </ul>
            </div>
            <div class="rounded border-2 border-brick bg-graphite p-6">
                <p class="mono text-xs text-signal">WITH AMCORE</p>
                <p class="mt-3 font-heading text-xl font-medium text-cream">One login. One place.</p>
                <p class="mt-2 text-cream/80">Jobs, contacts, sales, and finances in the same system, on the same screen, behind the one password you actually remember.</p>
            </div>
        </div>
    </section>

    {{-- Five pillars --}}
    <section class="border-y border-steel bg-graphite text-cream">
        <div class="mx-auto max-w-5xl px-6 py-20">
            <span class="eyebrow mb-4">Why AmCore</span>
            <h2 class="font-heading text-2xl font-medium sm:text-3xl">Five reasons this is different</h2>
            <ol class="mt-8 grid gap-8 sm:grid-cols-2">
                @foreach ([
                    ['Built for the people doing the work.', 'Phone-first. Voice-to-text notes. Works with no signal on site and syncs when you\'re back in range.'],
                    ['Configured to how you already work.', 'Your forms, your terms, your process — we build the system around your business, not the other way around.'],
                    ['We keep it secure and up to date.', 'Hosting, updates, security, and daily off-site backups are included, and your system gets our attention, not a shared queue. Something wrong, you call a real person.'],
                    ['Local, not faceless.', 'Based in Greenville. Discovery and training happen in person, at your shop.'],
                    ['Straightforward terms.', 'One setup fee. One monthly fee. No per-user fees. You own your data and can export it any time.'],
                ] as $i => [$headline, $body])
                    <li>
                        <p class="mono text-xs text-signal">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</p>
                        <h3 class="mt-1 font-heading text-lg font-medium">{{ $headline }}</h3>
                        <p class="mt-2 text-cream/75">{{ $body }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- Eight modules --}}
    <section class="mx-auto max-w-5xl px-6 py-20">
        <span class="eyebrow mb-4">What is inside</span>
        <h2 class="font-heading text-2xl font-medium text-cream">Eight modules, one system</h2>
        <p class="mt-2 max-w-2xl text-slate">Everything a trades business needs to run, in one place. Take what fits your shop now. Add the rest later.</p>
        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($modules as $module)
                <div class="hover-card rounded border border-steel bg-graphite p-5">
                    <span class="icon-chip"><flux:icon :name="$module['icon']" class="size-5" aria-hidden="true" /></span>
                    <h3 class="mt-3 font-heading font-medium text-cream">{{ $module['name'] }}</h3>
                    <p class="mt-1 text-sm text-slate">{{ $module['line'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Trades strip --}}
    <section class="mx-auto max-w-[1200px] px-6 pt-20">
        <x-photo name="home-trades" ratio="21/9" position="center 55%" label="A working shop: tools, benches, the real thing" alt="Tools laid out in a working shop" />
    </section>
    <section class="mx-auto max-w-3xl px-6 py-20 text-center">
        <span class="eyebrow mb-4">Who we are</span>
        <h2 class="font-heading text-2xl font-medium text-cream">Built by people from the trades</h2>
        <p class="mt-4 text-slate">
            AmCore was started by people who've done the work — paint and drywall crews on national homebuilder jobs, residential repaint, trenching, crawlspaces, plumbing. And the paperwork side too: scheduling, billing, chasing down invoices. We built the system we wished we'd had.
        </p>
    </section>

    {{-- Trades --}}
    <section class="mx-auto max-w-4xl px-6 pb-20 text-center">
        <h2 class="font-heading text-xl font-medium text-cream">Plumbing. HVAC. Electrical. Painting &amp; drywall. Roofing.</h2>
        <p class="mt-3 text-slate">Every trade has its own words and its own paperwork. We configure the system to yours. Tile, flooring, landscaping, something else? If you'll give us the time for a proper discovery, we can make it work.</p>
        <a href="{{ route('trades') }}" wire:navigate class="mt-4 inline-block font-medium text-signal hover:underline">See how it fits your trade &rarr;</a>
    </section>

    {{-- Websites cross-sell --}}
    <section class="border-y border-steel bg-graphite">
        <div class="mx-auto flex max-w-4xl flex-col items-center gap-4 px-6 py-14 text-center">
            <h2 class="font-heading text-xl font-medium text-cream">Need a website too?</h2>
            <p class="text-slate">We also build fast, mobile-first sites for trades businesses, built to get the phone to ring.</p>
            <a href="{{ route('websites') }}" wire:navigate class="font-medium text-signal hover:underline">See Websites &rarr;</a>
        </div>
    </section>

    {{-- Final CTA --}}
    <section class="relative isolate overflow-hidden border-t border-steel">
        <x-photo name="home-cta" ratio="21/9" fill position="center 60%" label="Roofer on a new roof" alt="A roofer installing shingles" class="absolute inset-0 -z-20 rounded-none border-0" />
        <div class="absolute inset-0 -z-10 bg-carbon/75"></div>
        <div class="mx-auto max-w-3xl px-6 py-28 text-center">
            <h2 class="font-heading text-2xl font-medium text-cream sm:text-4xl">Ready to see it running on your own jobs?</h2>
            <a href="{{ route('contact') }}" wire:navigate
                class="mt-8 inline-flex items-center rounded bg-brick px-6 py-3 text-sm font-medium text-cream transition hover:bg-brick/90 btn-arrow">
                Book a Discovery Call
            </a>
        </div>
    </section>
</div>
