<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('Terms of Use — AmCore Systems');

view()->share('description', 'AmCore Systems terms of use (draft).');

?>

<div class="mx-auto max-w-2xl px-6 py-24">
    <div class="rounded border border-dashed border-bronze bg-white px-4 py-2 text-center text-sm font-semibold text-bronze">
        DRAFT — attorney review required
    </div>

    <h1 class="mt-8 font-heading text-4xl font-semibold text-navy">Terms of Use</h1>

    <div class="mt-8 space-y-8 text-ink/80">
        <div>
            <h2 class="font-heading text-lg font-semibold text-navy">Acceptance of terms</h2>
            <p class="mt-2">By using this website, you agree to these terms.</p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-semibold text-navy">What this site is</h2>
            <p class="mt-2">This is a marketing website for AmCore Systems LLC. Submitting the contact form starts a conversation about scheduling a discovery call — it isn't a purchase, a contract, or a commitment on either side.</p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-semibold text-navy">Scope</h2>
            <p class="mt-2">AmCore Systems is not an IT support provider and does not set up or fix other companies' software. Nothing on this site should be read as IT support or consulting advice.</p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-semibold text-navy">Availability</h2>
            <p class="mt-2">We aim to keep this site available at all times but don't guarantee uninterrupted access.</p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-semibold text-navy">Limitation of liability</h2>
            <p class="mt-2"><span class="rounded border border-dashed border-navy/30 px-2 py-1 text-sm text-ink/70">PLACEHOLDER — final liability language pending attorney review.</span></p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-semibold text-navy">Governing law</h2>
            <p class="mt-2">These terms are governed by the laws of the State of South Carolina.</p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-semibold text-navy">Contact</h2>
            <p class="mt-2">Reach us through the <a href="{{ route('contact') }}" wire:navigate class="text-brick hover:underline">contact page</a>.</p>
        </div>
    </div>
</div>
