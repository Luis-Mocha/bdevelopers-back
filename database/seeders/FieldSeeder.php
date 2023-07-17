<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// importo il modello
use App\Models\Admin\Field;
//implemento laravel helper
use Illuminate\Support\Str;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fields = ['sviluppo web', 'gaming', 'cyber security', 'app mobile', 'blockchain', 'machine learning', 'CRM'];

        foreach ($fields as $elem) {

            $new_field = new Field();

            $new_field->name = $elem;
            $new_field->slug = Str::slug($new_field->name);

            $new_field->save();
        }
    }
}
