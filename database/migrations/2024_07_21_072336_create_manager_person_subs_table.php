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
        Schema::create('manager_person_subs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manager_person_id')->constrained('manager_persons','id')->cascadeOnDelete();
            $table->foreignId('subspecialty_id')->constrained('subspecialties','id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manager_person_subs');
    }
};