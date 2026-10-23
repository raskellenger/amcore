<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('AmCore Systems — Operating systems for the trades');

view()->share('description', 'Operating systems for the trades: work orders, scheduling, invoicing, and more — configured to how your crew already works. Serving Greenville and the Upstate.');

?>

<div>
    {{-- Hero: the workflow map. New lead to five-star review, tracked the whole way.
         Video backdrop + two-layer dark overlay, matching Figma's hero exactly. --}}
    <section class="relative isolate overflow-hidden border-b border-steel bg-carbon">
        <video class="absolute inset-0 -z-30 size-full -scale-x-100 object-cover" autoplay muted loop playsinline aria-hidden="true">
            <source src="{{ asset('videos/hero.mp4') }}" type="video/mp4">
        </video>
        <div class="hero-overlay-flat absolute inset-0 -z-20"></div>
        <div class="hero-overlay-gradient absolute inset-0 -z-10"></div>

        <div class="mx-auto w-full max-w-[1200px] px-6 py-16 lg:py-24">
            <div class="max-w-xl">
                <h1 class="font-display text-4xl leading-tight text-cream sm:text-h1-hero">Paperwork is out.<br>Your system is in.</h1>
                <p class="mt-4 text-lg font-semibold text-cream">The OS for the trades.</p>
                <p class="mt-5 text-cream/80">
                    Your shop isn't generic, so your software shouldn't be. We build operating systems around your current work that replaces the clipboards, whiteboards, and paper with one system that runs every job.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('contact') }}" wire:navigate
                        class="inline-flex h-14 items-center justify-center rounded-full bg-brick px-6 text-sm font-semibold text-cream transition hover:bg-brick/90 btn-arrow">
                        Book a Discovery Call
                    </a>
                    <a href="{{ route('how-we-work') }}" wire:navigate class="hover-card inline-flex h-14 items-center justify-center rounded-full border border-cream/10 bg-black/60 px-6 text-sm font-semibold text-cream transition hover:bg-black/40">
                        How we work
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- How it works: matches Figma's "Every job follows your steps" 8-step workflow strip exactly.
         Dark — this and the hero are the two-dark lead-in, then the rest of the page alternates. --}}
    <section class="border-b border-steel bg-carbon">
        <div class="mx-auto max-w-5xl px-6 py-20">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <h2 class="font-heading text-2xl font-medium text-cream sm:text-h2">Every job follows your steps.<br>Nothing gets skipped.</h2>
                <p class="max-w-sm text-slate">You decide the steps a job goes through. The system won't let it move ahead until each one is done, so nothing gets invoiced half-finished.</p>
            </div>

            <div class="mt-10 rounded-xl bg-graphite p-8 shadow-card-dark sm:p-10">
                <div class="group/flow relative">
                    <div class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-4 lg:grid-cols-8">
                        @foreach ([
                            ['phone-arrow-down-left', 'Call comes in'],
                            ['clipboard-document-list', 'Work order'],
                            ['truck', 'Dispatch'],
                            ['map-pin', 'On site'],
                            ['camera', 'Photos & signature'],
                            ['receipt-percent', 'Invoice'],
                            ['check-circle', 'Paid'],
                            ['star', 'Review'],
                        ] as [$icon, $label])
                            <div class="hover-card flex flex-col items-center gap-2 rounded-lg border border-transparent p-3 text-center transition-opacity duration-300 group-hover/flow:opacity-0">
                                <span class="icon-chip"><flux:icon :name="$icon" class="size-5" aria-hidden="true" /></span>
                                <span class="text-xs leading-tight text-slate">{{ $label }}</span>
                            </div>
                        @endforeach
                    </div>

                    {{-- A second full row of swappable alternates — same grid, so it always stays
                         completely filled regardless of breakpoint. Shows steps aren't fixed. --}}
                    <div class="mt-8 grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-4 lg:grid-cols-8">
                        @foreach ([
                            ['chat-bubble-left-right', 'Text lead'],
                            ['document-check', 'Permit pulled'],
                            ['cube', 'Parts ordered'],
                            ['wrench', 'Equipment check'],
                            ['shield-check', 'Safety check'],
                            ['banknotes', 'Deposit collected'],
                            ['bell', 'Reminder sent'],
                            ['arrow-path', 'Reschedule'],
                        ] as [$icon, $label])
                            <div class="hover-card flex flex-col items-center gap-2 rounded-lg border border-transparent p-3 text-center transition-opacity duration-300 group-hover/flow:opacity-0">
                                <span class="icon-chip"><flux:icon :name="$icon" class="size-5" aria-hidden="true" /></span>
                                <span class="text-xs leading-tight text-slate">{{ $label }}</span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Hidden until you hover any step — then every step disappears and flows into one system. --}}
                    <div class="pointer-events-none absolute inset-0 flex flex-col items-center justify-center gap-2 opacity-0 transition-opacity duration-300 group-hover/flow:opacity-100">
                        <span class="icon-chip size-14"><flux:icon name="cpu-chip" class="size-6" aria-hidden="true" /></span>
                        <span class="font-heading text-sm font-semibold text-cream">Your system</span>
                    </div>
                </div>

                <p class="mt-8 text-center text-sm text-slate">Your steps, your order. Swap any step for one that fits your shop.</p>
            </div>
            <p class="mt-4 text-slate">Hours and parts are logged while the work happens, so you know what a job cost before you send the bill.</p>
        </div>
    </section>

    {{-- Pain points: direct analog of Figma's "The problem / Sound familiar?" section. Light. --}}
    <section class="bg-cream">
        <div class="mx-auto max-w-4xl px-6 py-20">
            <h2 class="font-heading text-2xl font-medium text-ink sm:text-h2">Sound familiar?</h2>
            <p class="mt-3 max-w-2xl text-muted">Work orders are only the start. Jobs, contacts, sales, and finances all live in different places.</p>
            <ul class="mt-6 grid gap-4 sm:grid-cols-2">
                @foreach ([
                    ['document-duplicate', "Hours lost re-typing the same work order three times."],
                    ['truck', "Crews driving back to the shop for paperwork instead of the next job."],
                    ['receipt-percent', "Invoices going out weeks after the job's done."],
                    ['chart-bar', "No real picture of job cost, or who still owes you money."],
                    ['chat-bubble-left-right', "Details buried in texts and email nobody can find later."],
                    ['arrows-right-left', "Hopping between systems to track jobs, contacts, sales, and finances."],
                    ['squares-2x2', "Juggling multiple systems and trying to collect all the data to put in one place."],
                    ['key', "Multiple logins, probably all sharing the same password."],
                ] as [$icon, $pain])
                    <li class="flex items-start gap-3 rounded-lg border border-transparent bg-white p-6 text-ink/80 shadow-card">
                        <span class="icon-chip size-10 shrink-0"><flux:icon :name="$icon" class="size-5" aria-hidden="true" /></span>
                        <span class="mt-2">{{ $pain }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- What it is: matches Figma's "Your books stay in QuickBooks" Today/With AmCore comparison exactly. --}}
    <section class="bg-carbon">
        <div class="mx-auto max-w-5xl px-6 py-20">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <h2 class="font-heading text-2xl font-medium text-cream sm:text-h2">Your books stay in QuickBooks.<br>Everything else runs here.</h2>
                <p class="max-w-sm text-cream/80">Your accountant keeps the system they know. AmCore runs the rest of the business: customers, jobs, crews, schedules, and the paperwork in between. It's built as one system, so nothing gets typed twice.</p>
            </div>
            <div class="mt-8 grid gap-5 md:grid-cols-2">
                <div class="rounded-lg border border-steel bg-graphite p-6 shadow-card-dark">
                    <p class="mono text-xs text-slate">TODAY</p>
                    <ul class="mt-3 space-y-2 text-cream/80">
                        @foreach ([
                            'A login for the schedule',
                            'A spreadsheet for the customer list',
                            'An app for estimates',
                            'A binder for the paperwork',
                            'A text thread for everything else',
                        ] as $item)
                            <li class="flex items-start gap-2">
                                <flux:icon name="document-text" class="mt-0.5 size-4 shrink-0 text-slate" aria-hidden="true" />
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="rounded-lg border border-brick bg-graphite p-6 shadow-card-dark-accent">
                    <div class="flex items-center justify-between">
                        <p class="mono text-xs text-signal">WITH AMCORE</p>
                        <flux:icon name="check-circle" class="size-6 text-cream" aria-hidden="true" />
                    </div>
                    <p class="mt-3 font-heading text-h4 text-cream">One system, built for your shop.</p>
                    <p class="mt-2 text-cream/80">Jobs, customers, crews, and money on the same screen, behind one login.</p>
                    <div class="mt-4 grid grid-cols-4 gap-2">
                        @foreach (['briefcase', 'clipboard-document-list', 'truck', 'banknotes'] as $icon)
                            <span class="flex h-12 items-center justify-center rounded-md bg-tile-dark text-cream">
                                <flux:icon :name="$icon" class="size-5" aria-hidden="true" />
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Five pillars: direct analog of Figma's light "Five reasons this is different" cards.
         Icons sit in the standard chip (per a fresh look at the current Figma file — the design
         changed since the original extraction, which had documented these as bare). Last card
         spans full width, matching Figma's "Support reason" full-width band. --}}
    <section class="border-y border-steel bg-cream">
        <div class="mx-auto max-w-5xl px-6 py-20">
            <h2 class="font-heading text-2xl font-medium text-ink sm:text-h2">Five reasons this is different</h2>
            <ol class="mt-8 grid gap-6 sm:grid-cols-2">
                @foreach ([
                    ['building-office-2', 'Built around your shop.', 'Your forms, your words, your process. We build the system to fit how you work, not a template you have to work around.'],
                    ['adjustments-horizontal', 'Built for the field.', 'Phone-first, so techs can see the job, log hours and parts, and take photos from the truck.'],
                    ['shield-check', "Jobs can't close half-done.", 'Required photos, signatures, and steps are checked before anything gets invoiced.'],
                    ['map-pin', 'Local, not faceless.', 'Based in Greenville. Discovery and training happen in person, at your shop.'],
                    ['wrench', 'We keep it running.', "Hosting, updates, security, and daily off-site backups are included. When something's wrong, you call a real person."],
                ] as $i => [$icon, $headline, $body])
                    @if ($i === 4)
                        <li class="flex items-center gap-6 rounded-lg border border-transparent bg-white p-8 shadow-card sm:col-span-2">
                            <span class="icon-chip shrink-0"><flux:icon :name="$icon" class="size-5" aria-hidden="true" /></span>
                            <div class="flex-1">
                                <h3 class="font-heading text-h4 text-ink">{{ $headline }}</h3>
                                <p class="mt-1 text-muted">{{ $body }}</p>
                            </div>
                            <p class="mono shrink-0 self-start text-xs text-brick">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</p>
                        </li>
                    @else
                        <li class="rounded-lg border border-transparent bg-white p-8 shadow-card">
                            <div class="flex items-center justify-between">
                                <span class="icon-chip"><flux:icon :name="$icon" class="size-5" aria-hidden="true" /></span>
                                <p class="mono text-xs text-brick">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <h3 class="mt-6 font-heading text-h4 text-ink">{{ $headline }}</h3>
                            <p class="mt-2 text-muted">{{ $body }}</p>
                        </li>
                    @endif
                @endforeach
            </ol>
        </div>
    </section>

    {{-- What's inside: matches Figma's "Built from modules. Shaped to your shop." module-group cards exactly. Dark. --}}
    <section class="bg-carbon">
        <div class="mx-auto max-w-5xl px-6 py-20">
            <h2 class="font-heading text-2xl font-medium text-cream sm:text-h2">Built from modules.<br>Shaped to your shop.</h2>
            <p class="mt-3 max-w-2xl text-slate">Start with what your shop needs now. Add more as you grow, or have us build something that doesn't exist yet.</p>
            <div class="mt-8 grid gap-6 sm:grid-cols-2">
                @foreach ([
                    ['handshake', 'Get the work', 'Answer faster and close the job in the driveway.', ['Intake & customer records', 'Proposals & estimating', 'Customer texting']],
                    ['truck', 'Do the work', 'Crews know the job before they pull up.', ['Work orders with required steps', 'Scheduling & dispatch', 'Parts, inventory & equipment', 'Recurring service & reminders']],
                    ['receipt-percent', 'Get paid', "Bills go out the day the job's done.", ['Invoicing, synced to QuickBooks', 'Customer portals', 'Time & pay, including after-hours rules', 'Supplier portal connections']],
                    ['chart-bar', 'Know your numbers', 'See which jobs make money while they\'re still running.', ['Live job costing', 'Reporting', 'Team records & certifications', 'AI help with notes and transcription']],
                ] as [$icon, $title, $line, $items])
                    <div class="rounded-lg border border-steel bg-graphite p-8 shadow-card-dark">
                        <div class="flex items-center gap-4">
                            <span class="icon-chip"><flux:icon :name="$icon" class="size-5" aria-hidden="true" /></span>
                            <h3 class="font-heading text-h4 text-cream">{{ $title }}</h3>
                        </div>
                        <p class="mt-3 text-slate">{{ $line }}</p>
                        <hr class="mt-4 border-steel">
                        <ul class="mt-4 space-y-2 text-cream/90">
                            @foreach ($items as $item)
                                <li class="flex items-start gap-2">
                                    <flux:icon name="check-circle" class="mt-0.5 size-4 shrink-0 text-brick" aria-hidden="true" />
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
            <p class="mt-8 text-center text-xl font-semibold text-brick">Don't see it? If your shop does it, we can build it.</p>
        </div>
    </section>

    {{-- Ownership: matches Figma's "Rent your software, or own it." section. Light. --}}
    <section class="bg-cream">
        <div class="mx-auto max-w-5xl px-6 py-20">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <h2 class="font-heading text-2xl font-medium text-ink sm:text-h2">Rent your software,<br>or own it.</h2>
                <p class="max-w-sm text-muted">Most field service apps rent you a login. Stop paying, and you leave with a spreadsheet. The system we build for you is yours, and if you ever want to take it somewhere else, it goes with you.</p>
            </div>
            <div class="mt-8 grid gap-5 sm:grid-cols-3">
                @foreach ([
                    ['code-bracket', 'Your code.', 'The system built for your shop belongs to your shop.'],
                    ['key', 'Your accounts.', "It runs on accounts set up in your company's name."],
                    ['chat-bubble-left-right', 'Your number.', 'Your business texting number stays with you, so customers never lose track of you.'],
                ] as $i => [$icon, $title, $body])
                    <div class="rounded-lg border border-transparent bg-white p-6 shadow-card">
                        <div class="flex items-center justify-between">
                            <span class="icon-chip"><flux:icon :name="$icon" class="size-5" aria-hidden="true" /></span>
                            <p class="mono text-xs text-brick">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <h3 class="mt-4 font-heading font-medium text-ink">{{ $title }}</h3>
                        <p class="mt-2 text-sm text-muted">{{ $body }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Trades strip + Who we are: direct analog of Figma's dark "Who we are" photo+text section. --}}
    <section class="bg-carbon pt-20">
        <div class="mx-auto max-w-[1200px] px-6">
            <x-photo name="about-shop" ratio="21/9" position="center 30%" label="The AmCore team" alt="The AmCore team" class="rounded-xl shadow-card-dark" />
        </div>
    </section>
    <section class="bg-carbon">
        <div class="mx-auto max-w-3xl px-6 py-20 text-center">
            <h2 class="font-heading text-2xl font-medium text-cream sm:text-h2">Built by people from the trades</h2>
            <p class="mt-4 text-slate">
                AmCore was started by people who've done the work — paint and drywall crews on national homebuilder jobs, residential repaint, trenching, crawlspaces, plumbing. And the paperwork side too: scheduling, billing, chasing down invoices. We built the system we wished we'd had.
            </p>
        </div>
    </section>

    {{-- Trades: direct analog of Figma's light "Your trade. Your words. Your paperwork." section. --}}
    <section class="bg-cream">
        <div class="mx-auto max-w-4xl px-6 py-20 text-center">
            <div class="flex items-center justify-center gap-4">
                @foreach (['wrench', 'fire', 'bolt', 'paint-brush', 'home'] as $icon)
                    <span class="icon-chip size-14"><flux:icon :name="$icon" class="size-6" aria-hidden="true" /></span>
                @endforeach
            </div>
            <h2 class="mt-8 font-heading text-2xl font-medium text-ink sm:text-h2">Your trade. Your words. Your paperwork.</h2>
            <p class="mt-3 text-muted">Plumbing, HVAC, electrical, painting and drywall, roofing, and more. Every trade runs differently, so we build the system around yours. If you run crews and jobs, give us the time for a proper discovery and we'll make it work.</p>
            <a href="{{ route('trades') }}" wire:navigate class="mt-4 inline-block font-medium text-brick hover:underline">See how it fits your trade &rarr;</a>
        </div>
    </section>

    {{-- How we work: matches Figma's dark "From first visit to go-live" 4-step section exactly. --}}
    <section class="bg-carbon">
        <div class="mx-auto max-w-5xl px-6 py-20">
            <h2 class="font-heading text-2xl font-medium text-cream sm:text-h2">From first visit to go-live in weeks, not months.</h2>
            @php
                $goLiveSteps = [
                    ['Discovery', 'We spend time at your shop learning how the work actually moves.'],
                    ['Build', 'We build your system and bring over your customer and job history.'],
                    ['Test', 'Your crew runs it on real jobs, and we fix whatever doesn\'t fit.'],
                    ['Go live', 'We train your team in person and stay on priority support for the first 30 days.'],
                ];
            @endphp

            {{-- Phone view: number badge on the side of each step, with a connecting line down to the next. --}}
            <div class="mt-10 space-y-6 sm:hidden">
                @foreach ($goLiveSteps as $i => [$title, $body])
                    <div class="flex gap-4">
                        <div class="flex flex-col items-center">
                            <span class="icon-chip size-10 shrink-0 font-heading text-sm font-semibold">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                            @unless ($i === array_key_last($goLiveSteps))
                                <span class="mt-2 w-px flex-1 bg-steel"></span>
                            @endunless
                        </div>
                        <div class="pb-2">
                            <h3 class="font-heading text-h4 text-cream">{{ $title }}</h3>
                            <p class="mt-2 text-cream/80">{{ $body }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 hidden gap-8 sm:grid sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($goLiveSteps as $i => [$title, $body])
                    <div>
                        <div class="flex items-center gap-3">
                            <span class="icon-chip size-10 shrink-0 font-heading text-sm font-semibold">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</span>
                            @unless ($i === array_key_last($goLiveSteps))
                                <hr class="hidden flex-1 border-steel sm:block">
                            @endunless
                        </div>
                        <h3 class="mt-4 font-heading text-h4 text-cream">{{ $title }}</h3>
                        <p class="mt-2 text-cream/80">{{ $body }}</p>
                    </div>
                @endforeach
            </div>
            <p class="mt-8 text-sm text-muted">Your timeline is set during discovery, based on what we're building.</p>
        </div>
    </section>

    {{-- Pricing: matches Figma's light "One setup fee. One flat monthly fee." section — missing from the build entirely. --}}
    <section class="bg-cream">
        <div class="mx-auto max-w-5xl px-6 py-20">
            <div class="grid gap-10 md:grid-cols-2 md:items-center">
                <div>
                    <h2 class="font-heading text-2xl font-medium text-ink sm:text-h2">One setup fee.<br>One flat monthly fee.</h2>
                    <p class="mt-3 max-w-sm text-muted">No per-user charges. Your setup fee is quoted after discovery, based on what we build.</p>
                </div>
                <div class="rounded-xl bg-white p-8 shadow-card">
                    <p class="font-heading text-lg font-medium text-brick">Every month includes</p>
                    <hr class="mt-4 border-divider">
                    <ul class="mt-4 space-y-3 text-ink/90">
                        @foreach ([
                            'Up to 20 users',
                            'Hosting, updates, and security',
                            'Daily off-site backups',
                            'Two hours of changes',
                            'Support from a real person',
                        ] as $item)
                            <li class="flex items-start gap-2">
                                <flux:icon name="check-circle" class="mt-0.5 size-4 shrink-0 text-brick" aria-hidden="true" />
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                    <hr class="mt-4 border-divider">
                    <p class="mt-4 text-sm text-muted">Customer texting and AI features are billed by use.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Websites cross-sell: no direct Figma analog on this homepage — dark, continuing the zigzag. --}}
    <section class="border-y border-steel bg-carbon">
        <div class="mx-auto flex max-w-4xl flex-col items-center gap-4 px-6 py-14 text-center">
            <h2 class="font-heading text-xl font-medium text-cream">For every OS a complementary landing page is included.</h2>
            <p class="text-slate">We also build fast, mobile-first sites for trades businesses, built to get the phone to ring.</p>
            <a href="{{ route('websites') }}" wire:navigate class="font-medium text-brick hover:underline">See Websites &rarr;</a>
        </div>
    </section>

    {{-- Final CTA: matches Figma's dark "See what it would look like for your shop." section exactly.
         Photo kept — removing it would be a content change, not a visual-style one. --}}
    <section class="relative isolate overflow-hidden border-t border-steel">
        <x-photo name="home-cta" ratio="21/9" fill position="center 60%" label="Roofer on a new roof" alt="A roofer installing shingles" class="absolute inset-0 -z-20 rounded-none! border-0!" />
        <div class="absolute inset-0 -z-10 bg-carbon/75"></div>
        <div class="mx-auto max-w-3xl px-6 py-28 text-center">
            <h2 class="font-display text-3xl leading-tight text-cream sm:text-h1-cta">See what it would look like for your shop.</h2>
            <p class="mt-4 text-cream/80">We'll talk through how your jobs run today and show you what we'd build.</p>
            <a href="{{ route('contact') }}" wire:navigate
                class="mt-8 inline-flex h-14 items-center justify-center rounded-full bg-brick px-6 text-sm font-semibold text-cream transition hover:bg-brick/90 btn-arrow">
                Book a Discovery Call
            </a>
        </div>
    </section>
</div>
