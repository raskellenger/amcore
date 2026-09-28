<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'AmCore Systems' }}</title>
    <meta name="description" content="{{ $description ?? 'Operating systems for the trades. Built by tradesmen. Run for you.' }}">

    @if (request()->routeIs('case-studies'))
        <meta name="robots" content="noindex, nofollow">
    @endif

    @fluxAppearance

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-offwhite font-sans text-ink antialiased">
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded focus:bg-navy focus:px-4 focus:py-2 focus:text-white">
        Skip to content
    </a>

    <header class="border-b border-navy/10 bg-offwhite/95 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-6 px-6 py-4">
            <a href="{{ route('home') }}" class="flex items-center gap-2" wire:navigate>
                <img src="{{ asset('images/brand/amcore-logo-nav.png') }}" alt="AmCore Systems" class="h-9 w-auto">
            </a>

            <nav class="hidden items-center gap-8 text-sm font-medium lg:flex">
                <a href="{{ route('operating-systems') }}" class="hover:text-brick" wire:navigate>Operating Systems</a>
                <a href="{{ route('websites') }}" class="hover:text-brick" wire:navigate>Websites</a>
                <a href="{{ route('how-we-work') }}" class="hover:text-brick" wire:navigate>How We Work</a>
                <a href="{{ route('about') }}" class="hover:text-brick" wire:navigate>About</a>
                <a href="{{ route('faq') }}" class="hover:text-brick" wire:navigate>FAQ</a>
            </nav>

            <a href="{{ route('contact') }}" wire:navigate
                class="inline-flex shrink-0 items-center rounded bg-brick px-4 py-2 text-sm font-semibold text-white transition hover:bg-brick/90">
                Book a Discovery Call
            </a>
        </div>
    </header>

    <main id="main">
        {{ $slot }}
    </main>

    <footer class="mt-24 border-t border-navy/10 bg-navy text-offwhite">
        <div class="mx-auto grid max-w-6xl gap-10 px-6 py-14 sm:grid-cols-2 lg:grid-cols-4">
            <div class="lg:col-span-2">
                <img src="{{ asset('images/brand/amcore-logo-nav.png') }}" alt="AmCore Systems" class="h-8 w-auto brightness-0 invert">
                <p class="mt-4 max-w-sm text-sm text-offwhite/70">
                    Operating systems for the trades. Built by tradesmen, run for you. Serving Greenville and the Upstate.
                </p>
            </div>

            <div>
                <h2 class="font-heading text-sm font-semibold uppercase tracking-wide text-bronze">Company</h2>
                <ul class="mt-4 space-y-2 text-sm text-offwhite/80">
                    <li><a href="{{ route('operating-systems') }}" class="hover:text-white" wire:navigate>Operating Systems</a></li>
                    <li><a href="{{ route('websites') }}" class="hover:text-white" wire:navigate>Websites</a></li>
                    <li><a href="{{ route('how-we-work') }}" class="hover:text-white" wire:navigate>How We Work</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white" wire:navigate>About</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-white" wire:navigate>FAQ</a></li>
                </ul>
            </div>

            <div>
                <h2 class="font-heading text-sm font-semibold uppercase tracking-wide text-bronze">Legal</h2>
                <ul class="mt-4 space-y-2 text-sm text-offwhite/80">
                    <li><a href="{{ route('privacy') }}" class="hover:text-white" wire:navigate>Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="hover:text-white" wire:navigate>Terms of Use</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white" wire:navigate>Contact</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 py-6 text-center text-xs text-offwhite/60">
            &copy; {{ now()->year }} AmCore Systems LLC. Greenville, SC.
        </div>
    </footer>

    @fluxScripts
</body>
</html>
