@extends('layouts.app')

@section('title', 'FotoKitaPhotobooth — Every Moment, A Memory')
@section('description',
    'Abadikan momen pernikahan, ulang tahun, dan acara spesial dengan photobooth, cetak foto, serta
    frame personal FotoKita.')
@section('page', 'landing')

@section('content')
    @php
        // Nilai khusus halaman didefinisikan di sini, tidak bergantung pada variabel parent layout.
        $landingHomeUrl = \Illuminate\Support\Facades\Route::has('home') ? route('home') : url('/');
        $landingBookingUrl = \Illuminate\Support\Facades\Route::has('booking')
            ? route('booking')
            : $landingHomeUrl . '#contact';
        $whatsappNumber = preg_replace('/\D+/', '', (string) config('fotokita.whatsapp', ''));
        if (str_starts_with($whatsappNumber, '0')) {
            $whatsappNumber = '62' . substr($whatsappNumber, 1);
        }

        $photoPaths = config('fotokita.photos', ['images/fotokita/photo-01.jpg']);
        if (empty($photoPaths)) {
            $photoPaths = ['images/fotokita/photo-01.jpg'];
        }
        $photos = array_map(fn($path) => asset($path), array_values($photoPaths));
        $statistics = config('fotokita.statistics', []);
    @endphp

    <section class="hero relative" aria-labelledby="hero-title">
        <div class="photo-wall" aria-hidden="true">
            @for ($strip = 0; $strip < 7; $strip++)
                <div class="wall-strip">
                    @for ($frame = 0; $frame < 4; $frame++)
                        <img src="{{ $photos[($strip + $frame) % count($photos)] }}" width="420" height="500"
                            alt="" decoding="async">
                    @endfor
                    <small>FOTOKITA · MEMORIES</small>
                </div>
            @endfor
        </div>
        <div class="absolute inset-0 -z-2 bg-black/40" aria-hidden="true"></div>
        <div class="hero-shade" aria-hidden="true"></div>
        <div class="hero-copy shell relative py-20 text-center">
            <p class="eyebrow mb-7 inline-flex items-center gap-3 text-accent"><span class="h-1 w-1 rounded-full bg-accent"
                    aria-hidden="true"></span>A little flash. A lot of feeling.<span class="h-1 w-1 rounded-full bg-accent"
                    aria-hidden="true"></span></p>
            <h1 class="serif mx-auto max-w-4xl" id="hero-title">Step into the magic<br>of <em>every moment.</em></h1>
            <p class="mx-auto mt-7 max-w-md text-sm leading-7 text-warm sm:text-[15px]">Tawa spontan, pose favorit, dan
                orang-orang tersayang.<br class="hidden sm:block"> Kami abadikan semuanya dalam satu bingkai cerita.</p>
            <div class="mt-9 flex flex-col items-center justify-center gap-5 sm:flex-row sm:gap-7">
                <x-button :href="$landingBookingUrl" class="min-h-13! px-7!">Cek Jadwal &amp; Book <svg class="icon"
                        aria-hidden="true">
                        <use href="#i-up-right" />
                    </svg></x-button>
                <a href="#experiences"
                    class="inline-flex min-h-11 items-center gap-2 border-b border-accent/35 text-xs text-accent transition hover:border-accent">Lihat
                    keseruannya <svg class="icon !h-4 !w-4" aria-hidden="true">
                        <use href="#i-arrow" />
                    </svg></a>
            </div>
            <p class="mt-9 text-[10px] tracking-[.1em] text-muted">INSTANT PRINTS <span class="px-2"
                    aria-hidden="true">·</span> PERSONAL FRAMES <span class="px-2" aria-hidden="true">·</span> REAL
                MEMORIES</p>
        </div>
        <div class="shell absolute bottom-7 left-0 right-0 flex items-center justify-between text-[9px] tracking-[.2em] text-muted"
            aria-hidden="true"><span>01 / MAKE A MEMORY</span><span>SCROLL TO EXPLORE ↓</span></div>
    </section>

    <section aria-label="FotoKita dalam angka" class="shell border-b border-accent/15 py-12 sm:py-14">
        {{-- Data ilustrasi: sesuaikan angka dan klaim dengan data usaha sebelum dipublikasikan. --}}
        <dl class="statistics grid grid-cols-2 gap-y-8 sm:grid-cols-3 lg:grid-cols-5">
            @foreach ($statistics as $stat)
                <div class="flex flex-col px-3 text-center">
                    <dt class="order-2 mt-3 text-[10px] tracking-[.07em] text-muted">{{ $stat['label'] }}</dt>
                    <dd class="serif stat-number order-1 text-accent">{{ $stat['value'] }}</dd>
                </div>
            @endforeach
        </dl>
    </section>

    <section id="about" aria-labelledby="about-title" class="shell py-20 text-center sm:py-24">
        <p class="eyebrow text-sand">More than just a photo</p>
        <h2 id="about-title" class="serif mt-5 text-4xl tracking-tight sm:text-5xl">Momen sebentar. <em>Kenangan
                selamanya.</em></h2>
        <p class="muted mx-auto mt-6 max-w-2xl text-sm leading-7">Di FotoKita, setiap jepretan adalah cara merayakan
            kebersamaan. Dari pernikahan hingga kumpul bersama teman, kami hadir dengan photobooth yang hangat, frame yang
            personal, dan foto yang bisa langsung dibawa pulang. Kamu cukup hadir, berpose, dan jadi diri sendiri.</p>
        <a href="#services"
            class="mt-6 inline-flex min-h-11 items-center gap-2 text-xs text-accent underline decoration-accent/40 underline-offset-8">Kenali
            pengalaman FotoKita <svg class="icon !h-4 !w-4" aria-hidden="true">
                <use href="#i-arrow" />
            </svg></a>
    </section>

    <section id="services" aria-labelledby="services-title" class="shell border-y border-accent/15 py-9">
        <div class="mb-7 flex flex-wrap items-end justify-between gap-3">
            <h2 id="services-title" class="eyebrow text-sand">The FotoKita experience</h2><span
                class="text-[11px] text-muted">Detail kecil yang bikin momen lebih berarti.</span>
        </div>
        <div class="grid gap-3 md:grid-cols-3">
            <article class="service rounded-xl p-5">
                <div class="mb-5 flex items-center justify-between"><svg class="icon !h-7 !w-7 text-accent"
                        aria-hidden="true">
                        <use href="#i-print" />
                    </svg><span class="text-[10px] text-sand">01</span></div>
                <h3 class="text-sm font-semibold">Jepret. Cetak. Simpan.</h3>
                <p class="muted mt-3 text-xs leading-6">Hasil foto langsung dicetak untuk jadi kenang-kenangan yang bisa
                    kamu pegang.</p>
            </article>
            <article class="service rounded-xl bg-surface/45 p-5">
                <div class="mb-5 flex items-center justify-between"><svg class="icon !h-7 !w-7 text-accent"
                        aria-hidden="true">
                        <use href="#i-frame" />
                    </svg><span class="text-[10px] text-sand">02</span></div>
                <h3 class="text-sm font-semibold">Frame seunik ceritamu.</h3>
                <p class="muted mt-3 text-xs leading-6">Desain bingkai yang disesuaikan dengan tema dan karakter acara
                    spesialmu.</p>
            </article>
            <article class="service rounded-xl p-5">
                <div class="mb-5 flex items-center justify-between"><svg class="icon !h-7 !w-7 text-accent"
                        aria-hidden="true">
                        <use href="#i-spark" />
                    </svg><span class="text-[10px] text-sand">03</span></div>
                <h3 class="text-sm font-semibold">Datang, pose, bersenang-senang.</h3>
                <p class="muted mt-3 text-xs leading-6">Pengalaman foto yang santai untuk wedding, birthday, hingga
                    corporate event.</p>
            </article>
        </div>
    </section>

    <section id="experiences" aria-labelledby="experiences-title" class="shell py-20 sm:py-24">
        <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div>
                <p class="eyebrow text-sand">Good times, captured.</p>
                <h2 id="experiences-title" class="serif mt-4 text-4xl tracking-tight sm:text-5xl">Your people. <em>Your
                        moments.</em></h2>
            </div>
            <p class="muted max-w-xs text-xs leading-6">Tak perlu pose sempurna.<br>Cukup kamu, mereka, dan cerita di
                antaranya.</p>
        </div>
        <div class="mx-auto mt-14 grid max-w-5xl gap-7 px-3 sm:grid-cols-3 sm:gap-5">
            <figure class="memory"><img src="{{ $photos[2 % count($photos)] }}"
                    alt="Foto ilustrasi pasangan menikmati momen bersama" width="420" height="500" loading="lazy"
                    decoding="async">
                <figcaption class="mt-4 flex items-center justify-between gap-2"><span class="serif text-lg italic">Just
                        the two of us.</span><span class="text-[8px] tracking-widest">FOTO KITA</span></figcaption>
            </figure>
            <figure class="memory"><img src="{{ $photos[0] }}"
                    alt="Foto ilustrasi sekelompok sahabat tersenyum bersama" width="420" height="500"
                    loading="lazy" decoding="async">
                <figcaption class="mt-4 flex items-center justify-between gap-2"><span class="serif text-lg italic">The
                        whole gang.</span><span class="text-[8px] tracking-widest">FOTO KITA</span></figcaption>
            </figure>
            <figure class="memory"><img src="{{ $photos[1 % count($photos)] }}"
                    alt="Foto ilustrasi teman-teman merayakan kebersamaan" width="420" height="500" loading="lazy"
                    decoding="async">
                <figcaption class="mt-4 flex items-center justify-between gap-2"><span class="serif text-lg italic">A day
                        to remember.</span><span class="text-[8px] tracking-widest">FOTO KITA</span></figcaption>
            </figure>
        </div>
    </section>

    <section id="reviews" class="shell pb-20" aria-labelledby="reviews-title" data-review-section
        data-feed-url="{{ route('reviews.index') }}" data-page="{{ $reviewFeed['meta']['current_page'] }}"
        data-has-more="{{ $reviewFeed['meta']['has_more'] ? 'true' : 'false' }}">
        <div class="review-intro">
            <div>
                <p class="eyebrow text-sand">Real people. Real memories.</p>
                <h2 id="reviews-title" class="serif mt-4 text-4xl tracking-tight sm:text-5xl">Cerita kamu,<br><em>bagian
                        dari FotoKita.</em></h2>
            </div>
            <p class="muted text-sm leading-7">Setiap kesan berarti.<br>Bagikan cerita dan foto dari momenmu bersama kami.
            </p>
        </div>

        <div class="reviews-layout">
            <div class="review-community">
                <div class="review-summary" aria-label="Ringkasan seluruh ulasan">
                    <div><span class="review-summary-number"
                            data-count="total">{{ number_format($reviewFeed['summary']['total'], 0, ',', '.') }}</span><span>Total
                            ulasan</span></div>
                    <div><span class="review-summary-number review-positive"
                            data-count="positive">{{ number_format($reviewFeed['summary']['positive'], 0, ',', '.') }}</span><span>Positif</span>
                    </div>
                    <div><span class="review-summary-number review-negative"
                            data-count="negative">{{ number_format($reviewFeed['summary']['negative'], 0, ',', '.') }}</span><span>Negatif</span>
                    </div>
                </div>
                <div class="review-ratio">
                    <progress id="review-positive-meter" max="100"
                        value="{{ $reviewFeed['summary']['positive_percentage'] }}"
                        aria-label="Persentase ulasan positif"></progress>
                    <p id="review-ratio-text">
                        {{ $reviewFeed['summary']['total'] > 0 ? $reviewFeed['summary']['positive_percentage'] . '% ulasan positif' : 'Belum ada penilaian' }}
                    </p>
                </div>
                <p class="review-summary-note">Kategori dipilih langsung oleh pengulas.</p>

                <div class="review-filters" role="group" aria-label="Filter ulasan" hidden>
                    <button type="button" data-review-filter="all" aria-pressed="true">Semua</button>
                    <button type="button" data-review-filter="positive" aria-pressed="false">Positif</button>
                    <button type="button" data-review-filter="negative" aria-pressed="false">Negatif</button>
                </div>
                <p id="review-list-status" class="review-status" role="status" aria-live="polite"></p>

                <div class="review-track" id="review-track" tabindex="0" role="region"
                    aria-roledescription="carousel"
                    aria-label="Ulasan pengunjung. Gunakan tombol panah atau geser untuk membaca.">
                    @foreach ($reviewFeed['data'] as $review)
                        <x-review-card :review="$review" />
                    @endforeach
                </div>
                <div class="review-empty" id="review-empty" @if (count($reviewFeed['data']) > 0) hidden @endif>
                    <svg class="icon !h-9 !w-9" aria-hidden="true">
                        <use href="#i-camera" />
                    </svg>
                    <h3 class="serif text-2xl" id="review-empty-title">Cerita pertamamu berarti.</h3>
                    <p class="muted text-sm leading-7" id="review-empty-description">Belum ada ulasan. Jadilah yang
                        pertama berbagi pengalaman bersama FotoKita.</p>
                    <a href="#review-form" class="review-read-more">Tulis ulasan pertama →</a>
                </div>
                <div class="review-navigation" id="review-navigation" hidden>
                    <span id="review-slide-position" class="text-xs text-muted" aria-live="polite"></span>
                    <div class="flex gap-2">
                        <button type="button" class="review-arrow" id="review-prev" aria-label="Ulasan sebelumnya"
                            aria-controls="review-track"><svg class="icon rotate-180" aria-hidden="true">
                                <use href="#i-arrow" />
                            </svg></button>
                        <button type="button" class="review-arrow" id="review-next" aria-label="Ulasan berikutnya"
                            aria-controls="review-track"><svg class="icon" aria-hidden="true">
                                <use href="#i-arrow" />
                            </svg></button>
                    </div>
                </div>
                <button type="button" id="review-load-more" class="pill pill-outline mt-5 w-full" hidden>Muat ulasan
                    lainnya</button>

                <noscript>
                    <p class="muted mt-5 text-xs leading-6">Geser area kartu untuk membaca ulasan. Aktifkan JavaScript
                        untuk filter dan navigasi tombol.</p>
                    @if ($reviewFeed['meta']['current_page'] > 1)
                        <a class="footer-link"
                            href="{{ route('home', ['reviews_page' => $reviewFeed['meta']['current_page'] - 1]) }}#reviews">←
                            Sebelumnya</a>
                    @endif
                    @if ($reviewFeed['meta']['has_more'])
                        <a class="footer-link"
                            href="{{ route('home', ['reviews_page' => $reviewFeed['meta']['current_page'] + 1]) }}#reviews">Berikutnya
                            →</a>
                    @endif
                </noscript>
            </div>

            <div class="review-form-panel">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="eyebrow text-sand">Your story matters</p>
                        <h3 class="serif mt-3 text-3xl">Bagaimana momenmu?</h3>
                    </div>
                    <span class="review-guest-label">Tanpa login</span>
                </div>
                <p class="muted mt-4 text-xs leading-6">Yang bikin senang, atau yang perlu kami perbaiki. Kami ingin
                    mendengarnya.</p>

                <div id="review-feedback" class="review-feedback" role="status" aria-live="polite" tabindex="-1"
                    @if (!session('review_success') && !$errors->review->any()) hidden @endif>
                    @if (session('review_success'))
                        {{ session('review_success') }}
                    @elseif ($errors->review->any())
                        {{ $errors->review->first() }}
                    @endif
                </div>

                <form id="review-form" action="{{ route('reviews.store') }}" method="POST"
                    enctype="multipart/form-data" class="mt-6">
                    @csrf
                    <input type="hidden" name="submission_id"
                        value="{{ old('submission_id', (string) \Illuminate\Support\Str::uuid()) }}">
                    <div class="review-honeypot" aria-hidden="true"><label>Biarkan kosong<input type="text"
                                name="website" tabindex="-1" autocomplete="off"></label></div>
                    <div class="mb-5">
                        <label for="review-name" class="mb-2 block text-xs">Nama kamu <span
                                class="text-sand">*</span></label>
                        <input id="review-name" name="name" class="form-field" type="text" autocomplete="name"
                            required minlength="2" maxlength="80" value="{{ old('name') }}"
                            placeholder="Nama yang ingin ditampilkan" aria-describedby="review-name-error">
                        <p id="review-name-error" data-review-error="name" class="review-field-error"
                            @if (!$errors->review->has('name')) hidden @endif>{{ $errors->review->first('name') }}</p>
                    </div>
                    <fieldset class="mb-5" aria-describedby="review-sentiment-error">
                        <legend class="mb-3 text-xs">Pengalamanmu secara keseluruhan <span class="text-sand">*</span>
                        </legend>
                        <div class="review-sentiment-options">
                            <label><input type="radio" name="sentiment" value="positive" required
                                    @checked(old('sentiment') === 'positive')><span>♡ &nbsp; Positif</span></label>
                            <label><input type="radio" name="sentiment" value="negative" required
                                    @checked(old('sentiment') === 'negative')><span>↗ &nbsp; Negatif</span></label>
                        </div>
                        <p id="review-sentiment-error" data-review-error="sentiment" class="review-field-error"
                            @if (!$errors->review->has('sentiment')) hidden @endif>{{ $errors->review->first('sentiment') }}</p>
                    </fieldset>
                    <div class="mb-5">
                        <label for="review-body" class="mb-2 block text-xs">Kesan &amp; pesan <span
                                class="text-sand">*</span></label>
                        <textarea id="review-body" name="body" class="form-field resize-y" rows="4" required minlength="10"
                            maxlength="1500" aria-describedby="review-body-hint review-body-error"
                            placeholder="Ceritakan pengalamanmu bersama FotoKita...">{{ old('body') }}</textarea>
                        <div class="mt-2 flex justify-between gap-3 text-[10px] text-muted"><span
                                id="review-body-hint">Minimal 10 karakter.</span><span
                                id="review-char-count">{{ mb_strlen(old('body', '')) }}/1500</span></div>
                        <p id="review-body-error" data-review-error="body" class="review-field-error"
                            @if (!$errors->review->has('body')) hidden @endif>{{ $errors->review->first('body') }}</p>
                    </div>
                    <div class="mb-5">
                        <label for="review-photo" class="mb-2 block text-xs">Lampirkan foto <span
                                class="text-muted">(opsional)</span></label>
                        <div class="review-upload">
                            <svg class="icon !h-6 !w-6" aria-hidden="true">
                                <use href="#i-camera" />
                            </svg>
                            <div class="min-w-0 flex-1"><input id="review-photo" name="photo" type="file"
                                    accept="image/jpeg,image/png,image/webp"
                                    aria-describedby="review-photo-hint review-photo-error">
                                <p id="review-photo-hint" class="mt-2 text-[10px] leading-5 text-muted">1 foto JPG, PNG,
                                    atau WebP · Maks. 3 MB · 6.000 × 6.000 px</p>
                            </div>
                        </div>
                        <div id="review-photo-preview" class="review-upload-preview" hidden><img
                                id="review-preview-image" alt="Pratinjau foto yang akan dilampirkan">
                            <div class="min-w-0">
                                <p id="review-photo-name" class="text-xs break-all"></p><button id="review-remove-photo"
                                    class="review-read-more" type="button">Hapus foto</button>
                            </div>
                        </div>
                        <p id="review-photo-error" data-review-error="photo" class="review-field-error"
                            @if (!$errors->review->has('photo')) hidden @endif>{{ $errors->review->first('photo') }}</p>
                    </div>
                    <button id="review-submit" class="pill w-full" type="submit"><span data-submit-label>Kirim
                            ulasan</span><svg class="icon" aria-hidden="true">
                            <use href="#i-arrow" />
                        </svg></button>
                    <p class="muted mt-4 text-[10px] leading-5">Nama, ulasan, dan foto yang kamu kirim akan tampil publik.
                        Hindari menyertakan informasi pribadi.</p>
                </form>
            </div>
        </div>
        <template id="review-card-template"><x-review-card /></template>
    </section>

    {{-- Anchor kontak tetap tersedia untuk navbar/CTA lama. Bukan form booking. --}}
    <section id="contact" class="shell pb-20" aria-labelledby="contact-title">
        <div class="review-contact-band">
            <div>
                <p class="eyebrow text-sand">Let's make a memory</p>
                <h2 id="contact-title" class="serif mt-3 text-3xl">Punya momen berikutnya?</h2>
                <p class="muted mt-3 text-sm leading-7">Hubungi tim FotoKita untuk paket dan ketersediaan jadwal.</p>
            </div>
            @if (\Illuminate\Support\Facades\Route::has('booking'))
                <x-button :href="route('booking')">Cek Jadwal &amp; Book →</x-button>
            @elseif ($whatsappNumber)
                <x-button :href="'https://wa.me/' . $whatsappNumber" target="_blank" rel="noopener noreferrer">Hubungi FotoKita →</x-button>
            @else
                <p class="muted max-w-xs text-xs leading-6">Tanyakan paket dan jadwal melalui kanal resmi FotoKita.</p>
            @endif
        </div>
        <details id="faq" class="mt-6 border-y border-accent/15 py-4">
            <summary class="flex items-center justify-between gap-4 text-xs">Perlu akun untuk memberikan ulasan?</summary>
            <p class="muted mt-3 text-xs leading-6">Tidak perlu login. Isi nama, pilih pengalaman positif atau negatif,
                lalu ceritakan kesanmu. Kamu juga bisa menyertakan satu foto.</p>
        </details>
    </section>

@endsection
