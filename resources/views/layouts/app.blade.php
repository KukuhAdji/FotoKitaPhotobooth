{{-- Template bersama: navbar, footer, ikon, dan dialog legal berada di file ini. --}}
@php
    $homeUrl = \Illuminate\Support\Facades\Route::has('home') ? route('home') : url('/');
    $aboutUrl = \Illuminate\Support\Facades\Route::has('about') ? route('about') : $homeUrl . '#about';
    $servicesUrl = \Illuminate\Support\Facades\Route::has('services') ? route('services') : $homeUrl . '#services';
    $bookingUrl = \Illuminate\Support\Facades\Route::has('booking') ? route('booking') : $homeUrl . '#contact';
    $galleryUrl = \Illuminate\Support\Facades\Route::has('gallery') ? route('gallery') : $homeUrl . '#experiences';
    $contactUrl = \Illuminate\Support\Facades\Route::has('contact') ? route('contact') : $homeUrl . '#contact';
    $locationUrl = \Illuminate\Support\Facades\Route::has('location') ? route('location') : $homeUrl . '#contact';
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#1F1009">
    <meta name="description" content="@yield('description', 'FotoKitaPhotobooth — photobooth untuk momen yang ingin kamu simpan.')">
    <title>@yield('title', 'FotoKitaPhotobooth')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/fotokita/favicon.svg') }}">

    {{-- Dua entry ini harus terdaftar di vite.config.js. CSS tidak perlu diimport lagi di app.js. --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body data-page="@yield('page', 'default')" class="min-h-screen">
    <a class="skip-link" href="#main-content">Lewati ke konten utama</a>
    <svg class="hidden" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <symbol id="i-arrow" viewBox="0 0 24 24">
            <path d="M5 12h14m-6-6 6 6-6 6" />
        </symbol>
        <symbol id="i-up-right" viewBox="0 0 24 24">
            <path d="M6 18 18 6M6 6h12v12" />
        </symbol>
        <symbol id="i-camera" viewBox="0 0 24 24">
            <path d="M8 5 6 8H3v12h18V8h-3l-2-3Z" />
            <circle cx="12" cy="13" r="4" />
        </symbol>
        <symbol id="i-print" viewBox="0 0 24 24">
            <path d="M6 9V3h12v6M6 17H3V9h18v8h-3M6 14h12v7H6Z" />
            <path d="M17 11h1" />
        </symbol>
        <symbol id="i-frame" viewBox="0 0 24 24">
            <rect x="3" y="3" width="18" height="18" rx="2" />
            <path d="M7 3v18M17 3v18M3 7h4M3 12h4M3 17h4M17 7h4M17 12h4M17 17h4" />
        </symbol>
        <symbol id="i-spark" viewBox="0 0 24 24">
            <path d="m12 3 2.5 6.5L21 12l-6.5 2.5L12 21l-2.5-6.5L3 12l6.5-2.5Z" />
        </symbol>
    </svg>

    <header class="relative z-30 border-b border-accent/10 bg-chocolate" id="home">
        <div class="shell flex h-24 items-center justify-between gap-5">
            <a href="{{ $homeUrl }}" aria-label="FotoKitaPhotobooth — beranda" class="flex items-center gap-5">
                <span class="brand" aria-hidden="true"><span class="brand-dot">foto</span><span>kita</span></span>
                <span
                    class="hidden border-l border-accent/20 pl-5 text-[9px] leading-relaxed tracking-[.22em] text-muted sm:block">PHOTOBOOTH<br>MADE
                    FOR MEMORIES</span>
            </a>
            <nav aria-label="Navigasi utama" class="hidden items-center gap-7 lg:flex">
                <a class="nav-link" href="{{ $homeUrl }}"
                    @if (request()->routeIs('home')) aria-current="page" @endif>Home</a>
                <a class="nav-link" href="{{ $aboutUrl }}"
                    @if (request()->routeIs('about')) aria-current="page" @endif>About</a>
                <a class="nav-link" href="{{ $servicesUrl }}"
                    @if (request()->routeIs('services')) aria-current="page" @endif>Services</a>
                <a class="nav-link" href="{{ $galleryUrl }}"
                    @if (request()->routeIs('gallery')) aria-current="page" @endif>Gallery</a>
                <a class="nav-link" href="{{ $locationUrl }}"
                    @if (request()->routeIs('location')) aria-current="page" @endif>Our Location</a>
                <a class="nav-link" href="{{ $contactUrl }}"
                    @if (request()->routeIs('contact')) aria-current="page" @endif>Contact</a>
            </nav>
            <div class="flex items-center gap-3">
                <x-button :href="$bookingUrl" class="min-h-10! px-5! py-2.5!">Book Now <svg class="icon !h-4 !w-4"
                        aria-hidden="true">
                        <use href="#i-up-right" />
                    </svg></x-button>
                <button id="menu-toggle" type="button"
                    class="flex h-11 w-11 items-center justify-center rounded-full border border-accent/25 lg:hidden"
                    aria-expanded="false" aria-controls="mobile-menu" aria-label="Buka menu navigasi" hidden><svg
                        class="icon" aria-hidden="true" viewBox="0 0 24 24">
                        <path d="M4 7h16M4 12h16M4 17h16" />
                    </svg></button>
            </div>
        </div>
        <nav id="mobile-menu" aria-label="Navigasi mobile"
            class="mobile-panel border-t border-accent/10 bg-chocolate-soft">
            <div class="shell grid gap-1 py-4">
                <a class="nav-link !py-3" href="{{ $homeUrl }}"
                    @if (request()->routeIs('home')) aria-current="page" @endif>Home</a>
                <a class="nav-link !py-3" href="{{ $aboutUrl }}"
                    @if (request()->routeIs('about')) aria-current="page" @endif>About</a>
                <a class="nav-link !py-3" href="{{ $servicesUrl }}"
                    @if (request()->routeIs('services')) aria-current="page" @endif>Services</a>
                <a class="nav-link !py-3" href="{{ $galleryUrl }}"
                    @if (request()->routeIs('gallery')) aria-current="page" @endif>Gallery</a>
                <a class="nav-link !py-3" href="{{ $locationUrl }}"
                    @if (request()->routeIs('location')) aria-current="page" @endif>Our Location</a>
                <a class="nav-link !py-3" href="{{ $contactUrl }}"
                    @if (request()->routeIs('contact')) aria-current="page" @endif>Contact</a>
            </div>
        </nav>
    </header>

    <main id="main-content">
        @yield('content')
    </main>

    <footer class="border-t border-accent/15 bg-chocolate-deep">
        <div class="shell grid gap-12 py-14 lg:grid-cols-[1.4fr_1.6fr]">
            <div><a href="{{ $homeUrl }}" class="brand"
                    aria-label="FotoKitaPhotobooth — kembali ke beranda"><span class="brand-dot"
                        aria-hidden="true">foto</span><span aria-hidden="true">kita</span></a>
                <p class="muted mt-6 max-w-xs text-xs leading-6">A little flash, a lasting memory.<br>Photobooth untuk
                    cerita yang ingin kamu simpan.</p><span
                    class="mt-4 inline-flex items-center gap-2 text-[9px] tracking-[.13em] text-sand"><svg
                        class="icon !h-3 !w-3" aria-hidden="true">
                        <use href="#i-camera" />
                    </svg> MADE WITH LOVE, CAPTURED BY FOTOKITA</span>
            </div>
            <div class="grid grid-cols-3 gap-5 sm:gap-8">
                <nav aria-label="Footer About">
                    <h2 class="mb-4 text-xs font-semibold text-accent">About</h2>
                    <ul>
                        <li><a class="footer-link" href="{{ $aboutUrl }}">Our Story</a></li>
                        <li><a class="footer-link" href="{{ $servicesUrl }}">Our Services</a></li>
                        <li><a class="footer-link" href="{{ $galleryUrl }}">Gallery</a></li>
                    </ul>
                </nav>
                <nav aria-label="Footer Company">
                    <h2 class="mb-4 text-xs font-semibold text-accent">Company</h2>
                    <ul>
                        <li><a class="footer-link" href="{{ $contactUrl }}">Contact Us</a></li>
                        <li><a class="footer-link" href="{{ $bookingUrl }}">Book a Booth</a></li>
                        <li><a class="footer-link" href="{{ $locationUrl }}">Our Location</a></li>
                        <li><a class="footer-link" href="{{ $homeUrl }}#faq">FAQ</a></li>
                    </ul>
                </nav>
                <nav aria-label="Footer Legal">
                    <h2 class="mb-4 text-xs font-semibold text-accent">Legal</h2>
                    <ul>
                        <li><a class="footer-link" href="#terms-policy" data-policy="terms-policy">Terms &amp;
                                Conditions</a></li>
                        <li><a class="footer-link" href="#privacy-policy" data-policy="privacy-policy">Privacy
                                Policy</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div
            class="shell flex flex-col justify-between gap-3 border-t border-accent/10 py-6 text-[10px] text-quiet sm:flex-row">
            <p>© {{ date('Y') }} FotoKitaPhotobooth. All rights reserved.</p>
            <p>Every moment deserves a little magic. <span class="ml-1 text-accent" aria-hidden="true">✦</span></p>
        </div>
    </footer>

    {{-- Ringkasan untuk form draf landing; sesuaikan dengan kebijakan final bisnis. --}}
    <section id="policy-fallback" class="shell space-y-6 py-8">
        <article id="terms-policy">
            <h2 class="serif text-2xl">Permintaan &amp; konfirmasi booking</h2>
            <p class="muted mt-4 text-sm leading-7">Mengisi form atau mengirim pesan adalah permintaan informasi, bukan
                reservasi yang sudah disetujui. Ketersediaan tanggal, harga, fasilitas, pembayaran, serta ketentuan
                perubahan atau pembatalan dibicarakan dan disepakati langsung bersama tim FotoKita sebelum pemesanan
                dikonfirmasi.</p>
        </article>
        <article id="privacy-policy">
            <h2 class="serif text-2xl">Privasi form ini</h2>
            <p class="muted mt-4 text-sm leading-7">Pada form draf landing page, nama, tanggal acara, dan keterangan
                yang kamu isi hanya digunakan di browser untuk menyusun pesan. Form ini tidak menyimpan data ke server.
                Pesan baru diteruskan ke layanan WhatsApp ketika kamu membuka tautannya; pengiriman pesan mengikuti
                tindakanmu di WhatsApp dan kebijakan layanan tersebut.</p>
        </article>
        <article id="terms-policy">
            <h2 class="serif text-2xl">Ulasan &amp; pemesanan</h2>
            <p class="muted mt-4 text-sm leading-7">Bagikan pengalamanmu sendiri dengan bahasa yang sopan.
                Gunakan foto yang berhak kamu bagikan dan pastikan orang yang tampak di dalamnya setuju
                untuk dipublikasikan. Mengirim ulasan tidak membuat reservasi. Ketersediaan jadwal,
                harga, fasilitas, dan ketentuan pemesanan dikonfirmasi langsung bersama tim FotoKita.</p>
        </article>
        <article id="privacy-policy">
            <h2 class="serif text-2xl">Privasi ulasan</h2>
            <p class="muted mt-4 text-sm leading-7">Form ulasan dapat digunakan tanpa akun. Nama, isi ulasan,
            kategori pengalaman, waktu pengiriman, dan foto yang kamu lampirkan disimpan untuk
            menampilkan ulasan kepada pengunjung website. Nama, ulasan, kategori, tanggal, dan foto
            tersebut dapat dilihat publik. Hindari mengunggah nomor telepon, alamat, dokumen pribadi,
            atau informasi sensitif lainnya. Untuk permintaan terkait ulasanmu, hubungi kanal resmi FotoKita.</p>
        </article>
    </section>
    <dialog id="policy-dialog" class="policy-dialog" aria-labelledby="policy-title">
        <div class="flex items-start justify-between gap-5">
            <h2 id="policy-title" class="serif text-2xl"></h2><button type="button" id="close-policy"
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-accent/30 text-xl"
                aria-label="Tutup informasi">×</button>
        </div>
        <div id="policy-content" class="muted mt-5 text-sm leading-7"></div>
    </dialog>


    @stack('scripts')
</body>

</html>
