<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('About — AmCore Systems');

view()->share('description', 'AmCore Systems is a Greenville, SC company building business operating systems for trades businesses across the Upstate.');

?>

<div class="mx-auto max-w-3xl px-6 py-24">
    <h1 class="font-heading text-4xl font-semibold text-navy">About</h1>
    <p class="mt-4 text-lg text-ink/70">
        AmCore Systems is based in Greenville, South Carolina, and builds business operating systems for trades businesses across the Upstate.
    </p>

    <h2 class="mt-14 font-heading text-xl font-semibold text-navy">Where we come from</h2>
    <p class="mt-3 text-ink/80">
        Our founders come from the trades, not from software. Paint and drywall crews on national homebuilder jobs. Residential repaint. Trenching, crawlspaces, plumbing. And the paperwork side too — scheduling, billing, chasing down invoices that were three weeks late. We built AmCore because we'd lived the problem it solves.
    </p>

    <h2 class="mt-14 font-heading text-xl font-semibold text-navy">Why Greenville</h2>
    <p class="mt-3 text-ink/80">
        We're local. Discovery and training happen in person, at your shop — not over a screen-share with someone in another time zone.
    </p>

    <h2 class="mt-14 font-heading text-xl font-semibold text-navy">What we value</h2>
    <p class="mt-3 text-ink/70">
        <span class="rounded border border-dashed border-navy/30 px-2 py-1 text-sm">PLACEHOLDER — values statement not yet provided.</span>
    </p>

    <h2 class="mt-14 font-heading text-xl font-semibold text-navy">Founders</h2>
    <p class="mt-3 text-ink/70">
        <span class="rounded border border-dashed border-navy/30 px-2 py-1 text-sm">PLACEHOLDER — bios and photos not yet provided.</span>
    </p>
</div>
