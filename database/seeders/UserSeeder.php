<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// importo il modello
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [ 
                'name' => 'A',
                'surname' => 'AA',
                'address' => 'Via A',
                'email' => 'a@a.com',
                'password' => '$2y$10$cp8X9FtVMXX4ha0u/WjjIOHuhXlpDMGe2jnqZa8YUdAbg7q7.gzu2'
               
            ],
            [
                'name' => 'B',
                'surname' => 'BB',
                'address' => 'Via B',
                'email' => 'b@b.com',
                'password' => '$2y$10$cp8X9FtVMXX4ha0u/WjjIOHuhXlpDMGe2jnqZa8YUdAbg7q7.gzu2'
            ],
            [
                'name' => 'C',
                'surname' => 'CC',
                'address' => 'Via C',
                'email' => 'c@c.com',
                'password' => '$2y$10$cp8X9FtVMXX4ha0u/WjjIOHuhXlpDMGe2jnqZa8YUdAbg7q7.gzu2'
            ],
            [
                'name' => 'D',
                'surname' => 'DD',
                'address' => 'Via D',
                'email' => 'd@d.com',
                'password' => '$2y$10$cp8X9FtVMXX4ha0u/WjjIOHuhXlpDMGe2jnqZa8YUdAbg7q7.gzu2'
            ]
        ];

        foreach ($users as $elem) {

            $new_user = new User();

            // $new_user->user_id = $elem['user_id'];
            $new_user->name = $elem['name'];
            $new_user->surname = $elem['surname'];
            $new_user->address = $elem['address'];
            $new_user->email = $elem['email'];
            $new_user->password = $elem['password'];


            $new_user->save();
        }
    }
}
