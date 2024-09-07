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
        Schema::create('other_projects', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->default('default.png');
            $table->string('image')->default('default.png');
            $table->string('date')->nullable();
            $table->string('rate')->default(0);
            $table->enum('status', ['0', '1'])->default(1);
            $table->enum('heart', ['not_favorite', 'favorite'])->default('not_favorite');
            $table->foreignId('partner_id')->nullable()->constrained('partners','id')->cascadeOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers','id')->cascadeOnDelete();
            $table->foreignId('contractor_id')->nullable()->constrained('contractors','id')->cascadeOnDelete();
            $table->foreignId('contractor_person_id')->nullable()->constrained('contractor_persons','id')->cascadeOnDelete();
            $table->foreignId('rent_material_id')->nullable()->constrained('rent_materials','id')->cascadeOnDelete();
            $table->foreignId('manager_company_id')->nullable()->constrained('manager_companies','id')->cascadeOnDelete();
            $table->foreignId('manager_person_id')->nullable()->constrained('manager_persons','id')->cascadeOnDelete();
            $table->foreignId('service_company_id')->nullable()->constrained('service_companies','id')->cascadeOnDelete();
            $table->foreignId('service_person_id')->nullable()->constrained('service_companies','id')->cascadeOnDelete();
             $table->foreignId('register_company_id')->nullable()->constrained('register_companies','id')->cascadeOnDelete();
            $table->foreignId('register_person_id')->nullable()->constrained('register_persons','id')->cascadeOnDelete();
           
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_projects');
    }
};
