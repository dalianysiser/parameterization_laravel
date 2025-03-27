<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\TypeInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyName = 'Etecsa';
        $company = Company::where('name', $companyName)->first();

        if ($company) {
            TypeInformation::create([
                'codTypeInformation' => 'EYE_COLOR',
                'typeInformation' => 'know the eye color',
                'is_singleRegistry' => '1',
                'is_active' => '1',
                'company_id' => $company->id, // ID de la compañía basado en el nombre
            ]);
            TypeInformation::create([
                'codTypeInformation' => 'BLOOD_TYPE',
                'typeInformation' => 'know blood type',
                'is_singleRegistry' => '1',
                'is_active' => '1',
                'company_id' => $company->id, // ID de la compañía basado en el nombre
            ]);
            TypeInformation::create([
                'codTypeInformation' => 'COMPANY_PREVIOS_JOB',
                'typeInformation' => 'companies where you have worked before',
                'is_singleRegistry' => '0',
                'is_active' => '1',
                'company_id' => $company->id, // ID de la compañía basado en el nombre
            ]);
            TypeInformation::create([
                'codTypeInformation' => 'Disability',
                'typeInformation' => 'Disability Details',
                'is_singleRegistry' => '0',
                'is_active' => '1',
                'company_id' => $company->id, // ID de la compañía basado en el nombre
            ]);

        } else {
           
            $this->command->info("Company '{$companyName}' was not found.");
        }
    }
}

