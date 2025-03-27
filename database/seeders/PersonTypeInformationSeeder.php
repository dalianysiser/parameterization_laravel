<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\DetailTypeInformation;
use App\Models\Person;
use App\Models\PersonTypeInformation;
use App\Models\TypeInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PersonTypeInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyName = 'Etecsa';
        $company = Company::where('name', $companyName)->first();
        $person = Person::where('name', 'John Doe')->first();
        $typeInformationC= TypeInformation::where('codTypeInformation', 'COMPANY_PREVIOS_JOB')->first();
        $detailTypeInformationCN= DetailTypeInformation::where('detail', 'company_name')->first();
        $detailTypeInformationF= DetailTypeInformation::where('detail', 'from')->first();
        $detailTypeInformationU= DetailTypeInformation::where('detail', 'until')->first();
        if ($company && $person && $typeInformationC && $detailTypeInformationCN) {
            PersonTypeInformation::create([
                'person_id' => $person->id,
                'company_id' => $company->id,
                'type_information_id' => $typeInformationC->id,
                'detail_type_information_id' => $detailTypeInformationCN->id,
                'consecutive' => 1,
                'field_1' => 'Alastor',
            ]);

            PersonTypeInformation::create([
                'person_id' => $person->id,
                'company_id' => $company->id,
                'type_information_id' => $typeInformationC->id,
                'detail_type_information_id' => $detailTypeInformationF->id,
                'consecutive' => 1,
                'field_2' => Carbon::parse('2020-01-09')->format('Y-m-d'),
            ]);
          
            PersonTypeInformation::create([
                'person_id' => $person->id,
                'company_id' => $company->id,
                'type_information_id' => $typeInformationC->id,
                'detail_type_information_id' => $detailTypeInformationU->id,
                'consecutive' => 1,
                'field_2' => Carbon::parse('2020-04-09')->format('Y-m-d'),
            ]);

          PersonTypeInformation::create([
                'person_id' => $person->id,
                'company_id' => $company->id,
                'type_information_id' => $typeInformationC->id,
                'detail_type_information_id' => $detailTypeInformationCN->id,
                'consecutive' => 2,
                'field_1' => 'Sifizsoft',
            ]);

            PersonTypeInformation::create([
                'person_id' => $person->id,
                'company_id' => $company->id,
                'type_information_id' => $typeInformationC->id,
                'detail_type_information_id' => $detailTypeInformationF->id,
                'consecutive' => 2,
                'field_2' => Carbon::parse('2020-05-09')->format('Y-m-d'),
            ]);
          
            PersonTypeInformation::create([
                'person_id' => $person->id,
                'company_id' => $company->id,
                'type_information_id' => $typeInformationC->id,
                'detail_type_information_id' => $detailTypeInformationU->id,
                'consecutive' => 2,
                'field_2' => Carbon::parse('2020-09-09')->format('Y-m-d'),
            ]);

            
        }
    }
}
