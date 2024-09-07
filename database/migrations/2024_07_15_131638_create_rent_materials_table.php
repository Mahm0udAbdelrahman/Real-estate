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
        Schema::create('rent_materials', function (Blueprint $table) {
            $table->id();
            $table->string('price');
            $table->string('logo')->default('default.png');
            $table->string('image')->default('default.png');
            $table->string('rate')->default(0);
            $table->string('review')->default(0);
            $table->enum('status',['0','1']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_materials');
    }
};
