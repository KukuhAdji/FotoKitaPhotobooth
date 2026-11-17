@extends('layouts.app')

@section('title', 'Contact — FotoKitaPhotobooth')
@section('description', 'Hubungi FotoKitaPhotobooth untuk bertanya tentang layanan dan ketersediaan jadwal.')
@section('page', 'contact')

@section('content')
    <section class="shell py-16 text-center sm:py-24">
        <p class="eyebrow text-sand">Contact</p>
        <h1 class="serif mx-auto mt-5 max-w-4xl text-4xl tracking-tight sm:text-6xl">Momen berikutnya, <em>bareng
                FotoKita.</em></h1>
        <p class="muted mx-auto mt-6 max-w-2xl text-sm leading-7">
            Punya tanggal spesial? Siapkan tanggal acara, jenis acara, dan lokasi untuk menanyakan paket serta
            ketersediaan jadwal kepada tim FotoKita.
        </p>
        <a class="pill mt-8" href="{{ route('home') }}#contact">Isi form permintaan <svg class="icon" aria-hidden="true">
                <use href="#i-arrow" />
            </svg></a>
    </section>

    <section class="shell grid gap-4 border-y border-accent/15 py-10 sm:grid-cols-3 sm:py-14"
        aria-label="Informasi untuk menghubungi FotoKita">
        <article class="service rounded-xl p-5">
            <p class="eyebrow text-sand">01 / When</p>
            <h2 class="mt-4 text-sm font-semibold">Tanggal acara</h2>
            <p class="muted mt-3 text-xs leading-6">Sampaikan tanggal agar ketersediaan jadwal bisa ditanyakan.</p>
        </article>
        <article class="service rounded-xl bg-surface/45 p-5">
            <p class="eyebrow text-sand">02 / What</p>
            <h2 class="mt-4 text-sm font-semibold">Jenis acara</h2>
            <p class="muted mt-3 text-xs leading-6">Ceritakan apakah photobooth dibutuhkan untuk wedding, birthday,
                atau acara lainnya.</p>
        </article>
        <article class="service rounded-xl p-5">
            <p class="eyebrow text-sand">03 / Where</p>
            <h2 class="mt-4 text-sm font-semibold">Lokasi acara</h2>
            <p class="muted mt-3 text-xs leading-6">Bagikan nama venue atau alamat untuk membantu membahas kebutuhan
                lokasi.</p>
        </article>
    </section>
@endsection