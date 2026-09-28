<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('FAQ — AmCore Systems');

view()->share('description', "Answers on offline access, data ownership, security, pricing, and what AmCore does and doesn't do.");

?>

@php
$faqs = [
    ['What happens if we lose signal on a job?', 'The system keeps working. It captures everything offline and syncs the moment you\'re back in range.'],
    ['Who owns our data?', "You do. You can export it any time. We don't sell or share it."],
    ['What if AmCore goes out of business?', "You'd get at least 60 days' notice and a full export of your data if the platform were ever discontinued."],
    ['Do we have to change how we work?', 'No. The system is configured to your forms, your terms, and your process — not the other way around.'],
    ['Is it secure?', 'Data is hosted on infrastructure that holds SOC 2 Type II attestation, encrypted at rest and in transit, including backups. A web application firewall filters traffic, and crews only see the jobs assigned to them.'],
    ['Are there per-user fees?', 'No. One setup fee, one monthly fee, no matter how many people are using it.'],
    ['Does it work with QuickBooks?', 'Yes — invoicing connects directly to QuickBooks.'],
    ["What don't you do?", "We're not IT support, and we don't set up or fix other companies' software. We're not consultants either — we show you how the system supports your business. You make the business decisions."],
    ['How long does it take to get up and running?', 'About 60 days from your first discovery call to running the system company-wide.'],
    ['Do you build websites too?', 'Yes — see the Websites page.'],
    ['What trades do you work with?', 'Plumbing, HVAC, electrical, painting and drywall, roofing, and similar trades across the Upstate.'],
    ["What's the setup process like?", 'It starts in person, at your shop — see How We Work.'],
];
@endphp

<div class="mx-auto max-w-3xl px-6 py-24">
    <h1 class="font-heading text-4xl font-semibold text-navy">FAQ</h1>

    <dl class="mt-10 divide-y divide-navy/10">
        @foreach ($faqs as [$question, $answer])
            <div class="py-6">
                <dt class="font-heading font-semibold text-navy">{{ $question }}</dt>
                <dd class="mt-2 text-ink/80">{{ $answer }}</dd>
            </div>
        @endforeach
    </dl>
</div>
