<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'AmCore Systems' }}</title>
    <meta name="description" content="{{ $description ?? 'Operating systems for the trades. Built by tradesmen. Run for you.' }}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/brand/icon-32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/brand/icon-16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/brand/icon-180.png') }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="AmCore Systems">
    <meta property="og:title" content="{{ $title ?? 'AmCore Systems' }}">
    <meta property="og:description" content="{{ $description ?? 'Operating systems for the trades. Built by tradesmen. Run for you.' }}">
    <meta property="og:image" content="{{ asset('images/brand/og-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">

    @if (request()->routeIs('case-studies'))
        <meta name="robots" content="noindex, nofollow">
    @endif

    {{-- LocalBusiness structured data. Street address, postal code, and phone are placeholders pending real values — see docs/reference.md. --}}
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => 'AmCore Systems LLC',
            'url' => url('/'),
            'areaServed' => 'Greenville, SC and the Upstate',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Greenville',
                'addressRegion' => 'SC',
                'addressCountry' => 'US',
            ],
        ], JSON_UNESCAPED_SLASHES) !!}
    </script>

    @if (config('services.analytics.script_url'))
        <script defer data-domain="{{ config('services.analytics.domain') }}" src="{{ config('services.analytics.script_url') }}"></script>
    @endif

    @fluxAppearance

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-offwhite font-sans text-ink antialiased">
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded focus:bg-navy focus:px-4 focus:py-2 focus:text-white">
        Skip to content
    </a>

    <header x-data="{ mobileMenuOpen: false }" @keydown.escape.window="mobileMenuOpen = false" class="relative border-b border-navy/10 bg-offwhite/95 backdrop-blur">
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

            <div class="flex items-center gap-3">
                <a href="{{ route('contact') }}" wire:navigate
                    class="hidden shrink-0 items-center rounded bg-brick px-4 py-2 text-sm font-semibold text-white transition hover:bg-brick/90 sm:inline-flex">
                    Book a Discovery Call
                </a>

                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" aria-controls="mobile-menu"
                    :aria-expanded="mobileMenuOpen" aria-label="Toggle menu" class="rounded p-2 text-navy hover:bg-navy/5 lg:hidden">
                    <flux:icon name="bars-3" x-show="!mobileMenuOpen" class="size-6" aria-hidden="true" />
                    <flux:icon name="x-mark" x-show="mobileMenuOpen" x-cloak class="size-6" aria-hidden="true" />
                </button>
            </div>
        </div>

        <nav id="mobile-menu" x-show="mobileMenuOpen" x-cloak @click.outside="mobileMenuOpen = false"
            class="absolute inset-x-0 top-full z-40 flex flex-col gap-1 border-b border-navy/10 bg-offwhite px-6 py-4 text-sm font-medium shadow-lg lg:hidden">
            <a href="{{ route('operating-systems') }}" @click="mobileMenuOpen = false" class="rounded px-2 py-2 hover:bg-navy/5 hover:text-brick" wire:navigate>Operating Systems</a>
            <a href="{{ route('websites') }}" @click="mobileMenuOpen = false" class="rounded px-2 py-2 hover:bg-navy/5 hover:text-brick" wire:navigate>Websites</a>
            <a href="{{ route('how-we-work') }}" @click="mobileMenuOpen = false" class="rounded px-2 py-2 hover:bg-navy/5 hover:text-brick" wire:navigate>How We Work</a>
            <a href="{{ route('about') }}" @click="mobileMenuOpen = false" class="rounded px-2 py-2 hover:bg-navy/5 hover:text-brick" wire:navigate>About</a>
            <a href="{{ route('faq') }}" @click="mobileMenuOpen = false" class="rounded px-2 py-2 hover:bg-navy/5 hover:text-brick" wire:navigate>FAQ</a>
            <a href="{{ route('contact') }}" @click="mobileMenuOpen = false" wire:navigate
                class="mt-2 inline-flex items-center justify-center rounded bg-brick px-4 py-2 font-semibold text-white sm:hidden">
                Book a Discovery Call
            </a>
        </nav>
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
                <h2 class="font-heading text-sm font-semibold uppercase tracking-wide text-offwhite/70">Company</h2>
                <ul class="mt-4 space-y-2 text-sm text-offwhite/80">
                    <li><a href="{{ route('operating-systems') }}" class="hover:text-white" wire:navigate>Operating Systems</a></li>
                    <li><a href="{{ route('websites') }}" class="hover:text-white" wire:navigate>Websites</a></li>
                    <li><a href="{{ route('how-we-work') }}" class="hover:text-white" wire:navigate>How We Work</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white" wire:navigate>About</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-white" wire:navigate>FAQ</a></li>
                </ul>
            </div>

            <div>
                <h2 class="font-heading text-sm font-semibold uppercase tracking-wide text-offwhite/70">Legal</h2>
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
