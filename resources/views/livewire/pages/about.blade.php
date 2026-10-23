<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('About — AmCore Systems');

view()->share('description', 'AmCore Systems is a Greenville, SC company building business operating systems for trades businesses across the Upstate.');

?>

<div class="mx-auto max-w-3xl px-6 py-24">
    <h1 class="font-display text-4xl leading-tight text-cream sm:text-h1-cta">About</h1>
    <p class="mt-4 text-lg text-slate">
        AmCore Systems is based in Greenville, South Carolina, and builds business operating systems for trades businesses across the Upstate.
    </p>

    <x-photo name="about-shop" ratio="4/3" position="center 25%" label="The AmCore team" alt="The AmCore team" class="mt-10 max-w-md" />

    <h2 class="mt-14 font-heading text-h4 text-cream">Where we come from</h2>
    <p class="mt-3 text-cream/80">
        Our founders come from the trades, not from software. Paint and drywall crews on national homebuilder jobs. Residential repaint. Trenching, crawlspaces, plumbing. And the paperwork side too — scheduling, billing, chasing down invoices that were three weeks late. We built AmCore because we'd lived the problem it solves.
    </p>

    <h2 class="mt-14 font-heading text-h4 text-cream">Why Greenville</h2>
    <p class="mt-3 text-cream/80">
        We're local. Discovery and training happen in person, at your shop — not over a screen-share with someone in another time zone.
    </p>

    <h2 class="mt-14 font-heading text-h4 text-cream">What we value</h2>
    <p class="mt-3 text-slate">
        <span class="rounded-md border border-dashed border-steel px-2 py-1 text-sm">PLACEHOLDER — values statement not yet provided.</span>
    </p>

    <h2 class="mt-14 font-heading text-h4 text-cream">Founders</h2>
    <p class="mt-3 text-slate">
        <span class="rounded-md border border-dashed border-steel px-2 py-1 text-sm">PLACEHOLDER — bios and photos not yet provided.</span>
    </p>
    <div class="mt-6 grid max-w-md grid-cols-2 gap-4">
        <x-photo name="about-founder-1" ratio="4/5" label="Founder portrait: real person only" />
        <x-photo name="about-founder-2" ratio="4/5" label="Founder portrait: real person only" />
    </div>
</div>
