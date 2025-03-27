<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //pasword =bcrypt('123456)
        $this->call([
            // UserSeeder::class,
            CompanySeeder::class,
            FieldTypeSeeder::class,
            PersonSeeder::class,
            TypeInformationSeeder::class,
            DetailTypeInformationSeeder::class,
            TypeComboInformationSeeder::class,
            PersonTypeInformationSeeder::class,
        ]);
        // User::factory(10)->create();
        
    }
}
