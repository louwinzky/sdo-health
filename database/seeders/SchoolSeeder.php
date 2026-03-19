<?php

namespace Database\Seeders;

use App\Enums\SchoolCategory;
use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = [
            ['school_id' => '114457', 'name' => 'Albay CS'],
            ['school_id' => '114485', 'name' => 'Arimbay ES'],
            ['school_id' => '310201', 'name' => 'Arimbay High School'],
            ['school_id' => '502955', 'name' => 'Bagacay Integrated School'],
            ['school_id' => '114486', 'name' => 'Bagong Abre ES'],
            ['school_id' => '114466', 'name' => 'Bagumbayan CS'],
            ['school_id' => '306333', 'name' => 'Bagumbayan-East Washington National High School'],
            ['school_id' => '114467', 'name' => 'Banquerohan ES'],
            ['school_id' => '302257', 'name' => 'Banquerohan Natl High School'],
            ['school_id' => '100182', 'name' => 'Banquerohan Resettlement ES'],
            ['school_id' => '502625', 'name' => 'Bariis Integrated School'],
            ['school_id' => '502954', 'name' => 'Bigaa Integrated School'],
            ['school_id' => '114475', 'name' => 'Bitano ES'],
            ['school_id' => '114458', 'name' => 'Bogna ES'],
            ['school_id' => '502952', 'name' => 'Bogtong Integrated School'],
            ['school_id' => '114469', 'name' => 'Buenavista ES'],
            ['school_id' => '114476', 'name' => 'Buraguis ES'],
            ['school_id' => '114488', 'name' => 'Buyoan ES'],
            ['school_id' => '306332', 'name' => 'Buyoan National High School'],
            ['school_id' => '114477', 'name' => 'Cabagnan ES'],
            ['school_id' => '302260', 'name' => 'Cabangan High School'],
            ['school_id' => '114470', 'name' => 'Cagbacong ES'],
            ['school_id' => '310206', 'name' => 'Cagbacong High School'],
            ['school_id' => '114478', 'name' => 'Dapdap ES'],
            ['school_id' => '114489', 'name' => 'Dita ES'],
            ['school_id' => '176001', 'name' => 'Division SPED Center'],
            ['school_id' => '114471', 'name' => 'Ems Barrio PS'],
            ['school_id' => '502950', 'name' => 'Estanza Integrated School'],
            ['school_id' => '114490', 'name' => 'Gogon CS'],
            ['school_id' => '302262', 'name' => 'Gogon High School'],
            ['school_id' => '114460', 'name' => 'Homapon ES'],
            ['school_id' => '302259', 'name' => 'Homapon High School'],
            ['school_id' => '114479', 'name' => 'Ibalon CS'],
            ['school_id' => '114461', 'name' => 'Imalnod ES'],
            ['school_id' => '114480', 'name' => 'Lamba ES'],
            ['school_id' => '302261', 'name' => 'Legazpi City National HS'],
            ['school_id' => '310202', 'name' => 'Legazpi City Science High School'],
            ['school_id' => '114481', 'name' => 'Legazpi Port ES'],
            ['school_id' => '114462', 'name' => 'Mabinit ES'],
            ['school_id' => '114463', 'name' => 'Mariawa ES'],
            ['school_id' => '114482', 'name' => 'Maslog ES'],
            ['school_id' => '310205', 'name' => 'Maslog High School'],
            ['school_id' => '114491', 'name' => 'Matanag ES'],
            ['school_id' => '302258', 'name' => 'Oro Site High School'],
            ['school_id' => '114492', 'name' => 'Padang ES'],
            ['school_id' => '114464', 'name' => 'Pawa ES'],
            ['school_id' => '302263', 'name' => 'Pawa High School'],
            ['school_id' => '502949', 'name' => 'Puro Integrated School'],
            ['school_id' => '502951', 'name' => 'Rawis Integrated School'],
            ['school_id' => '502624', 'name' => 'San Francisco Integrated School'],
            ['school_id' => '114494', 'name' => 'San Joaquin ES'],
            ['school_id' => '114495', 'name' => 'San Roque ES'],
            ['school_id' => '310203', 'name' => 'SPED Center'],
            ['school_id' => '176003', 'name' => 'SPED Center-Banquerohan Extn.'],
            ['school_id' => '114496', 'name' => 'Tamaoyan ES'],
            ['school_id' => '114474', 'name' => 'Taysan ES'],
            ['school_id' => '500169', 'name' => 'Taysan Resettlement IS'],
            ['school_id' => '114484', 'name' => 'Victory Village ES'],
        ];

        foreach ($schools as $school) {
            $name = strtoupper($school['name']);
            $category = SchoolCategory::ELEMENTARY;

            if (str_contains($name, 'HIGH SCHOOL') || str_contains($name, 'NATIONAL HS') || str_contains($name, 'SCIENCE HIGH')) {
                $category = SchoolCategory::JUNIOR_HIGH; // Defaulting HS to JHS or could be SHS
            } elseif (str_contains($name, 'INTEGRATED')) {
                $category = SchoolCategory::OTHER; // Or define an Integrated category if needed
            }

            School::updateOrCreate(
                ['school_id' => $school['school_id']],
                [
                    'name' => $school['name'],
                    'address' => 'Legazpi City, Albay',
                    'category' => $category,
                    'is_active' => true,
                ]
            );
        }
    }
}
