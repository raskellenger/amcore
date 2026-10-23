<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('Trades We Serve — AmCore Systems');

view()->share('description', 'Plumbing, HVAC, electrical, painting and drywall, and roofing. See how an AmCore operating system fits the way your trade runs jobs.');

?>

@php
$trades = [
    ['id' => 'plumbing', 'name' => 'Plumbing', 'pain' => 'Service calls, callbacks, and T&M tickets scribbled on the back of a carbon copy.', 'fix' => 'Work orders go to the phone, parts and hours get logged on the job, and the invoice is ready when the truck pulls out.'],
    ['id' => 'hvac', 'name' => 'HVAC', 'pain' => 'Install schedules, service agreements, and seasonal rush all living in different places.', 'fix' => 'One schedule for installs and service calls, equipment tracked by job, and customer history a tap away before you knock.'],
    ['id' => 'electrical', 'name' => 'Electrical', 'pain' => 'Change orders and extra materials that never make it onto the bill.', 'fix' => 'Proposals, change orders, and job costing in one place, so the extras get billed and you see which jobs made money.'],
    ['id' => 'painting-drywall', 'name' => 'Painting & Drywall', 'pain' => 'Crews on several sites, punch lists in texts, and nobody sure what was promised.', 'fix' => "Each crew sees its assigned jobs and scope. Notes and updates stay on the work order instead of in someone's phone.", 'position' => 'center 63%'],
    ['id' => 'roofing', 'name' => 'Roofing', 'pain' => 'Weather moves the schedule, and every move means a round of calls and texts.', 'fix' => 'Reschedule once and everyone on the job gets the change. Estimates and invoices follow the same work order.'],
];
@endphp

<div class="mx-auto max-w-4xl px-6 py-24">
    <h1 class="font-display text-4xl leading-tight text-cream sm:text-h1-cta">Built around how your trade runs jobs.</h1>
    <p class="mt-4 max-w-2xl text-lg text-slate">
        Every trade has its own words and its own paperwork. We configure the system to yours. Not sure yours is listed? <a href="{{ route('contact') }}" wire:navigate class="font-medium text-brick hover:underline">Ask us.</a>
    </p>

    <x-photo name="trades-intro" ratio="21/9" position="center 35%" label="Planning the system" alt="A hand sketching a workflow diagram on a whiteboard" class="mt-8 rounded-xl shadow-card-dark" />

    <nav aria-label="Trades" class="mt-8 flex flex-wrap gap-2 text-sm font-medium">
        @foreach ($trades as $trade)
            <a href="#{{ $trade['id'] }}" class="rounded-full border border-steel px-3 py-1.5 text-cream hover:border-brick hover:text-brick">{{ $trade['name'] }}</a>
        @endforeach
    </nav>

    <div class="mt-12 space-y-6">
        @foreach ($trades as $trade)
            <section id="{{ $trade['id'] }}" class="hover-card scroll-mt-20 overflow-hidden rounded-lg border border-steel bg-graphite shadow-card-dark md:grid md:grid-cols-5">
                <x-photo :name="'trade-' . $trade['id']" ratio="3/2" :position="$trade['position'] ?? 'center'" :label="$trade['name'] . ' at work'" :alt="$trade['name'] . ' work in progress'" class="rounded-none border-0 md:col-span-2 md:aspect-auto" />
                <div class="p-8 md:col-span-3">
                <h2 class="font-heading text-h4 text-cream">{{ $trade['name'] }}</h2>
                <p class="mt-3 text-cream/80"><span class="font-semibold text-cream">The problem:</span> {{ $trade['pain'] }}</p>
                <p class="mt-2 text-cream/80"><span class="font-semibold text-cream">What changes:</span> {{ $trade['fix'] }}</p>
                </div>
            </section>
        @endforeach
    </div>

    <p class="mt-8 text-center text-xl text-slate">Plumbing, HVAC, electrical, painting &amp; drywall, roofing — <span class="font-display text-3xl font-bold text-brick">and more</span>.</p>

    <div class="mt-14 text-center">
        <a href="{{ route('contact') }}" wire:navigate
            class="inline-flex h-14 items-center justify-center rounded-full bg-brick px-6 text-sm font-semibold text-cream transition hover:bg-brick/90 btn-arrow">
            Book a Discovery Call
        </a>
    </div>
</div>
