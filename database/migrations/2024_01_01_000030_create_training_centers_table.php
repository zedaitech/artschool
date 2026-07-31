<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('training_centers', function (Blueprint $table) {
            $table->id();
            $table->json('name');                 // Locality, e.g. "Deralakatte"
            $table->string('slug')->unique();
            $table->json('venue')->nullable();    // e.g. "Shree Ayyappa Swamy Temple"
            $table->json('address')->nullable();
            $table->json('notes')->nullable();    // Secondary line, e.g. hall / mandira name
            $table->string('day')->nullable()->index(); // monday … sunday
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('map_url')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_centers');
    }
};
