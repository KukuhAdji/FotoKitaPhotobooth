@extends('layouts.app')

@section('title', 'About FotoKitaPhotobooth')
@section('description', 'Kenali FotoKitaPhotobooth dan cara kami membantu mengabadikan momen spesial.')
@section('page', 'about')

@section('content')
    <section class="shell py-16 text-center sm:py-24">
        <p class="eyebrow text-sand">About FotoKita</p>
        <h1 class="serif mx-auto mt-5 max-w-4xl text-4xl tracking-tight sm:text-6xl">Momen sebentar. <em>Kenangan
                selamanya.</em></h1>
        <p class="muted mx-auto mt-6 max-w-2xl text-sm leading-7">
            Di FotoKita, setiap jepretan adalah cara merayakan kebersamaan. Kami menghadirkan pengalaman photobooth yang
            hangat, frame yang personal, dan foto yang bisa langsung dibawa pulang.
        </p>
    </section>

    <section class="shell grid gap-4 border-y border-accent/15 py-10 sm:grid-cols-3 sm:py-14">
        <article class="service rounded-xl p-5">
            <p class="eyebrow text-sand">01 / The moment</p>
            <h2 class="mt-4 text-sm font-semibold">Jadi diri sendiri</h2>
            <p class="muted mt-3 text-xs leading-6">Tawa spontan dan pose favorit membuat setiap foto terasa seperti
                ceritamu sendiri.</p>
        </article>
        <article class="service rounded-xl p-5">
            <p class="eyebrow text-sand">02 / The keepsake</p>
            <h2 class="mt-4 text-sm font-semibold">Bawa pulang kenangan</h2>
            <p class="muted mt-3 text-xs leading-6">Cetakan foto menjadi kenang-kenangan yang bisa disimpan setelah acara
                selesai.</p>
        </article>
        <article class="service rounded-xl p-5">
            <p class="eyebrow text-sand">03 / Your story</p>
            <h2 class="mt-4 text-sm font-semibold">Frame yang personal</h2>
            <p class="muted mt-3 text-xs leading-6">Tampilan frame dapat disesuaikan dengan tema dan karakter acara
                spesialmu.</p>
        </article>
    </section>

    <section class="shell flex flex-col items-start justify-between gap-6 py-16 sm:flex-row sm:items-center sm:py-20">
        <div>
            <p class="eyebrow text-sand">Make it a memory</p>
            <h2 class="serif mt-3 text-3xl sm:text-4xl">Cari pengalaman yang pas untuk acaramu?</h2>
        </div>
        <a class="pill" href="{{ route('services') }}">Lihat services <svg class="icon" aria-hidden="true">
                <use href="#i-arrow" />
            </svg></a>
    </section>
@endsection
