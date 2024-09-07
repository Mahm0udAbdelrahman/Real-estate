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
        Schema::create('register_company_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('register_company_id')->constrained('register_companies','id')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('company_name')->nullable();
            $table->text('bio')->nullable();
            $table->unique(['register_company_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_company_translations');
    }
};