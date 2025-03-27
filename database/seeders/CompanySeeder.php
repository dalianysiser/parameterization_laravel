<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = new Company();
        $company->name ='Etecsa';
        $company->save();

        $company = new Company();
        $company->name ='BANDEC';
        $company->save();

        $company = new Company();
        $company->name ='SEPSA';
        $company->save();
    }
}
