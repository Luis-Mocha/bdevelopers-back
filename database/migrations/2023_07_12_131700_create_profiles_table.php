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
            $table->unsignedBigInteger('user_id')->nullable(); // chiave esterna tabella Users
            $table->string('name', 30)->nullable();
            $table->string('surname', 40)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('phone_number', 12)->nullable()->unique();
            $table->string('email', 30)->nullable()->unique();
            $table->string('github_url')->nullable()->unique();
            $table->string('linkedin_url')->nullable()->unique();
            $table->string('profile_image')->nullable();
            $table->string('curriculum')->nullable();
            $table->string('performance')->nullable();
            $table->timestamps();

            // Relazione colonna "user_id" e colonna "id" nella tabella "users"
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
