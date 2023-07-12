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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            
            $table->string('name', 30);
            $table->string('surname', 40);
            $table->date('birth_date');
            $table->string('phone_number', 12)->unique();
            $table->string('email', 30)->unique();
            $table->string('github_url')->unique();
            $table->string('linkedin_url')->unique();
            $table->string('profile_image');
            $table->string('curriculum');
            $table->string('performance');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
