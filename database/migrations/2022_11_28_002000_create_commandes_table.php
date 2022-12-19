<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('numeroDeCommande');
            $table->bigInteger('user_id')->unsigned();
            $table -> foreign ('user_id') -> references ('id') -> on ('users');
            $table->bigInteger('expedition_id')->unsigned();
            $table -> foreign ('expedition_id') -> references ('id') -> on ('expeditions');
            $table->bigInteger('paiement_id')->unsigned();
            $table -> foreign ('paiement_id') -> references ('id') -> on ('paiements');
            $table->bigInteger('statut_id')->unsigned();
            $table -> foreign ('statut_id') -> references ('id') -> on ('statuts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
