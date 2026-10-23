@props(['name', 'ratio' => '3/2', 'alt' => '', 'label' => null, 'position' => 'center', 'fill' => false])

{{--
    One photo slot. Resolution order:
      1. public/images/photos/{name}.(jpg|jpeg|webp|png)   real photos. These ship.
      2. public/images/stock-draft/{name}.jpg              stock drafts. Local only, git-ignored.
      3. A labeled placeholder frame.
    Stock never renders outside the local environment.
--}}
@php
    $real = collect(['jpg', 'jpeg', 'webp', 'png'])
        ->map(fn (string $ext): string => "images/photos/{$name}.{$ext}")
        ->first(fn (string $path): bool => file_exists(public_path($path)));

    $stock = null;
    if (! $real && app()->environment('local') && file_exists(public_path("images/stock-draft/{$name}.jpg"))) {
        $stock = "images/stock-draft/{$name}.jpg";
    }

    $src = $real ?? $stock;
@endphp

<figure {{ $attributes->class([$fill ? '' : 'relative', 'overflow-hidden rounded-xl border border-steel bg-graphite']) }} @unless ($fill) style="aspect-ratio: {{ $ratio }}" @endunless>
    @if ($src)
        <img src="{{ asset($src) }}" alt="{{ $alt }}" loading="lazy" class="size-full object-cover" style="object-position: {{ $position }}">
        @if ($stock)
            <figcaption class="mono absolute left-2 top-2 z-10 rounded bg-carbon/80 px-2 py-1 text-[11px] text-slate">STOCK DRAFT · local only</figcaption>
        @endif
    @else
        <div class="flex size-full flex-col items-center justify-center gap-1 border border-dashed border-steel p-4 text-center">
            <span class="mono text-xs text-slate">[PLACEHOLDER: photo]</span>
            <span class="text-sm text-cream/80">{{ $label ?? $name }}</span>
            <span class="mono text-xs text-slate">{{ str_replace('/', ':', $ratio) }}</span>
        </div>
    @endif
</figure>
