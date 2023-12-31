<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        //richiama il seeder delle technology
        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            TechnologySeeder::class,
            FieldSeeder::class,
            SponsorshipSeeder::class,
            ReviewSeeder::class,
        ]);
    }
}
