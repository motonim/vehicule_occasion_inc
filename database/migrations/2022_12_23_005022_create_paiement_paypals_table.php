<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementPaypalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement_paypals', function (Blueprint $table) {
            $table->id();
            $table->string('paiement_id');
            $table->string('payeur_id');
            $table->string('payeur_courriel');
            $table->float('prix', 10, 2);
            $table->string('monnaie');
            $table->string('paiement_statut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiement_paypals');
    }
}
