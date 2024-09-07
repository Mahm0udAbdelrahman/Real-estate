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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('image')->default('default.png');
            $table->string('membership_no')->nullable();
            $table->string('location')->nullable();
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('year_of_experience')->nullable();
            $table->string('supplied_material')->nullable();
            $table->string('rate')->default(0);
            $table->string('review')->default(0);
            $table->enum('status',['0','1'])->default(1);
            $table->foreignId('country_id')->nullable()->constrained('countries','id')->cascadeOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities','id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
