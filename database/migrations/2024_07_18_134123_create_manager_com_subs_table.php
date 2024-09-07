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
        Schema::create('manager_com_subs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manager_company_id')->constrained('manager_companies')->cascadeOnDelete();
            $table->foreignId('subspecialty_id')->constrained('subspecialties')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manager_com_subs');
    }
};