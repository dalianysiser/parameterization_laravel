<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyName = 'Etecsa';
        $company = Company::where('name', $companyName)->first();

        if ($company) {
            Person::create([
                'name' => 'John Doe',
                'company_id' => $company->id,
            ]);
            Person::create([
                'name' => 'Elena Doe',
                'company_id' => $company->id,
            ]);
        }
    }
}
