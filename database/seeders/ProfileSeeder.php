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
                'name' => 'John',
                'surname' => 'Doe',
                'birth_date' => '1985-09-10',
                'address' => 'Via Roma',
                'phone_number' => '123-456-7890',
                'email' => 'john.doe@example.com',
                'github_url' => 'https://github.com/johndoe',
                'linkedin_url' => 'https://www.linkedin.com/in/johndoe',
                'profile_image' => 'john_doe.jpg',
                'curriculum' => 'john_doe_cv.pdf',
                'performance' => "crypto"
            ],
            [
                'user_id' => '2',
                'name' => 'Jane',
                'surname' => 'Smith',
                'birth_date' => '1990-03-15',
                'address' => 'Via Roma',
                'phone_number' => '987-654-3210',
                'email' => 'jane.smith@example.com',
                'github_url' => 'https://github.com/janesmith',
                'linkedin_url' => 'https://www.linkedin.com/in/janesmith',
                'profile_image' => 'jane_smith.jpg',
                'curriculum' => 'jane_smith_cv.pdf',
                'performance' => "web"
            ],
            [
                'user_id' => '3',
                'name' => 'Robert',
                'surname' => 'Johnson',
                'birth_date' => '1978-12-03',
                'address' => 'Via Roma',
                'phone_number' => '555-123-4567',
                'email' => 'robert.johnson@example.com',
                'github_url' => 'https://github.com/robertjohnson',
                'linkedin_url' => 'https://www.linkedin.com/in/robertjohnson',
                'profile_image' => 'robert_johnson.jpg',
                'curriculum' => 'robert_johnson_cv.pdf',
                'performance' => "gaming"
            ]
        ];


        foreach ($profiles as $elem) {

            $new_profile = new Profile();

            $new_profile->user_id = $elem['user_id'];
            $new_profile->name = $elem['name'];
            $new_profile->surname = $elem['surname'];
            $new_profile->birth_date = $elem['birth_date'];
            $new_profile->address = $elem['address'];
            $new_profile->phone_number = $elem['phone_number'];
            $new_profile->email = $elem['email'];
            $new_profile->github_url = $elem['github_url'];
            $new_profile->linkedin_url = $elem['linkedin_url'];
            $new_profile->profile_image = $elem['profile_image'];
            $new_profile->curriculum = $elem['curriculum'];
            $new_profile->performance = $elem['performance'];


            $new_profile->save();
        }
    }
}
