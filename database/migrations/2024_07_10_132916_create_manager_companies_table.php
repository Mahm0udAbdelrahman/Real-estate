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
        Schema::create('manager_companies', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('location')->nullable();
            $table->string('number_of_employees')->nullable();
            $table->string('number_of_branches')->nullable();
            $table->string('year_of_experience')->nullable();
            $table->string('rate')->default(0);
            $table->string('review')->default(0);
            $table->string('commercial_registration_certificate')->nullable();
            $table->string('vat_certificate')->nullable();
            $table->string('social_insurance_certificate')->nullable();
            $table->string('chamber_of_commerce_certificate')->nullable();
            $table->string('company_profile')->nullable();
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
        Schema::dropIfExists('manager_companies');
    }
};