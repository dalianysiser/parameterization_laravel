<?php

namespace Database\Seeders;

use App\Models\FieldType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fielType = new FieldType();
        $fielType->name ='Varchar';
        $fielType->save();

        $fielType = new FieldType();
        $fielType->name ='Date';
        $fielType->save();

        $fielType = new FieldType();
        $fielType->name ='Int';
        $fielType->save();

        $fielType = new FieldType();
        $fielType->name ='Decimal';
        $fielType->save();

        $fielType = new FieldType();
        $fielType->name ='Check';
        $fielType->save();

    }
}
