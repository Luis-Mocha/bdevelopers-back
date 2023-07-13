<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// importo il modello
use App\Models\Admin\Sponsorship;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorships = [
            [
                'name' => 'base',
                'price' => 2.99,
                'duration' => '24H'
            ],
            [
                'name' => 'medium',
                'price' => 5.99,
                'duration' => '72H'
            ],
            [
                'name' => 'advanced',
                'price' => 9.99,
                'duration' => '144H'
            ]
        ];


        foreach ($sponsorships as $elem) {

            $new_sponsorship = new Sponsorship();

            $new_sponsorship->name = $elem['name'];
            $new_sponsorship->price = $elem['price'];
            $new_sponsorship->duration = $elem['duration'];

            $new_sponsorship->save();
        }
    }
}
