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

    @if (request()->routeIs('case-studies', 'hero-lab', 'logo-lab', 'whiteboard'))
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
            ...(config('amcore.phone') ? ['telephone' => config('amcore.phone')] : []),
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
<body class="min-h-screen bg-carbon pb-16 sm:pb-0 font-sans text-cream antialiased">
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded focus:bg-brick focus:px-4 focus:py-2 focus:text-cream">
        Skip to content
    </a>

    <header x-data="{ mobileMenuOpen: false }" @keydown.escape.window="mobileMenuOpen = false" class="sticky top-0 z-50">
        <div class="mx-auto max-w-[1200px] px-6 pt-6">
            <div class="flex items-center justify-between gap-6 rounded-full bg-white px-6 py-3 text-ink shadow-card">
                <a href="{{ route('home') }}" class="flex items-center gap-2" wire:navigate>
                    <img src="{{ asset('images/brand/amcore-mark.png') }}" alt="" class="h-9 w-auto">
                    <img src="{{ asset('images/brand/amcore-wordmark.png') }}" alt="AmCore Systems" class="h-5 w-auto">
                </a>

                <nav class="hidden items-center gap-6 text-nav font-medium lg:flex">
                    <a href="{{ route('operating-systems') }}" class="link-draw hover:text-brick" wire:navigate>Operating Systems</a>
                    <a href="{{ route('trades') }}" class="link-draw hover:text-brick" wire:navigate>Trades</a>
                    <a href="{{ route('websites') }}" class="link-draw hover:text-brick" wire:navigate>Websites</a>
                    <a href="{{ route('how-we-work') }}" class="link-draw hover:text-brick" wire:navigate>How We Work</a>
                    <a href="{{ route('about') }}" class="link-draw hover:text-brick" wire:navigate>About</a>
                    <a href="{{ route('faq') }}" class="link-draw hover:text-brick" wire:navigate>FAQ</a>
                </nav>

                <div class="flex items-center gap-3">
                    <a href="{{ route('contact') }}" wire:navigate
                        class="hidden h-14 shrink-0 items-center justify-center rounded-full bg-brick btn-arrow px-6 text-sm font-semibold text-cream transition hover:bg-brick/90 sm:inline-flex">
                        Book a Discovery Call
                    </a>

                    <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" aria-controls="mobile-menu"
                        :aria-expanded="mobileMenuOpen" aria-label="Toggle menu" class="rounded p-2 text-ink hover:bg-ink/5 lg:hidden">
                        <flux:icon name="bars-3" x-show="!mobileMenuOpen" class="size-6" aria-hidden="true" />
                        <flux:icon name="x-mark" x-show="mobileMenuOpen" x-cloak class="size-6" aria-hidden="true" />
                    </button>
                </div>
            </div>

            <nav id="mobile-menu" x-show="mobileMenuOpen" x-cloak @click.outside="mobileMenuOpen = false"
                class="mt-2 flex flex-col gap-1 rounded-2xl bg-white px-6 py-4 text-sm font-medium text-ink shadow-card lg:hidden">
                <a href="{{ route('operating-systems') }}" @click="mobileMenuOpen = false" class="rounded px-2 py-2 hover:bg-ink/5 hover:text-brick" wire:navigate>Operating Systems</a>
                <a href="{{ route('trades') }}" @click="mobileMenuOpen = false" class="rounded px-2 py-2 hover:bg-ink/5 hover:text-brick" wire:navigate>Trades</a>
                <a href="{{ route('websites') }}" @click="mobileMenuOpen = false" class="rounded px-2 py-2 hover:bg-ink/5 hover:text-brick" wire:navigate>Websites</a>
                <a href="{{ route('how-we-work') }}" @click="mobileMenuOpen = false" class="rounded px-2 py-2 hover:bg-ink/5 hover:text-brick" wire:navigate>How We Work</a>
                <a href="{{ route('about') }}" @click="mobileMenuOpen = false" class="rounded px-2 py-2 hover:bg-ink/5 hover:text-brick" wire:navigate>About</a>
                <a href="{{ route('faq') }}" @click="mobileMenuOpen = false" class="rounded px-2 py-2 hover:bg-ink/5 hover:text-brick" wire:navigate>FAQ</a>
                <a href="{{ route('contact') }}" @click="mobileMenuOpen = false" wire:navigate
                    class="mt-2 inline-flex h-14 items-center justify-center rounded-full bg-brick px-6 font-semibold text-cream sm:hidden">
                    Book a Discovery Call
                </a>
            </nav>
        </div>
    </header>

    <main id="main">
        {{ $slot }}
    </main>

    <footer class="mt-24 border-t border-steel bg-cream text-ink">
        <div class="mx-auto grid max-w-[1200px] gap-10 px-6 py-14 sm:grid-cols-2 lg:grid-cols-4">
            <div class="lg:col-span-2">
                <span class="flex items-center gap-2">
                    <img src="{{ asset('images/brand/amcore-mark.png') }}" alt="" class="h-9 w-auto">
                    <img src="{{ asset('images/brand/amcore-wordmark.png') }}" alt="AmCore Systems" class="h-5 w-auto">
                </span>
                <p class="mt-4 max-w-sm text-sm text-muted">
                    Operating systems for the trades. Built by tradesmen, run for you. Serving Greenville and the Upstate.
                </p>
                <p class="mt-4 max-w-sm text-sm text-muted">
                    We also build fast, mobile-first websites for trades businesses.
                </p>
                <a href="{{ route('websites') }}" wire:navigate class="mt-2 inline-block text-sm font-medium text-brick hover:underline">See Websites &rarr;</a>
            </div>

            <div>
                <h2 class="mono text-xs uppercase text-muted">Company</h2>
                <ul class="mt-4 space-y-2 text-sm text-ink/80">
                    <li><a href="{{ route('operating-systems') }}" class="link-draw hover:text-brick" wire:navigate>Operating Systems</a></li>
                    <li><a href="{{ route('trades') }}" class="link-draw hover:text-brick" wire:navigate>Trades</a></li>
                    <li><a href="{{ route('websites') }}" class="link-draw hover:text-brick" wire:navigate>Websites</a></li>
                    <li><a href="{{ route('how-we-work') }}" class="link-draw hover:text-brick" wire:navigate>How We Work</a></li>
                    <li><a href="{{ route('about') }}" class="link-draw hover:text-brick" wire:navigate>About</a></li>
                    <li><a href="{{ route('faq') }}" class="link-draw hover:text-brick" wire:navigate>FAQ</a></li>
                </ul>
            </div>

            <div>
                <h2 class="mono text-xs uppercase text-muted">Legal</h2>
                <ul class="mt-4 space-y-2 text-sm text-ink/80">
                    <li><a href="{{ route('privacy') }}" class="link-draw hover:text-brick" wire:navigate>Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="link-draw hover:text-brick" wire:navigate>Terms of Use</a></li>
                    <li><a href="{{ route('contact') }}" class="link-draw hover:text-brick" wire:navigate>Contact</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-divider py-6 text-center text-xs text-muted">
            &copy; {{ now()->year }} AmCore Systems LLC. Greenville, SC.
        </div>
    </footer>

    {{-- Mobile action bar: click-to-call appears once AMCORE_PHONE is set. Hidden on the internal whiteboard so it does not cover the add button. --}}
    @unless (request()->routeIs('whiteboard'))
    <div class="fixed inset-x-0 bottom-0 z-40 flex gap-2 border-t border-steel bg-carbon p-2 sm:hidden">
        @if (config('amcore.phone'))
            <a href="tel:{{ config('amcore.phone') }}" class="inline-flex flex-1 items-center justify-center rounded-full border border-steel bg-graphite px-4 py-3 text-sm font-medium text-cream">Call</a>
        @endif
        <a href="{{ route('contact') }}" wire:navigate class="inline-flex flex-[2] items-center justify-center rounded-full bg-brick px-4 py-3 text-sm font-semibold text-cream">Book a Discovery Call</a>
    </div>
    @endunless

    @fluxScripts
</body>
</html>
