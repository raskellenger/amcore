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

<div class="mx-auto max-w-2xl px-6 py-24">
    <h1 class="font-heading text-4xl font-semibold text-navy">Book a Discovery Call</h1>
    <p class="mt-4 text-lg text-ink/70">
        Tell us a bit about your business, and we'll set up a time to talk — in person, at your shop, if you're in the Upstate.
    </p>

    @if ($submitted)
        <div wire:key="success" class="mt-10 rounded border border-navy/10 bg-white p-6 text-center">
            <p class="font-heading text-lg font-semibold text-navy">Got it.</p>
            <p class="mt-2 text-ink/70">We'll reach out within <span class="text-ink/70">[PLACEHOLDER: response time]</span> to schedule your discovery call.</p>
        </div>
    @else
        <form wire:submit="submit" class="mt-10 space-y-5" wire:key="form">
            {{-- Honeypot — zero-size clipped box, never visible, never announced, can't cause horizontal overflow --}}
            <div class="absolute h-0 w-0 overflow-hidden" aria-hidden="true">
                <label for="website">Website</label>
                <input type="text" id="website" wire:model="website" tabindex="-1" autocomplete="off">
            </div>

            <div>
                <label for="name" class="block text-sm font-semibold text-navy">Name</label>
                <input type="text" id="name" wire:model="name" class="mt-1 w-full rounded border border-navy/20 px-3 py-2 focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick">
                @error('name') <p class="mt-1 text-sm text-brick">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="company" class="block text-sm font-semibold text-navy">Company</label>
                <input type="text" id="company" wire:model="company" class="mt-1 w-full rounded border border-navy/20 px-3 py-2 focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick">
                @error('company') <p class="mt-1 text-sm text-brick">{{ $message }}</p> @enderror
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="trade" class="block text-sm font-semibold text-navy">Trade</label>
                    <select id="trade" wire:model="trade" class="mt-1 w-full rounded border border-navy/20 px-3 py-2 focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick">
                        <option value="">Select one</option>
                        @foreach (Lead::TRADES as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('trade') <p class="mt-1 text-sm text-brick">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="crew_size" class="block text-sm font-semibold text-navy">Crew size</label>
                    <select id="crew_size" wire:model="crew_size" class="mt-1 w-full rounded border border-navy/20 px-3 py-2 focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick">
                        <option value="">Select one</option>
                        @foreach (Lead::CREW_SIZES as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('crew_size') <p class="mt-1 text-sm text-brick">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="phone" class="block text-sm font-semibold text-navy">Phone</label>
                    <input type="tel" id="phone" wire:model="phone" class="mt-1 w-full rounded border border-navy/20 px-3 py-2 focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick">
                    @error('phone') <p class="mt-1 text-sm text-brick">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-navy">Email</label>
                    <input type="email" id="email" wire:model="email" class="mt-1 w-full rounded border border-navy/20 px-3 py-2 focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick">
                    @error('email') <p class="mt-1 text-sm text-brick">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="headache" class="block text-sm font-semibold text-navy">What's your biggest headache right now?</label>
                <textarea id="headache" wire:model="headache" rows="4" class="mt-1 w-full rounded border border-navy/20 px-3 py-2 focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick"></textarea>
                @error('headache') <p class="mt-1 text-sm text-brick">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="preferred_contact_method" class="block text-sm font-semibold text-navy">Preferred contact method</label>
                <select id="preferred_contact_method" wire:model="preferred_contact_method" class="mt-1 w-full rounded border border-navy/20 px-3 py-2 focus:border-brick focus:outline-none focus:ring-1 focus:ring-brick">
                    <option value="">Select one</option>
                    @foreach (Lead::CONTACT_METHODS as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('preferred_contact_method') <p class="mt-1 text-sm text-brick">{{ $message }}</p> @enderror
            </div>

            @if ($rateLimited)
                <p class="rounded border border-brick/30 bg-brick/5 px-3 py-2 text-sm text-brick">
                    Too many discovery call requests from this connection. Try again in about {{ $rateLimitedForSeconds }} seconds, or call us directly.
                </p>
            @endif

            <button type="submit" wire:loading.attr="disabled" wire:target="submit"
                class="inline-flex items-center rounded bg-brick px-6 py-3 font-semibold text-white transition hover:bg-brick/90 disabled:opacity-60">
                <span wire:loading.remove wire:target="submit">Book a Discovery Call</span>
                <span wire:loading wire:target="submit">Sending...</span>
            </button>
        </form>
    @endif

    <div class="mt-14 border-t border-navy/10 pt-8 text-sm text-ink/70">
        <p>Call: <span class="text-ink/70">[PLACEHOLDER]</span> &middot; Email: <span class="text-ink/70">[PLACEHOLDER]</span></p>
        <p class="mt-1">Serving Greenville and the Upstate.</p>
    </div>
</div>
