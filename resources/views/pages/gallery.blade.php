@extends('layouts.app')

@section('title', 'Gallery — FotoKitaPhotobooth')
@section('description', 'Jelajahi momen-momen yang ingin diabadikan bersama FotoKitaPhotobooth.')
@section('page', 'gallery')

@section('content')
    <section class="shell py-16 text-center sm:py-24">
        <p class="eyebrow text-sand">Gallery</p>
        <h1 class="serif mx-auto mt-5 max-w-4xl text-4xl tracking-tight sm:text-6xl">Your people. <em>Your moments.</em></h1>
        <p class="muted mx-auto mt-6 max-w-2xl text-sm leading-7">
            Setiap acara punya cerita dan orang-orangnya sendiri. Galeri FotoKita akan menampilkan momen yang tertangkap
            dalam setiap bingkai.
        </p>
    </section>

    <section class="shell grid gap-4 border-y border-accent/15 py-10 sm:grid-cols-3 sm:py-14"
        aria-label="Galeri momen FotoKita">
        <article class="service rounded-xl border border-accent/10 p-6 sm:min-h-64">
            <p class="eyebrow text-sand">01 / Together</p>
            <h2 class="serif mt-12 text-3xl">Just the two of us.</h2>
            <p class="muted mt-3 text-xs leading-6">Momen berdua yang jadi bagian dari cerita hari spesial.</p>
        </article>
        <article class="service rounded-xl border border-accent/10 bg-surface/45 p-6 sm:min-h-64">
            <p class="eyebrow text-sand">02 / The whole gang</p>
            <h2 class="serif mt-12 text-3xl">All together.</h2>
            <p class="muted mt-3 text-xs leading-6">Satu bingkai untuk tawa dan kebersamaan bersama sahabat.</p>
        </article>
        <article class="service rounded-xl border border-accent/10 p-6 sm:min-h-64">
            <p class="eyebrow text-sand">03 / A celebration</p>
            <h2 class="serif mt-12 text-3xl">A day to remember.</h2>
            <p class="muted mt-3 text-xs leading-6">Kenang kembali suasana acara lewat foto yang bisa dibawa pulang.</p>
        </article>
    </section>

    <section class="shell py-16 text-center sm:py-20">
        <p class="muted mx-auto max-w-xl text-xs leading-6">
            Ingin melihat contoh foto dari acara tertentu? Ceritakan jenis acara dan tanggalnya kepada tim FotoKita.
        </p>
        <a class="pill mt-6" href="{{ route('contact') }}">Hubungi kami <svg class="icon" aria-hidden="true">
                <use href="#i-arrow" />
            </svg></a>
    </section>
@endsection