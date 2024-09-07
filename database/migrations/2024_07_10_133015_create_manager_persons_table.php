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
        Schema::create('manager_persons', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('age')->nullable();
            $table->string('year_of_experience')->nullable();
            $table->string('rate')->default(0);
            $table->string('review')->default(0);
            $table->string('national_id')->nullable();
            $table->string('freelance_license')->nullable();
            $table->string('cv')->nullable();
            $table->string('latest_academic_degree')->nullable();
            $table->string('profile_photo')->nullable();
            $table->foreignId('specialty_id')->nullable()->constrained('specialties','id')->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries','id')->cascadeOnDelete();
            $table->enum('status', ['0', '1'])->default(1);
            $table->enum('heart', ['not_favorite', 'favorite'])->default('not_favorite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manager_persons');
    }
};