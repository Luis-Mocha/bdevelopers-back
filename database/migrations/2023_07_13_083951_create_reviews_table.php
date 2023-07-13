<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->tinyInteger('vote');
            $table->text('description');
            $table->string('name');
            $table->string('surname');
            $table->date('date');
            $table->timestamps();

            // Relazione colonna "profile_id" e colonna "id" nella tabella "profiles"
            $table->foreign('profile_id')->references('id')->on('profiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
