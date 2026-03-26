<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add medications field and make other fields nullable to support older records
        Schema::table('health_examinations', function (Blueprint $table) {
            $table->text('medications')->nullable()->after('others_specify');

            // Supporting fields that might be missing in older records
            $table->string('grade_level')->nullable()->change();
            $table->string('ns_bmi_for_age')->nullable()->change();
            $table->string('ns_height_for_age')->nullable()->change();
            $table->decimal('height_cm', 5, 2)->nullable()->change();
            $table->decimal('weight_kg', 5, 2)->nullable()->change();
        });

        // 2. Migrate data from health_records to health_examinations
        $records = DB::table('health_records')->get();

        foreach ($records as $record) {
            $othersSpecify = [];
            if ($record->medical_conditions) {
                $othersSpecify[] = 'Medical Conditions: '.$record->medical_conditions;
            }
            if ($record->allergies) {
                $othersSpecify[] = 'Allergies: '.$record->allergies;
            }
            if ($record->notes) {
                $othersSpecify[] = 'Notes: '.$record->notes;
            }

            // Map BMI Category
            $nsBmi = match ($record->bmi_category) {
                'Normal' => 'a',
                'Underweight' => 'c',
                'Overweight' => 'd',
                'Obese' => 'e',
                default => 'a', // Default to normal if unknown
            };

            DB::table('health_examinations')->insert([
                'student_id' => $record->student_id,
                'examined_by' => $record->recorded_by,
                'grade_level' => 'Not Recorded',
                'date_of_examination' => $record->record_date,
                'height_cm' => $record->height_cm,
                'weight_kg' => $record->weight_kg,
                'ns_bmi_for_age' => $nsBmi,
                'ns_height_for_age' => 'f', // Default to Normal Height
                'medications' => $record->medications,
                'others_specify' => implode("\n", $othersSpecify) ?: null,
                'created_at' => $record->created_at,
                'updated_at' => $record->updated_at,
            ]);
        }

        // 3. Drop the redundant table
        Schema::dropIfExists('health_records');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Re-creation of health_records table
        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->date('record_date');
            $table->decimal('height_cm', 5, 2)->nullable();
            $table->decimal('weight_kg', 5, 2)->nullable();
            $table->decimal('bmi', 4, 1)->nullable();
            $table->string('bmi_category')->nullable();
            $table->text('medical_conditions')->nullable();
            $table->text('allergies')->nullable();
            $table->text('medications')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('recorded_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Optional: Re-migrate back if needed, but usually down should just restore schema

        Schema::table('health_examinations', function (Blueprint $table) {
            $table->dropColumn('medications');

            // Revert fields back to non-nullable if desired
            $table->string('grade_level')->nullable(false)->change();
            $table->string('ns_bmi_for_age')->nullable(false)->change();
            $table->string('ns_height_for_age')->nullable(false)->change();
            $table->decimal('height_cm', 5, 2)->nullable(false)->change();
            $table->decimal('weight_kg', 5, 2)->nullable(false)->change();
        });
    }
};
