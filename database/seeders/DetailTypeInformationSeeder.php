<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\DetailTypeInformation;
use App\Models\FieldType;
use App\Models\TypeInformation;
use Illuminate\Database\Seeder;

class DetailTypeInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyName = 'Etecsa';

        // Retrieve company
        $company = Company::where('name', $companyName)->first();
        if (!$company) {
            $this->command->info("Company '{$companyName}' was not found.");
            return;
        }

        // Retrieve related models
        $typeInformationB = TypeInformation::where('codTypeInformation', 'BLOOD_TYPE')->first();
        $typeInformationC = TypeInformation::where('codTypeInformation', 'COMPANY_PREVIOS_JOB')->first();
        $typeInformationD = TypeInformation::where('codTypeInformation', 'Disability')->first();

        $fieldTypeV = FieldType::where('name', 'Varchar')->first();
        $fieldTypeD = FieldType::where('name', 'Date')->first();

        // Validate required data
        if (!$fieldTypeV || !$fieldTypeD) {
            $this->command->info("Field types 'Varchar' or 'Date' were not found.");
            return;
        }

        // Create DetailTypeInformation for BLOOD_TYPE
        if ($typeInformationB) {
            $this->createDetailTypeInformation($typeInformationB->id, $company->id, 'blood_group', $fieldTypeV->id, 1, 1);
        } else {
            $this->command->info("TypeInformation 'BLOOD_TYPE' was not found.");
        }

        // Create DetailTypeInformation for COMPANY_PREVIOS_JOB
        if ($typeInformationC) {
            $this->createDetailTypeInformation($typeInformationC->id, $company->id, 'company_name', $fieldTypeV->id, 0, 1);
            $this->createDetailTypeInformation($typeInformationC->id, $company->id, 'from', $fieldTypeD->id, 0, 3);
            $this->createDetailTypeInformation($typeInformationC->id, $company->id, 'until', $fieldTypeD->id, 0, 4);
        } else {
            $this->command->info("TypeInformation 'COMPANY_PREVIOS_JOB' was not found.");
        }

        // Create DetailTypeInformation for Disability
        if ($typeInformationD) {
            $this->createDetailTypeInformation($typeInformationD->id, $company->id, 'Type_disability', $fieldTypeV->id, 1, 5);
            $this->createDetailTypeInformation($typeInformationD->id, $company->id, 'ID_card', $fieldTypeV->id, 0, 6);
            $this->createDetailTypeInformation($typeInformationD->id, $company->id, 'Date_identification_card', $fieldTypeV->id, 0, 7);
            $this->createDetailTypeInformation($typeInformationD->id, $company->id, '%_disability', $fieldTypeV->id, 0, 8);
        } else {
            $this->command->info("TypeInformation 'Disability' was not found.");
        }
    }

    /**
     * Helper method to create DetailTypeInformation
     */
    private function createDetailTypeInformation(
        int $typeInformationId,
        int $companyId,
        string $detail,
        int $fieldTypeId,
        int $comesCombo,
        int $order
    ): void {
        DetailTypeInformation::create([
            'type_information_id' => $typeInformationId,
            'company_id' => $companyId,
            'detail' => $detail,
            'field_type_id' => $fieldTypeId,
            'comesCombo' => $comesCombo,
            'order' => $order,
            'is_active' => true,
        ]);
    }
}
