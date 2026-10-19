<x-layouts.app title="Page not found — AmCore Systems">
    <div class="mx-auto max-w-2xl px-6 py-32 text-center">
        <p class="font-heading text-sm font-medium uppercase tracking-wide text-signal">404</p>
        <h1 class="mt-2 font-heading text-3xl font-medium text-cream">We couldn't find that page.</h1>
        <p class="mt-4 text-slate">The page you're looking for moved, or never existed. Head back to the homepage, or book a discovery call.</p>
        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ route('home') }}" class="rounded border border-steel px-4 py-2 text-sm font-semibold text-cream hover:bg-graphite hover:text-cream">Back to Home</a>
            <a href="{{ route('contact') }}" class="rounded bg-brick px-4 py-2 text-sm font-medium text-cream hover:bg-brick/90">Book a Discovery Call</a>
        </div>
    </div>
</x-layouts.app>
