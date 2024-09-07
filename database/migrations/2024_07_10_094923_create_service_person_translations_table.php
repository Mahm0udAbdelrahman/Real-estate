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
        Schema::create('service_person_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_person_id')->constrained('service_persons','id')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('full_name')->nullable();
            $table->string('academic_degree')->nullable();
            $table->unique(['service_person_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_person_translations');
    }
};