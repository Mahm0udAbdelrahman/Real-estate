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
        Schema::create('register_person_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('register_person_id')->constrained('register_persons','id')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->unique(['register_person_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_person_translations');
    }
};