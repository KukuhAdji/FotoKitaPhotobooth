{{-- Gunakan <x-button href="..."> untuk tautan, tanpa href untuk tombol. --}}
@props(['href' => null, 'variant' => 'solid', 'type' => 'button'])

@if ($href !== null)
    <a href="{{ $href }}" {{ $attributes->class(['pill', 'pill-outline' => $variant === 'outline']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class(['pill', 'pill-outline' => $variant === 'outline']) }}>
        {{ $slot }}
    </button>
@endif
