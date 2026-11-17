@extends('layouts.app')

@section('title', 'Our Location — FotoKitaPhotobooth')
@section('description', 'Informasi lokasi acara dan ketersediaan layanan FotoKitaPhotobooth.')
@section('page', 'location')

@section('content')
    <section class="shell py-16 text-center sm:py-24">
        <p class="eyebrow text-sand">Our Location</p>
        <h1 class="serif mx-auto mt-5 max-w-4xl text-4xl tracking-tight sm:text-6xl">Momenmu, di <em>lokasimu.</em></h1>
        <p class="muted mx-auto mt-6 max-w-2xl text-sm leading-7">
            Ceritakan tempat acara akan berlangsung agar tim FotoKita dapat membantu mengecek ketersediaan layanan dan
            detail kebutuhan lokasi.
        </p>
    </section>

    <section class="shell grid gap-8 border-y border-accent/15 py-10 sm:grid-cols-[1fr_1.2fr] sm:py-14">
        <div>
            <p class="eyebrow text-sand">Event location</p>
            <h2 class="serif mt-4 text-3xl">Rencanakan photobooth di tempat acaramu.</h2>
        </div>
        <div class="rounded-xl border border-accent/15 bg-surface/35 p-6 sm:p-8">
            <h2 class="text-sm font-semibold">Informasi yang perlu disiapkan</h2>
            <ul class="muted mt-4 space-y-3 text-xs leading-6">
                <li>Tanggal dan jenis acara</li>
                <li>Nama venue atau alamat lokasi acara</li>
                <li>Catatan khusus mengenai area photobooth</li>
            </ul>
            <p class="muted mt-6 border-t border-accent/15 pt-5 text-xs leading-6">
                Area layanan, kebutuhan tempat, dan ketersediaan akan dikonfirmasi langsung sebelum booking disepakati.
            </p>
            <a class="pill mt-6" href="{{ route('contact') }}">Tanyakan ketersediaan <svg class="icon" aria-hidden="true">
                    <use href="#i-arrow" />
                </svg></a>
        </div>
    </section>
@endsection