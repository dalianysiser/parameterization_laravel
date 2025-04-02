<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\TypeInformation;
use Illuminate\Database\Seeder;

class TypeInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyName = 'Etecsa';

        // Retrieve the company
        $company = Company::where('name', $companyName)->first();

        if (!$company) {
            $this->command->info("Company '{$companyName}' was not found.");
            return;
        }

        // Define the data to seed
        $typeInformationData = [
            [
                'codTypeInformation' => 'EYE_COLOR',
                'typeInformation' => 'Know the eye color',
                'is_singleRegistry' => true,
                'is_active' => true,
            ],
            [
                'codTypeInformation' => 'BLOOD_TYPE',
                'typeInformation' => 'Know blood type',
                'is_singleRegistry' => true,
                'is_active' => true,
            ],
            [
                'codTypeInformation' => 'COMPANY_PREVIOS_JOB',
                'typeInformation' => 'Companies where you have worked before',
                'is_singleRegistry' => false,
                'is_active' => true,
            ],
            [
                'codTypeInformation' => 'Disability',
                'typeInformation' => 'Disability details',
                'is_singleRegistry' => false,
                'is_active' => true,
            ],
        ];

        // Iterate through the data and create records
        foreach ($typeInformationData as $data) {
            TypeInformation::create(array_merge($data, [
                'company_id' => $company->id, // Attach the company ID
            ]));
        }

        $this->command->info('TypeInformation records have been successfully created.');
    }
}
