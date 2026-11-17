<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGuestReviewRequest extends FormRequest
{
    protected $errorBag = 'review';

    public function authorize(): bool
    {
        return true; // Ulasan tamu: tidak membutuhkan login.
    }

    protected function prepareForValidation(): void
    {
        foreach (['name', 'body'] as $field) {
            if (is_string($this->input($field))) {
                $this->merge([$field => trim($this->input($field))]);
            }
        }
    }

    public function rules(): array
    {
        return [
            'submission_id' => ['required', 'uuid'],
            'name' => ['required', 'string', 'min:2', 'max:80'],
            'body' => ['required', 'string', 'min:10', 'max:1500'],
            'sentiment' => ['required', Rule::in(['positive', 'negative'])],
            // Validasi isi/MIME file. SVG, GIF, dan file executable tidak diterima.
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072', 'dimensions:max_width=6000,max_height=6000'],
            'website' => ['prohibited'], // Honeypot: pengunjung manusia membiarkan kosong.
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tuliskan nama kamu.',
            'name.string' => 'Nama harus berupa teks.',
            'name.min' => 'Nama minimal 2 karakter.',
            'name.max' => 'Nama maksimal 80 karakter.',
            'body.required' => 'Tuliskan kesan dan pesanmu.',
            'body.string' => 'Ulasan harus berupa teks.',
            'body.min' => 'Ulasan minimal 10 karakter.',
            'body.max' => 'Ulasan maksimal 1.500 karakter.',
            'sentiment.required' => 'Pilih pengalaman positif atau negatif.',
            'sentiment.in' => 'Pilihan pengalaman tidak valid.',
            'photo.image' => 'Lampiran harus berupa gambar.',
            'photo.mimes' => 'Gunakan foto JPG, PNG, atau WebP.',
            'photo.max' => 'Ukuran foto maksimal 3 MB.',
            'photo.dimensions' => 'Dimensi foto maksimal 6.000 × 6.000 piksel.',
            'photo.uploaded' => 'Foto gagal diunggah. Pilih ulang foto yang berukuran maksimal 3 MB.',
            'submission_id.required' => 'Muat ulang halaman sebelum mengirim ulasan.',
            'submission_id.uuid' => 'Muat ulang halaman sebelum mengirim ulasan.',
            'website.prohibited' => 'Permintaan tidak dapat diproses.',
        ];
    }

    protected function getRedirectUrl(): string
    {
        return route('home') . '#review-form';
    }
}
