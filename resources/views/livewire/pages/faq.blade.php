<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('FAQ — AmCore Systems');

view()->share('description', "Answers on offline access, data ownership, security, pricing, and what AmCore does and doesn't do.");

?>

@php
$faqs = [
    ['What happens if we lose signal on a job?', "Keep working. The system captures everything offline and syncs the moment you're back in range."],
    ['Who owns our data?', "You do. You can export it any time. We don't sell or share it."],
    ['What if we decide to stop working with AmCore?', 'You take your data with you. Export it any time, and we help you move.'],
    ['Do we have to change how we work?', "No. The system is configured to your forms, your terms, and your process. Part of discovery is spotting ways to tighten what you already do, and we'll share suggestions. You decide what to change."],
    ["We're all on paper. Can you move us?", 'Yes. Bring the paperwork you use today. We build the system around it and train your people in person.'],
    ['We already use QuickBooks. What happens to it?', 'Invoicing connects directly to QuickBooks, so your books stay where they are.'],
    ['Is it secure?', 'Data is hosted on infrastructure that holds SOC 2 Type II attestation, encrypted at rest and in transit, including backups. A web application firewall filters traffic, and crews only see the jobs assigned to them.'],
    ['Do you charge by the seat?', "No. One setup fee, one monthly fee, no per-user fees. Book a discovery call and we'll walk through what fits your shop."],
    ["What don't you do?", "We're not IT support, and we don't set up or fix other companies' software. We're not consultants either: we show you how the system supports your business. You make the business decisions."],
    ['How long does it take to get up and running?', "It depends on your business. We'll give you a real timeline on your discovery call."],
    ['Do you build websites too?', 'Yes. See the Websites page.'],
    ['What trades do you work with?', 'We start with plumbing, HVAC, electrical, painting and drywall, and roofing. Tile, flooring, or something else? If you can give us the time for a proper discovery, we can make it work.'],
    ["What's the setup process like?", 'It starts in person, at your shop, with the owner, the field, and the office as separate conversations. See How We Work for the stages.'],
];
@endphp

<div class="mx-auto max-w-3xl px-6 py-24">
    <h1 class="font-display text-4xl leading-tight text-cream sm:text-h1-cta">FAQ</h1>

    <dl class="mt-10 divide-y divide-steel">
        @foreach ($faqs as [$question, $answer])
            <div class="py-6">
                <dt class="font-heading font-medium text-cream">{{ $question }}</dt>
                <dd class="mt-2 text-cream/80">{{ $answer }}</dd>
            </div>
        @endforeach
    </dl>
</div>
