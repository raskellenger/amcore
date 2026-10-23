<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('Terms of Use — AmCore Systems');

view()->share('description', 'AmCore Systems terms of use (draft).');

?>

<div class="mx-auto max-w-2xl px-6 py-24">
    <div class="rounded-lg border border-dashed border-brick bg-graphite px-4 py-2 text-center text-sm font-medium text-signal">
        DRAFT — attorney review required
    </div>

    <h1 class="mt-8 font-display text-4xl leading-tight text-cream sm:text-h1-cta">Terms of Use</h1>

    <div class="mt-8 space-y-8 text-cream/80">
        <div>
            <h2 class="font-heading text-lg font-medium text-cream">Acceptance of terms</h2>
            <p class="mt-2">By using this website, you agree to these terms.</p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-medium text-cream">What this site is</h2>
            <p class="mt-2">This is a marketing website for AmCore Systems LLC. Submitting the contact form starts a conversation about scheduling a discovery call — it isn't a purchase, a contract, or a commitment on either side.</p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-medium text-cream">Scope</h2>
            <p class="mt-2">AmCore Systems is not an IT support provider and does not set up or fix other companies' software. Nothing on this site should be read as IT support or consulting advice.</p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-medium text-cream">Availability</h2>
            <p class="mt-2">We aim to keep this site available at all times but don't guarantee uninterrupted access.</p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-medium text-cream">Limitation of liability</h2>
            <p class="mt-2"><span class="rounded border border-dashed border-steel px-2 py-1 text-sm text-slate">PLACEHOLDER — final liability language pending attorney review.</span></p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-medium text-cream">Governing law</h2>
            <p class="mt-2">These terms are governed by the laws of the State of South Carolina.</p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-medium text-cream">Contact</h2>
            <p class="mt-2">Reach us through the <a href="{{ route('contact') }}" wire:navigate class="text-signal hover:underline">contact page</a>.</p>
        </div>
    </div>
</div>
