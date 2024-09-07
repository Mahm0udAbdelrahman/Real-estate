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
        Schema::create('manager_company_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manager_company_id')->constrained('manager_companies','id')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('company_name')->nullable();
            $table->text('bio')->nullable();
            $table->unique(['manager_company_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manager_company_translations');
    }
};