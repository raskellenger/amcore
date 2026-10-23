<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('How We Work — AmCore Systems');

view()->share('description', "How AmCore works with you: discovery at your shop, in-person training, and ongoing support.");

?>

@php

@endphp

<div class="mx-auto max-w-3xl px-6 py-24">
    <h1 class="font-display text-4xl leading-tight text-cream sm:text-h1-cta">How We Work</h1>
    <p class="mt-4 text-lg text-slate">In person, at your shop, with the people who do the work.</p>

    <x-photo name="how-system" ratio="21/9" position="center" label="HVAC ductwork and plumbing lines on one building" alt="HVAC ductwork and copper plumbing lines running together on a building exterior" class="mt-10 rounded-xl shadow-card-dark" />


    <h2 class="mt-14 font-heading text-h4 text-cream">The stages</h2>
    <p class="mt-3 text-cream/80">No fixed dates. We move at the pace of your jobs, and we give you a real timeline on the discovery call.</p>
    <ol class="mt-6 space-y-4">
        @foreach ([
            ['Discovery with the owner', 'What you want the business to look like, what keeps you up, and what you need to see.'],
            ['Discovery with the field', 'Time with the crews. How a job really runs, what gets written down, what gets lost.'],
            ['Discovery with the office', 'Time with whoever does the scheduling, billing, and chasing invoices.'],
            ['Configuration', 'We build the system around your forms, your terms, and your process.'],
            ['A trial on real jobs', 'A few crews run it on live work. We fix what they find.'],
            ['In-person training, then rollout', 'We train your people at your shop and turn it on for everyone.'],
            ['Ongoing support', 'A real person you can call. Updates and security stay with us.'],
        ] as $i => [$stage, $detail])
            <li class="hover-card rounded-lg border border-steel bg-graphite p-4 shadow-card-dark">
                <p class="mono text-xs text-signal">{{ str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) }}</p>
                <h3 class="mt-1 font-heading font-medium text-cream">{{ $stage }}</h3>
                <p class="mt-1 text-cream/80">{{ $detail }}</p>
            </li>
        @endforeach
    </ol>

    <h2 class="mt-14 font-heading text-h4 text-cream">What we need from you</h2>
    <p class="mt-3 text-cream/80">
        Time with the people who actually do the work, office and field. Copies of the paperwork you use today: work orders, estimates, invoices. And a few crews willing to run it on real jobs before the full rollout.
    </p>

    <div class="mt-14">
        <a href="{{ route('contact') }}" wire:navigate class="inline-flex h-14 items-center justify-center rounded-full bg-brick px-6 text-sm font-semibold text-cream transition hover:bg-brick/90 btn-arrow">
            Book a Discovery Call
        </a>
    </div>
</div>
