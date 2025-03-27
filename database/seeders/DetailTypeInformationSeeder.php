<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\DetailTypeInformation;
use App\Models\FieldType;
use App\Models\TypeInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailTypeInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyName = 'Etecsa';
        $company = Company::where('name', $companyName)->first();

        if ($company) {
            $typeInformationB= TypeInformation::where('codTypeInformation', 'BLOOD_TYPE')->first();
            $fieldTypeV= FieldType::where('name', 'Varchar')->first();
            $fieldTypeD= FieldType::where('name', 'Date')->first();
            if($typeInformationB && $fieldTypeV){
                DetailTypeInformation::create([
                    'type_information_id' => $typeInformationB->id,
                    'company_id' => $company->id,
                    'detail' => 'blood_group',
                    'field_type_id' => $fieldTypeV->id,
                    'comesCombo' => 1,
                    'order' => 1,
                    'is_active' => true,
                ]);
            }
            $typeInformationC= TypeInformation::where('codTypeInformation', 'COMPANY_PREVIOS_JOB')->first();
            
            if($typeInformationC && $fieldTypeV){
                DetailTypeInformation::create([
                    'type_information_id' => $typeInformationC->id,
                    'company_id' => $company->id,
                    'detail' => 'company_name',
                    'field_type_id' => $fieldTypeV->id,
                    'comesCombo' => 0,
                    'order' => 1,
                    'is_active' => true,
                ]);
                if($fieldTypeD){
                    DetailTypeInformation::create([
                        'type_information_id' => $typeInformationC->id,
                        'company_id' => $company->id,
                        'detail' => 'from',
                        'field_type_id' => $fieldTypeD->id,
                        'comesCombo' => 0,
                        'order' => 3,
                        'is_active' => true,
                    ]);
                    DetailTypeInformation::create([
                        'type_information_id' => $typeInformationC->id,
                        'company_id' => $company->id,
                        'detail' => 'until',
                        'field_type_id' => $fieldTypeD->id,
                        'comesCombo' => 0,
                        'order' => 4,
                        'is_active' => true,
                    ]);
                    $typeInformationD= TypeInformation::where('codTypeInformation', 'Disability')->first();
                    if($typeInformationD){//seguir creando seeder con el excel
                        DetailTypeInformation::create([
                            'type_information_id' => $typeInformationD->id,
                            'company_id' => $company->id,
                            'detail' => 'Type_disability',
                            'field_type_id' => $fieldTypeV->id,
                            'comesCombo' => 1,
                            'order' => 5,
                            'is_active' => true,
                        ]);
                    }
                    

                }
                
            }

        }else {
           
            $this->command->info("Company '{$companyName}' was not found.");
        }
    }
}
