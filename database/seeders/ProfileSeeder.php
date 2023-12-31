<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// importo il modello
use App\Models\Admin\Profile;


class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            [
                'user_id' => '1',
                'name' => 'A',
                'surname' => 'AA',
                'address' => 'Via A',
                'email' => 'a@a.com',
            ],
            [
                'user_id' => '2',
                'name' => 'B',
                'surname' => 'BB',
                'address' => 'Via B',
                'email' => 'b@b.com',
            ],
            [
                'user_id' => '3',
                'name' => 'C',
                'surname' => 'CC',
                'address' => 'Via C',
                'email' => 'c@c.com',
            ],
            [
                'user_id' => '4',
                'name' => 'D',
                'surname' => 'DD',
                'address' => 'Via D',
                'email' => 'd@d.com',
            ]
        ];


        foreach ($profiles as $elem) {

            $new_profile = new Profile();

            $new_profile->user_id = $elem['user_id'];
            $new_profile->name = $elem['name'];
            $new_profile->surname = $elem['surname'];
            $new_profile->address = $elem['address'];
            $new_profile->email = $elem['email'];

            $new_profile->save();
        }
    }
}
