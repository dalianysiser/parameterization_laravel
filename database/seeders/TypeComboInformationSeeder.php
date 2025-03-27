<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\DetailTypeInformation;
use App\Models\TypeComboInformation;
use App\Models\TypeInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeComboInformationSeeder extends Seeder
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
            $detailTypeInformation= DetailTypeInformation::where('detail', 'blood_group')->first();
            if($typeInformationB && $detailTypeInformation){
                TypeComboInformation::create([
                    'company_id' => $company->id,
                    'type_information_id' => $typeInformationB->id,
                    'type' => 'o positive',
                    'code' => 'O+',
                    'detail_type_information_id' => $detailTypeInformation->id,
                    'is_active' => true,
                ]);
                TypeComboInformation::create([
                    'company_id' => $company->id,
                    'type_information_id' => $typeInformationB->id,
                    'type' => 'o negative',
                    'code' => 'O-',
                    'detail_type_information_id' => $detailTypeInformation->id,
                    'is_active' => true,
                ]);
            }
            
        }
    }
}
