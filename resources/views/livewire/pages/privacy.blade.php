<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('Privacy Policy — AmCore Systems');

view()->share('description', 'AmCore Systems privacy policy (draft) — what we collect from the contact form and how we use it.');

?>

<div class="mx-auto max-w-2xl px-6 py-24">
    <div class="rounded border border-dashed border-brick bg-graphite px-4 py-2 text-center text-sm font-medium text-signal">
        DRAFT — attorney review required
    </div>

    <span class="eyebrow mb-5">Privacy</span>
    <h1 class="mt-8 font-heading text-4xl font-medium text-cream">Privacy Policy</h1>

    <div class="mt-8 space-y-8 text-cream/80">
        <div>
            <h2 class="font-heading text-lg font-medium text-cream">What we collect</h2>
            <p class="mt-2">When you submit the contact form on this site, we collect your name, company, trade, crew size, phone number, email address, and whatever you tell us about your business in the message field. We don't use cookies or trackers to build a profile of you.</p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-medium text-cream">How we use it</h2>
            <p class="mt-2">We use it to follow up and schedule a discovery call. Nothing you submit through this form is used for anything else.</p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-medium text-cream">Your data</h2>
            <p class="mt-2">You can ask us to show you what we have, correct it, or delete it, at any time. We don't sell or share your information with anyone.</p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-medium text-cream">Cookies and analytics</h2>
            <p class="mt-2"><span class="rounded border border-dashed border-steel px-2 py-1 text-sm text-slate">PLACEHOLDER — analytics provider not yet chosen.</span></p>
        </div>
        <div>
            <h2 class="font-heading text-lg font-medium text-cream">Questions</h2>
            <p class="mt-2">Reach us through the <a href="{{ route('contact') }}" wire:navigate class="text-signal hover:underline">contact page</a>.</p>
        </div>
    </div>
</div>
