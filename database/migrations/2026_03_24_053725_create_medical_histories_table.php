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
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');

            // 1. Allergies
            $table->boolean('has_allergies')->default(false);
            $table->json('allergy_types')->nullable(); // Stores ['medicine', 'food']
            $table->string('allergy_others')->nullable();

            // 2. Ongoing Medical Conditions
            $table->boolean('has_medical_conditions')->default(false);
            $table->json('condition_types')->nullable(); // Stores ['asthma', 'seizure']
            $table->string('condition_others')->nullable();

            // 3. Surgery / Hospitalization
            $table->boolean('has_past_surgery')->default(false);
            $table->text('surgery_details')->nullable();

            // 4. Family History
            $table->json('family_history')->nullable(); // Stores ['hypertension', 'diabetes']
            $table->string('cancer_type')->nullable();
            $table->string('family_history_other')->nullable();

            // 5. & 6. Lifestyle & Physical
            $table->boolean('smoke_exposure')->default(false);
            $table->enum('dominant_hand', ['right', 'left', 'both'])->default('right');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_histories');
    }
};
