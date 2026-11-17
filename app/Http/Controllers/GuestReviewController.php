<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuestReviewRequest;
use App\Models\GuestReview;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use RuntimeException;
use Throwable;

class GuestReviewController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $data = $request->validate([
            'sentiment' => ['sometimes', Rule::in(['all', 'positive', 'negative'])],
            'page' => ['sometimes', 'integer', 'min:1', 'max:10000'],
        ]);

        return response()->json(GuestReview::reviewFeed($data['sentiment'] ?? 'all', (int) ($data['page'] ?? 1)));
    }

    public function store(StoreGuestReviewRequest $request): JsonResponse|RedirectResponse
    {
        $data = $request->validated();
        $review = GuestReview::where('submission_id', $data['submission_id'])->first();

        if (!$review) {
            $photoPath = null;
            try {
                if ($request->hasFile('photo')) {
                    $photoPath = $request->file('photo')->store('reviews', 'public');
                    if (!$photoPath) {
                        throw new RuntimeException('Foto ulasan tidak dapat disimpan.');
                    }
                }

                // UUID unik mencegah duplikasi ketika tombol diklik ulang / respons jaringan terputus.
                $review = GuestReview::firstOrCreate(
                    ['submission_id' => $data['submission_id']],
                    ['name' => $data['name'], 'body' => $data['body'], 'sentiment' => $data['sentiment'], 'photo_path' => $photoPath]
                );

                if (!$review->wasRecentlyCreated && $photoPath) {
                    Storage::disk('public')->delete($photoPath);
                }
            } catch (Throwable $exception) {
                if ($photoPath) {
                    Storage::disk('public')->delete($photoPath);
                }
                throw $exception;
            }
        }

        if ($request->expectsJson()) {
            return response()->json([
                ...GuestReview::reviewFeed(),
                'message' => 'Terima kasih! Ulasanmu sudah tersimpan dan tampil untuk semua pengunjung.',
                'next_submission_id' => (string) Str::uuid(),
            ], $review->wasRecentlyCreated ? 201 : 200);
        }

        return redirect()->to(route('home') . '#reviews')
            ->with('review_success', 'Terima kasih! Ulasanmu sudah tersimpan dan ditampilkan.');
    }
}
