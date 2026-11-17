<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guest_reviews', function (Blueprint $table) {
            $table->id();
            $table->uuid('submission_id')->unique();
            $table->string('name', 80);
            $table->text('body');
            $table->enum('sentiment', ['positive', 'negative']);
            $table->string('photo_path')->nullable();
            $table->timestamps();
            $table->index(['created_at', 'id']);
            $table->index(['sentiment', 'created_at', 'id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guest_reviews');
    }
};
