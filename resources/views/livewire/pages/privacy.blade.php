<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('Privacy Policy — AmCore Systems');

?>

<div class="mx-auto max-w-2xl px-6 py-24">
    <div class="rounded border border-dashed border-bronze bg-white px-4 py-2 text-center text-sm font-semibold text-bronze">
        DRAFT — attorney review required
    </div>

    <h1 class="mt-8 font-heading text-4xl font-semibold text-navy">Privacy Policy</h1>

    <div class="mt-8 space-y-8 text-ink/80">
        <div>
            <h2 class="font-heading text-lg font-semibold text-navy">What we collect</h2>
            <p class="mt-2">When you submit the contact form on this site, we collect your name, company, trade, crew size, phone number, email address, and whatever you tell us about your business in the message field. We don't use cookies or trackers to build a profile of you.</p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-semibold text-navy">How we use it</h2>
            <p class="mt-2">We use it to follow up and schedule a discovery call. Nothing you submit through this form is used for anything else.</p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-semibold text-navy">Your data</h2>
            <p class="mt-2">You can ask us to show you what we have, correct it, or delete it, at any time. We don't sell or share your information with anyone.</p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-semibold text-navy">Cookies and analytics</h2>
            <p class="mt-2"><span class="rounded border border-dashed border-navy/30 px-2 py-1 text-sm text-ink/50">PLACEHOLDER — analytics provider not yet chosen.</span></p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-semibold text-navy">Questions</h2>
            <p class="mt-2">Reach us through the <a href="{{ route('contact') }}" wire:navigate class="text-brick hover:underline">contact page</a>.</p>
        </div>
    </div>
</div>
