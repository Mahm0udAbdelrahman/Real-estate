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
        Schema::create('register_persons', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->enum('gender',['male','female'])->nullable();
            $table->string('age')->nullable();
            $table->string('phone');
            $table->string('image')->default('default.png');
            $table->foreignId('country_id')->nullable()->constrained('countries','id')->cascadeOnDelete();
            $table->enum('status', ['0', '1'])->default(1);
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_persons');
    }
};