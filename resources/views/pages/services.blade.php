@extends('layouts.app')

@section('title', 'Services — FotoKitaPhotobooth')
@section('description', 'Lihat pengalaman photobooth FotoKita untuk wedding, birthday, gathering, dan acara spesial.')
@section('page', 'services')

@section('content')
    <section class="shell py-16 text-center sm:py-24">
        <p class="eyebrow text-sand">Services</p>
        <h1 class="serif mx-auto mt-5 max-w-4xl text-4xl tracking-tight sm:text-6xl">Detail kecil yang membuat momen
            <em>lebih berarti.</em>
        </h1>
        <p class="muted mx-auto mt-6 max-w-2xl text-sm leading-7">
            Dari foto yang bisa langsung dibawa pulang sampai pengalaman berpose bersama orang-orang tersayang, pilih
            kebutuhan yang ingin kamu hadirkan di acaramu.
        </p>
    </section>

    <section class="shell grid gap-4 border-y border-accent/15 py-10 md:grid-cols-3 sm:py-14"
        aria-label="Layanan FotoKita">
        <article class="service rounded-xl p-6">
            <div class="mb-6 flex items-center justify-between">
                <svg class="icon !h-7 !w-7 text-accent" aria-hidden="true"><use href="#i-print" /></svg>
                <span class="text-[10px] text-sand">01</span>
            </div>
            <h2 class="text-base font-semibold">Jepret. Cetak. Simpan.</h2>
            <p class="muted mt-3 text-xs leading-6">Hasil foto langsung dicetak agar tamu punya kenang-kenangan yang
                bisa dibawa pulang.</p>
        </article>
        <article class="service rounded-xl bg-surface/45 p-6">
            <div class="mb-6 flex items-center justify-between">
                <svg class="icon !h-7 !w-7 text-accent" aria-hidden="true"><use href="#i-frame" /></svg>
                <span class="text-[10px] text-sand">02</span>
            </div>
            <h2 class="text-base font-semibold">Frame seunik ceritamu.</h2>
            <p class="muted mt-3 text-xs leading-6">Desain bingkai dapat disesuaikan dengan tema dan karakter acara
                spesialmu.</p>
        </article>
        <article class="service rounded-xl p-6">
            <div class="mb-6 flex items-center justify-between">
                <svg class="icon !h-7 !w-7 text-accent" aria-hidden="true"><use href="#i-spark" /></svg>
                <span class="text-[10px] text-sand">03</span>
            </div>
            <h2 class="text-base font-semibold">Datang, pose, bersenang-senang.</h2>
            <p class="muted mt-3 text-xs leading-6">Pengalaman foto yang santai untuk wedding, birthday, corporate
                event, dan gathering.</p>
        </article>
    </section>

    <section class="shell flex flex-col items-start justify-between gap-6 py-16 sm:flex-row sm:items-center sm:py-20">
        <div>
            <p class="eyebrow text-sand">Plan your event</p>
            <h2 class="serif mt-3 text-3xl sm:text-4xl">Paket dan ketersediaan dibicarakan sesuai kebutuhan acara.</h2>
        </div>
        <a class="pill" href="{{ route('contact') }}">Hubungi kami <svg class="icon" aria-hidden="true">
                <use href="#i-arrow" />
            </svg></a>
    </section>
@endsection
