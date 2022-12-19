<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('nomUsager',45)->unique();
            $table->string('courriel',190)->unique();
            $table->string('password',191);
            $table->string('nom',50);
            $table->string('prenom',50);
            $table->date('dateDeNaissance')->nullable();
            $table->string('adresse',80)->nullable();
            $table->string('codePostal',40)->nullable();
            $table->string('telephone',30)->nullable();
            $table->string('cellulaire',30)->nullable();
            $table->bigInteger('privilege_id')->unsigned();
            $table -> foreign ('privilege_id') -> references ('id') -> on ('privileges');
            $table->bigInteger('ville_id')->unsigned()->nullable();
            $table -> foreign ('ville_id') -> references ('id') -> on ('villes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
