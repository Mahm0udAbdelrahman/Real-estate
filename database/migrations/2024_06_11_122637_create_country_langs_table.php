<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('country_langs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries','id')->cascadeOnDelete();
            $table->foreignId('language_id')->constrained('languages','id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country__langs');
    }
};