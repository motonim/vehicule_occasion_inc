<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voitures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('annee');
            $table->string('couleur', 20);
            $table->string('couleur_en', 20);
            $table->integer('km');
            $table->integer('prixAchat');
            $table->string('imagePrincipale', 100);
            $table->bigInteger('transmission_id')->unsigned();
            $table -> foreign ('transmission_id') -> references ('id') -> on ('transmissions');
            $table->bigInteger('carrosserie_id')->unsigned();
            $table -> foreign ('carrosserie_id') -> references ('id') -> on ('carrosseries');
            $table->bigInteger('traction_id')->unsigned();
            $table -> foreign ('traction_id') -> references ('id') -> on ('tractions');
            $table->bigInteger('carburant_id')->unsigned();
            $table -> foreign ('carburant_id') -> references ('id') -> on ('carburants');
            $table->bigInteger('commande_id')->unsigned();
            $table -> foreign ('commande_id') -> references ('id') -> on ('commandes')->nullable()->constrained()->onDelete('set null');
            $table->bigInteger('modele_id')->unsigned();
            $table -> foreign ('modele_id') -> references ('id') -> on ('modeles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voitures');
    }
}
