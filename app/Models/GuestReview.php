<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GuestReview extends Model
{
    protected $fillable = ['submission_id', 'name', 'body', 'sentiment', 'photo_path'];

    // Hanya field publik ini yang dikirim ke browser. Tidak ada akun/email/IP yang disimpan.
    public function toPublicArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'initial' => Str::upper(Str::substr($this->name, 0, 1)),
            'body' => $this->body,
            'sentiment' => $this->sentiment,
            'sentiment_label' => $this->sentiment === 'positive' ? 'Positif' : 'Negatif',
            'photo_url' => $this->photo_path ? Storage::disk('public')->url($this->photo_path) : null,
            'created_at' => $this->created_at->toIso8601String(),
            'date_label' => $this->created_at->locale('id')->translatedFormat('d M Y'),
        ];
    }

    public static function reviewSummary(): array
    {
        $row = static::query()->selectRaw(
            "COUNT(*) AS total, COALESCE(SUM(CASE WHEN sentiment = 'positive' THEN 1 ELSE 0 END), 0) AS positive, COALESCE(SUM(CASE WHEN sentiment = 'negative' THEN 1 ELSE 0 END), 0) AS negative"
        )->first();

        $total = (int) $row->total;
        $positive = (int) $row->positive;

        return [
            'total' => $total,
            'positive' => $positive,
            'negative' => (int) $row->negative,
            'positive_percentage' => $total > 0 ? (int) round($positive / $total * 100) : 0,
        ];
    }

    public static function reviewFeed(string $sentiment = 'all', int $page = 1): array
    {
        $reviews = static::query()
            ->when(in_array($sentiment, ['positive', 'negative'], true), fn ($query) => $query->where('sentiment', $sentiment))
            ->orderByDesc('created_at')->orderByDesc('id')
            ->paginate(6, ['*'], 'page', max(1, $page));

        return [
            'data' => $reviews->getCollection()->map(fn (self $review) => $review->toPublicArray())->values()->all(),
            // Summary selalu menghitung seluruh tabel, bukan hanya enam kartu/hasil filter.
            'summary' => static::reviewSummary(),
            'meta' => [
                'current_page' => $reviews->currentPage(),
                'last_page' => $reviews->lastPage(),
                'has_more' => $reviews->hasMorePages(),
                'total' => $reviews->total(),
            ],
        ];
    }
}
