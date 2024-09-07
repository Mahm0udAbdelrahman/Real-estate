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
        Schema::create('contractor_person_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contractor_person_id')->constrained('contractor_persons','id')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('contractor_person_name')->nullable();
            $table->string('contractor_person_address')->nullable();
            $table->unique(['contractor_person_id', 'locale'], 'contractor_person_id_locale_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contractor_person_translations');
    }
};
