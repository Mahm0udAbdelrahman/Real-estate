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
        Schema::create('o_t_p_s', function (Blueprint $table) {
            $table->id();
            $table->string('mobile');
            $table->string('code')->nullable();
            $table->string('expire_at')->nullable();
            $table->foreignId('register_person_id')->nullable()->constrained('register_persons','id')->cascadeOnDelete();
            $table->foreignId('register_company_id')->nullable()->constrained('register_companies','id')->cascadeOnDelete();
            $table->foreignId('service_person_id')->nullable()->constrained('service_persons','id')->cascadeOnDelete();
            $table->foreignId('service_company_id')->nullable()->constrained('service_companies','id')->cascadeOnDelete();
            $table->foreignId('manager_person_id')->nullable()->constrained('manager_persons','id')->cascadeOnDelete();
            $table->foreignId('manager_company_id')->nullable()->constrained('manager_companies','id')->cascadeOnDelete();
            $table->foreignId('contractor_id')->nullable()->constrained('contractors','id')->cascadeOnDelete();
            $table->foreignId('contractor_person_id')->nullable()->constrained('contractor_persons','id')->cascadeOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers','id')->cascadeOnDelete();
            $table->foreignId('partner_id')->nullable()->constrained('partners','id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('o_t_p_s');
    }
};