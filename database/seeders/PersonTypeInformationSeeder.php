<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\DetailTypeInformation;
use App\Models\Person;
use App\Models\PersonTypeInformation;
use App\Models\TypeInformation;
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
        $personName = 'John Doe';

        // Retrieve related models with validations
        $company = Company::where('name', $companyName)->first();
        if (!$company) {
            $this->command->warn("Company with name '$companyName' not found.");
            return;
        }

        $person = Person::where('name', $personName)->first();
        if (!$person) {
            $this->command->warn("Person with name '$personName' not found.");
            return;
        }

        // Retrieve types of information
        $typeInformationC = TypeInformation::where('codTypeInformation', 'COMPANY_PREVIOS_JOB')->first();
        $typeInformationD = TypeInformation::where('codTypeInformation', 'Disability')->first();

        if (!$typeInformationC) {
            $this->command->warn("TypeInformation with code 'COMPANY_PREVIOS_JOB' not found.");
            return;
        }

        // Retrieve details of type information
        $details = [
            'company_name' => DetailTypeInformation::where('detail', 'company_name')->first(),
            'from' => DetailTypeInformation::where('detail', 'from')->first(),
            'until' => DetailTypeInformation::where('detail', 'until')->first(),
            'Type_disability' => DetailTypeInformation::where('detail', 'Type_disability')->first(),
            'ID_card' => DetailTypeInformation::where('detail', 'ID_card')->first(),
            'Date_identification_card' => DetailTypeInformation::where('detail', 'Date_identification_card')->first(),
            '%_disability' => DetailTypeInformation::where('detail', '%_disability')->first(),
        ];

        foreach ($details as $key => $detail) {
            if (!$detail) {
                $this->command->warn("DetailTypeInformation with detail '$key' not found.");
                return;
            }
        }

        // Create PersonTypeInformation data for previous jobs
        $this->createPersonTypeInformation($person, $company, $typeInformationC, $details, 1, 'Alastor', '2020-01-09', '2020-04-09');
        $this->createPersonTypeInformation($person, $company, $typeInformationC, $details, 2, 'Sifizsoft', '2020-05-09', '2020-09-09');

        // Create PersonTypeInformation data for disability, if the corresponding TypeInformation exists
        if ($typeInformationD) {
            PersonTypeInformation::create([
                'person_id' => $person->id,
                'company_id' => $company->id,
                'type_information_id' => $typeInformationD->id,
                'detail_type_information_id' => $details['Type_disability']->id,
                'consecutive' => 1,
                'field_1' => 'Physics',
            ]);
            PersonTypeInformation::create([
                'person_id' => $person->id,
                'company_id' => $company->id,
                'type_information_id' => $typeInformationD->id,
                'detail_type_information_id' => $details['ID_card']->id,
                'consecutive' => 1,
                'field_1' => 'WEEW',
            ]);
            PersonTypeInformation::create([
                'person_id' => $person->id,
                'company_id' => $company->id,
                'type_information_id' => $typeInformationD->id,
                'detail_type_information_id' => $details['Date_identification_card']->id,
                'consecutive' => 1,
                'field_2' => Carbon::parse('2020-09-09')->format('Y-m-d'),
            ]);
            PersonTypeInformation::create([
                'person_id' => $person->id,
                'company_id' => $company->id,
                'type_information_id' => $typeInformationD->id,
                'detail_type_information_id' => $details['%_disability']->id,
                'consecutive' => 1,
                'field_3' => 12,
            ]);
        }
    }

    private function createPersonTypeInformation($person, $company, $typeInformationC, $details, $consecutive, $companyName, $fromDate, $untilDate): void
    {
        PersonTypeInformation::create([
            'person_id' => $person->id,
            'company_id' => $company->id,
            'type_information_id' => $typeInformationC->id,
            'detail_type_information_id' => $details['company_name']->id,
            'consecutive' => $consecutive,
            'field_1' => $companyName,
        ]);

        PersonTypeInformation::create([
            'person_id' => $person->id,
            'company_id' => $company->id,
            'type_information_id' => $typeInformationC->id,
            'detail_type_information_id' => $details['from']->id,
            'consecutive' => $consecutive,
            'field_2' => Carbon::parse($fromDate)->format('Y-m-d'),
        ]);

        PersonTypeInformation::create([
            'person_id' => $person->id,
            'company_id' => $company->id,
            'type_information_id' => $typeInformationC->id,
            'detail_type_information_id' => $details['until']->id,
            'consecutive' => $consecutive,
            'field_2' => Carbon::parse($untilDate)->format('Y-m-d'),
        ]);
    }
}
