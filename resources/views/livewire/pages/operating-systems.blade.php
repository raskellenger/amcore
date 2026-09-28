<?php

use function Livewire\Volt\{layout, title};

layout('components.layouts.app');
title('Operating Systems — AmCore Systems');

view()->share('description', 'Eight modules — work orders, scheduling, invoicing, and more — one system configured to your trades business. Hosting and support included.');

?>

@php
$modules = [
    ['icon' => 'clipboard-document-list', 'name' => 'Work Orders', 'what' => 'Create, assign, and close out work orders from the shop or the truck.', 'why' => 'Crews always know the job, the address, and what\'s expected before they arrive.'],
    ['icon' => 'phone', 'name' => 'Intake & Customer Contacts', 'what' => 'Every call, form, and job history in one place.', 'why' => 'No more digging through three apps to find out who a customer is.'],
    ['icon' => 'calendar-days', 'name' => 'Scheduling & Dispatch', 'what' => 'See every crew, every job, every day at a glance.', 'why' => 'Fewer double-bookings, fewer trucks driving in circles.'],
    ['icon' => 'banknotes', 'name' => 'Invoicing', 'what' => 'Turn a finished job into an invoice in a few taps, connected to QuickBooks.', 'why' => "Bills go out the day the job's done, not three weeks later."],
    ['icon' => 'document-text', 'name' => 'Proposals & Estimating', 'what' => 'Build and send estimates from the field.', 'why' => "Close the job while you're still standing in the driveway."],
    ['icon' => 'cube', 'name' => 'Inventory & Equipment', 'what' => 'Track materials and equipment by job and by truck.', 'why' => 'Know what you have before you order more of it.'],
    ['icon' => 'chart-bar', 'name' => 'Reporting & Job Costing', 'what' => 'See what a job actually cost, in real numbers.', 'why' => 'Stop guessing whether a job made money.'],
    ['icon' => 'chat-bubble-left-right', 'name' => 'Notifications & Messaging', 'what' => 'In-app updates and messages, not lost texts.', 'why' => 'Everyone on the job sees the same information at the same time.'],
];
@endphp

<div class="mx-auto max-w-5xl px-6 py-20">
    <h1 class="font-heading text-4xl font-semibold text-navy">One system. Built around how you already work.</h1>
    <p class="mt-4 max-w-2xl text-lg text-ink/70">
        One cloud system, configured to how your business already runs — not a rigid off-the-shelf tool you have to bend around. Below is what's inside.
    </p>

    <div class="mt-12 grid gap-6 sm:grid-cols-2">
        @foreach ($modules as $module)
            <div class="rounded border border-navy/10 bg-white p-6">
                <flux:icon :name="$module['icon']" class="size-6 text-brick" aria-hidden="true" />
                <h2 class="mt-3 font-heading text-lg font-semibold text-navy">{{ $module['name'] }}</h2>
                <p class="mt-2 text-ink/80">{{ $module['what'] }}</p>
                <p class="mt-2 text-sm text-ink/70">{{ $module['why'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-16 grid gap-10 sm:grid-cols-2">
        <div>
            <h2 class="font-heading text-xl font-semibold text-navy">Built for the field</h2>
            <p class="mt-3 text-ink/80">
                Voice-to-text notes instead of typing on a truck dashboard. Offline capture on job sites with no signal — the system syncs the moment a crew's back in range. Sign in with Face ID or a fingerprint, not a password you re-type in gloves.
            </p>
        </div>
        <div>
            <h2 class="font-heading text-xl font-semibold text-navy">Connected to your books</h2>
            <p class="mt-3 text-ink/80">
                Invoicing runs straight into QuickBooks. No re-entering the same job twice — once on the truck, once in accounting.
            </p>
        </div>
    </div>

    <div class="mt-16">
        <h2 class="font-heading text-xl font-semibold text-navy">Configured to you</h2>
        <p class="mt-3 max-w-2xl text-ink/80">
            We build the system around your forms, your terms, and your process — not a template you have to adapt to. Your work orders look like your work orders.
        </p>
    </div>

    <div class="mt-16 rounded border border-navy/10 bg-navy p-8 text-offwhite">
        <h2 class="font-heading text-xl font-semibold">What the monthly service includes</h2>
        <ul class="mt-4 space-y-2 text-offwhite/85">
            <li>Hosting, security, and daily off-site backups</li>
            <li>Ongoing updates and maintenance</li>
            <li>Support from a real person, not a ticket queue</li>
            <li>An uptime commitment with automatic bill credits for unplanned downtime</li>
        </ul>
    </div>

    <div class="mt-16 text-center">
        <a href="{{ route('contact') }}" wire:navigate class="inline-flex items-center rounded bg-brick px-6 py-3 font-semibold text-white transition hover:bg-brick/90">
            Book a Discovery Call
        </a>
    </div>
</div>
