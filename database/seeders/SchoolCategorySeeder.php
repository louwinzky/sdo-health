<?php

namespace Database\Seeders;

use App\Enums\SchoolCategory;
use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing schools to have a category
        // For simplicity, we'll assign based on school name patterns or default to 'other'
        School::whereNull('category')->update(['category' => SchoolCategory::OTHER->value]);

        // You can customize this logic based on your school names
        // Example: School::where('name', 'like', '%Elementary%')->update(['category' => SchoolCategory::ELEMENTARY->value]);
    }
}
