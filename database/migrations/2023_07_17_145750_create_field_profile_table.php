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
        Schema::create('field_profile', function (Blueprint $table) {
            
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')->references('id')->on('profiles')->cascadeOnDelete();
            //cascade cancella i record in relazione con la tabella

            // Relazione tabella Technologies-pivot
            $table->unsignedBigInteger('field_id');
            $table->foreign('field_id')->references('id')->on('fields')->cascadeOnDelete();

            $table->primary(['profile_id', 'field_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('field_profile');
    }
};
