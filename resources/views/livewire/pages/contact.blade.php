<?php

use App\Actions\Leads\SubmitDiscoveryRequest;
use App\Exceptions\TooManyDiscoveryRequestsException;
use App\Models\Lead;
use function Livewire\Volt\{layout, title, state};

layout('components.layouts.app');
title('Book a Discovery Call — AmCore Systems');

view()->share('description', 'Book a discovery call with AmCore Systems — serving Greenville and the Upstate.');

state([
    'name' => '',
    'company' => '',
    'trade' => '',
    'crew_size' => '',
    'phone' => '',
    'email' => '',
    'headache' => '',
    'preferred_contact_method' => '',
    'website' => '',
    'submitted' => false,
    'rateLimited' => false,
    'rateLimitedForSeconds' => 0,
]);

$submit = function () {
    $this->rateLimited = false;

    $this->validate(app(SubmitDiscoveryRequest::class)->rules());

    try {
        SubmitDiscoveryRequest::run($this->only([
            'name', 'company', 'trade', 'crew_size', 'phone', 'email', 'headache', 'preferred_contact_method', 'website',
        ]), request()->ip());
    } catch (TooManyDiscoveryRequestsException $e) {
        $this->rateLimited = true;
        $this->rateLimitedForSeconds = $e->availableInSeconds;

        return;
    }

    $this->reset(['name', 'company', 'trade', 'crew_size', 'phone', 'email', 'headache', 'preferred_contact_method', 'website']);
    $this->submitted = true;
};

?>

<div class="mx-auto max-w-5xl px-6 py-24 lg:grid lg:grid-cols-[minmax(0,40rem)_1fr] lg:gap-14">
<div>
    <span class="eyebrow mb-5">Contact</span>
    <h1 class="font-heading text-4xl font-medium text-cream">Book a Discovery Call</h1>
    <p class="mt-4 text-lg text-slate">
        Tell us a bit about your business, and we'll set up a time to talk — in person, at your shop, if you're in the Upstate.
    </p>

    @if ($submitted)
        <div wire:key="success" role="status" class="mt-10 rounded border border-steel bg-graphite p-6 text-center">
            <p class="font-heading text-lg font-medium text-cream">Got it.</p>
            <p class="mt-2 text-slate">We'll reach out within <span class="text-slate">[PLACEHOLDER: response time]</span> to schedule your discovery call.</p>
        </div>
    @else
        <form wire:submit="submit" class="mt-10 space-y-5" wire:key="form">
            <p class="text-sm text-slate"><span class="text-signal" aria-hidden="true">*</span> Required</p>

            {{-- Honeypot — zero-size clipped box, never visible, never announced, can't cause horizontal overflow --}}
            <div class="absolute h-0 w-0 overflow-hidden" aria-hidden="true">
                <label for="website">Website</label>
                <input type="text" id="website" wire:model="website" tabindex="-1" autocomplete="off">
            </div>

            <div>
                <label for="name" class="block text-sm font-semibold text-cream">Name <span class="text-signal" aria-hidden="true">*</span></label>
                <input type="text" id="name" wire:model="name" required
                    @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
                    class="mt-1 w-full rounded border border-steel px-3 py-2 bg-graphite text-cream focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick">
                @error('name') <p id="name-error" class="mt-1 text-sm text-signal">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="company" class="block text-sm font-semibold text-cream">Company</label>
                <input type="text" id="company" wire:model="company"
                    @error('company') aria-invalid="true" aria-describedby="company-error" @enderror
                    class="mt-1 w-full rounded border border-steel px-3 py-2 bg-graphite text-cream focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick">
                @error('company') <p id="company-error" class="mt-1 text-sm text-signal">{{ $message }}</p> @enderror
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="trade" class="block text-sm font-semibold text-cream">Trade <span class="text-signal" aria-hidden="true">*</span></label>
                    <select id="trade" wire:model="trade" required
                        @error('trade') aria-invalid="true" aria-describedby="trade-error" @enderror
                        class="mt-1 w-full rounded border border-steel px-3 py-2 bg-graphite text-cream focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick">
                        <option value="">Select one</option>
                        @foreach (Lead::TRADES as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('trade') <p id="trade-error" class="mt-1 text-sm text-signal">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="crew_size" class="block text-sm font-semibold text-cream">Crew size <span class="text-signal" aria-hidden="true">*</span></label>
                    <select id="crew_size" wire:model="crew_size" required
                        @error('crew_size') aria-invalid="true" aria-describedby="crew_size-error" @enderror
                        class="mt-1 w-full rounded border border-steel px-3 py-2 bg-graphite text-cream focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick">
                        <option value="">Select one</option>
                        @foreach (Lead::CREW_SIZES as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('crew_size') <p id="crew_size-error" class="mt-1 text-sm text-signal">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="phone" class="block text-sm font-semibold text-cream">Phone <span class="text-signal" aria-hidden="true">*</span></label>
                    <input type="tel" id="phone" wire:model="phone" required
                        @error('phone') aria-invalid="true" aria-describedby="phone-error" @enderror
                        class="mt-1 w-full rounded border border-steel px-3 py-2 bg-graphite text-cream focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick">
                    @error('phone') <p id="phone-error" class="mt-1 text-sm text-signal">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-cream">Email <span class="text-signal" aria-hidden="true">*</span></label>
                    <input type="email" id="email" wire:model="email" required
                        @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
                        class="mt-1 w-full rounded border border-steel px-3 py-2 bg-graphite text-cream focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick">
                    @error('email') <p id="email-error" class="mt-1 text-sm text-signal">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="headache" class="block text-sm font-semibold text-cream">What's your biggest headache right now? <span class="text-signal" aria-hidden="true">*</span></label>
                <textarea id="headache" wire:model="headache" rows="4" required
                    @error('headache') aria-invalid="true" aria-describedby="headache-error" @enderror
                    class="mt-1 w-full rounded border border-steel px-3 py-2 bg-graphite text-cream focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick"></textarea>
                @error('headache') <p id="headache-error" class="mt-1 text-sm text-signal">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="preferred_contact_method" class="block text-sm font-semibold text-cream">Preferred contact method <span class="text-signal" aria-hidden="true">*</span></label>
                <select id="preferred_contact_method" wire:model="preferred_contact_method" required
                    @error('preferred_contact_method') aria-invalid="true" aria-describedby="preferred_contact_method-error" @enderror
                    class="mt-1 w-full rounded border border-steel px-3 py-2 bg-graphite text-cream focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick">
                    <option value="">Select one</option>
                    @foreach (Lead::CONTACT_METHODS as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('preferred_contact_method') <p id="preferred_contact_method-error" class="mt-1 text-sm text-signal">{{ $message }}</p> @enderror
            </div>

            @if ($rateLimited)
                <p role="alert" class="rounded border border-brick/30 bg-brick/5 px-3 py-2 text-sm text-signal">
                    Too many discovery call requests from this connection. Try again in about {{ $rateLimitedForSeconds }} seconds, or call us directly.
                </p>
            @endif

            <button type="submit" wire:loading.attr="disabled" wire:target="submit"
                class="inline-flex items-center rounded bg-brick px-6 py-3 text-sm font-medium text-cream transition hover:bg-brick/90 disabled:opacity-60">
                <span wire:loading.remove wire:target="submit">Book a Discovery Call</span>
                <span wire:loading wire:target="submit">Sending...</span>
            </button>
        </form>
    @endif

    <div class="mt-14 border-t border-steel pt-8 text-sm text-slate">
        <p>
            Call:
            @if (config('amcore.phone'))
                <a href="tel:{{ config('amcore.phone') }}" class="font-medium text-signal hover:underline">{{ config('amcore.phone') }}</a>
            @else
                <span class="text-slate">[PLACEHOLDER: phone number]</span>
            @endif
            &middot; Email:
            @if (config('amcore.email'))
                <a href="mailto:{{ config('amcore.email') }}" class="font-medium text-signal hover:underline">{{ config('amcore.email') }}</a>
            @else
                <span class="text-slate">[PLACEHOLDER: email address]</span>
            @endif
        </p>
        <p class="mt-1">Serving Greenville and the Upstate.</p>
    </div>
</div>

<aside class="hidden lg:block">
    <x-photo name="contact-side" ratio="4/5" position="center 15%" label="Shop front or truck" alt="A painter at work" class="sticky top-24" />
</aside>
</div>
