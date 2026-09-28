<x-layouts.app title="Page not found — AmCore Systems">
    <div class="mx-auto max-w-2xl px-6 py-32 text-center">
        <p class="font-heading text-sm font-semibold uppercase tracking-wide text-bronze">404</p>
        <h1 class="mt-2 font-heading text-3xl font-semibold text-navy">We couldn't find that page.</h1>
        <p class="mt-4 text-ink/70">The page you're looking for moved, or never existed. Head back to the homepage, or book a discovery call.</p>
        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ route('home') }}" class="rounded border border-navy px-4 py-2 text-sm font-semibold text-navy hover:bg-navy hover:text-white">Back to Home</a>
            <a href="{{ route('contact') }}" class="rounded bg-brick px-4 py-2 text-sm font-semibold text-white hover:bg-brick/90">Book a Discovery Call</a>
        </div>
    </div>
</x-layouts.app>
