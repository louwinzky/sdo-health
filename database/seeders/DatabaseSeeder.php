<?php

namespace Database\Seeders;

use App\Models\Absence;
use App\Models\HealthExamination;
use App\Models\HealthProgram;
use App\Models\MedicalHistory;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use App\Models\Vaccination;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Core Configuration & Base Data
        $this->call([
            RolePermissionSeeder::class,
            SchoolSeeder::class,
            SchoolCategorySeeder::class, // Ensures all schools have valid categories
        ]);

        $filipinoLastNames = ['Garcia', 'Santos', 'Reyes', 'Cruz', 'Bautista', 'Ocampo', 'Dela Cruz', 'Mendoza', 'Pascual', 'Castillo', 'Villanueva', 'Gonzales', 'Rivera', 'Aquino', 'Santiago'];
        $filipinoFirstNames = ['Jose', 'Maria', 'Juan', 'Angelo', 'Liza', 'Rene', 'Teresa', 'Antonio', 'Cristina', 'Ricardo', 'Elena', 'Roberto', 'Carmen', 'Francisco', 'Pilar'];

        // 2. Create SDO Admin (using updateOrCreate to avoid duplicate errors)
        $admin = User::updateOrCreate(
            ['email' => 'admin@sdo.gov.ph'],
            [
                'name' => 'SDO Admin',
                'password' => Hash::make('password'),
                'role' => 'sdo_admin',
                'is_approved' => true,
                'email_verified_at' => now(),
            ]
        );

        if (! $admin->hasRole('sdo_admin')) {
            $admin->assignRole('sdo_admin');
        }

        // 3. Get all schools created by SchoolSeeder
        $schools = School::all();

        // Inform the console for better tracking
        $this->command->info("Seeding data for {$schools->count()} schools...");

        foreach ($schools as $school) {
            // Create Principal for the school
            $principal = User::factory()->create([
                'name' => 'Principal '.fake()->randomElement($filipinoFirstNames).' '.fake()->randomElement($filipinoLastNames),
                'email' => "principal.{$school->school_id}@sdo.gov.ph",
                'role' => 'principal',
                'school_id' => $school->id,
                'is_approved' => true,
            ]);
            $principal->assignRole('principal');

            // Create Health Coordinator (Nurse) for the school
            $coordinator = User::factory()->create([
                'name' => 'Nurse '.fake()->randomElement($filipinoFirstNames).' '.fake()->randomElement($filipinoLastNames),
                'email' => "nurse.{$school->school_id}@sdo.gov.ph",
                'role' => 'health_coordinator',
                'school_id' => $school->id,
                'is_approved' => true,
            ]);
            $coordinator->assignRole('health_coordinator');

            // 4. Create Students (reduced count to 10 for faster seeding, adjust as needed)
            Student::factory(10)->create([
                'school_id' => $school->id,
                'first_name' => fn () => fake()->randomElement($filipinoFirstNames),
                'last_name' => fn () => fake()->randomElement($filipinoLastNames),
                'guardian_name' => fn () => fake()->randomElement($filipinoFirstNames).' '.fake()->randomElement($filipinoLastNames),
            ])->each(function ($student) use ($coordinator) {

                // Create Medical History
                MedicalHistory::factory()->create([
                    'student_id' => $student->id,
                ]);

                // Add Health Examinations
                HealthExamination::factory(rand(1, 2))->create([
                    'student_id' => $student->id,
                    'examined_by' => $coordinator->id,
                ]);

                // Add Vaccinations
                Vaccination::factory(rand(1, 3))->create([
                    'student_id' => $student->id,
                    'recorded_by' => $coordinator->id,
                    'vaccine_name' => fake()->randomElement(['BCG', 'Hepatitis B', 'DTP', 'Polio', 'MMR', 'COVID-19']),
                    'date_given' => fake()->dateTimeBetween('-2 years', 'now'),
                ]);

                // Add Absences (30% chance)
                if (rand(1, 10) > 7) {
                    Absence::factory(rand(1, 2))->create([
                        'student_id' => $student->id,
                        'recorded_by' => $coordinator->id,
                        'is_health_related' => true,
                        'absence_date' => fake()->dateTimeBetween('-6 months', 'now'),
                    ]);
                }
            });

            // 5. Create Health Programs for the school
            HealthProgram::factory(2)->create([
                'school_id' => $school->id,
                'coordinator_id' => $coordinator->id,
                'status' => fake()->randomElement(['planned', 'ongoing', 'completed']),
                'type' => fake()->randomElement(['screening', 'vaccination', 'education']),
            ]);
        }

        $this->command->info('Database seeding completed successfully for Legazpi SDO Health!');
    }
}
