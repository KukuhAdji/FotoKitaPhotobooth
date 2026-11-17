@props(['review' => null])

<article class="review-card" role="group" aria-roledescription="slide" data-review-card
    data-review-id="{{ $review['id'] ?? '' }}">
    <header class="review-card-header">
        <span class="review-avatar" data-review-initial aria-hidden="true">{{ $review['initial'] ?? '' }}</span>
        <div class="min-w-0 flex-1">
            <h3 class="review-author" data-review-name>{{ $review['name'] ?? '' }}</h3>
            <p class="review-date"><time data-review-date
                    datetime="{{ $review['created_at'] ?? '' }}">{{ $review['date_label'] ?? '' }}</time> · Ulasan tamu
            </p>
        </div>
        <span class="review-badge" data-review-badge
            data-sentiment="{{ $review['sentiment'] ?? 'positive' }}">{{ $review['sentiment_label'] ?? '' }}</span>
    </header>
    <span class="review-quote" aria-hidden="true">“</span>
    <p class="review-body" data-review-body>{{ $review['body'] ?? '' }}</p>
    <button type="button" class="review-read-more" data-review-expand aria-expanded="false" hidden>Baca
        selengkapnya</button>
    <a class="review-photo-link" data-review-photo-link target="_blank" rel="noopener noreferrer"
        @if (!empty($review['photo_url'])) href="{{ $review['photo_url'] }}" @else hidden @endif
        aria-label="Lihat foto ulasan dari {{ $review['name'] ?? '' }}">
        <img class="review-photo" data-review-photo width="640" height="400" loading="lazy" decoding="async"
            @if (!empty($review['photo_url'])) src="{{ $review['photo_url'] }}" @endif
            alt="Foto yang dilampirkan {{ $review['name'] ?? '' }} pada ulasannya">
    </a>
</article>
