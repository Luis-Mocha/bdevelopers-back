<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// importo il modello
use App\Models\Admin\Technology;

//implemento laravel helper
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Foreach_;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $techs = [
            [
                'name' => 'JavaScript',
                'type' => 'Language'
            ],
            [
                'name' => 'HTML',
                'type' => 'Other'
            ],
            [
                'name' => 'CSS',
                'type' => 'Other'
            ],
            [
                'name' => 'SCSS',
                'type' => 'Other'
            ],
            [
                'name' => 'PHP',
                'type' => 'Language'
            ],
            [
                'name' => 'Python',
                'type' => 'Language'
            ],
            [
                'name' => 'C++',
                'type' => 'Language'
            ],
            [
                'name' => 'Java',
                'type' => 'Language'
            ],
            [
                'name' => 'Ruby',
                'type' => 'Language'
            ],
            [
                'name' => 'Bash',
                'type' => 'Language'
            ],
            [
                'name' => 'Powershell',
                'type' => 'Language'
            ],
            [
                'name' => 'Solidity',
                'type' => 'Language'
            ],
            [
                'name' => 'C#',
                'type' => 'Language'
            ],
            [
                'name' => 'C',
                'type' => 'Language'
            ],
            [
                'name' => 'Visual Basic',
                'type' => 'Language'
            ],
            [
                'name' => 'Flutter',
                'type' => 'Language'
            ],
            [
                'name' => 'Assembly',
                'type' => 'Language'
            ],
            [
                'name' => 'Go',
                'type' => 'Language'
            ],
            [
                'name' => 'Bootstrap',
                'type' => 'Library'
            ],
            [
                'name' => 'Tailwind',
                'type' => 'Library'
            ],
            [
                'name' => 'JQuery',
                'type' => 'Library'
            ],
            [
                'name' => 'Svelte',
                'type' => 'Framework'
            ],
            [
                'name' => 'Ember',
                'type' => 'Framework'
            ],
            [
                'name' => 'Backbone',
                'type' => 'Framework'
            ],
            [
                'name' => 'React',
                'type' => 'Framework'
            ],
            [
                'name' => 'Angular',
                'type' => 'Framework'
            ],
            [
                'name' => 'Vue',
                'type' => 'Framework'
            ],
            [
                'name' => 'Django',
                'type' => 'Framework'
            ],
            [
                'name' => 'Spring',
                'type' => 'Framework'
            ],
            [
                'name' => 'Flask',
                'type' => 'Framework'
            ],
            [
                'name' => 'NestJs',
                'type' => 'Framework'
            ],
            [
                'name' => '.NET',
                'type' => 'Framework'
            ],
            [
                'name' => 'Symfony',
                'type' => 'Framework'
            ],
            [
                'name' => 'Bulma',
                'type' => 'Library'
            ],
            [
                'name' => 'NodeJS',
                'type' => 'Other'
            ],
        ];

        foreach ($techs as $elem) {

            $new_technology = new Technology();

            $new_technology->name = $elem['name'];
            $new_technology->type = $elem['type'];

            $new_technology->slug = Str::slug($new_technology->name);

            $new_technology->save();
        }
    }
}
