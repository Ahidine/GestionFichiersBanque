<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenceDossierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agence_dossier', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dossier_id')->unsigned();
            $table->integer('agence_id')->unsigned();
            $table->timestamps();

         
            });
        Schema::table('agence_dossier', function(Blueprint $table) {
            $table->foreign('dossier_id')->references('id')->on('dossiers')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('agence_dossier', function(Blueprint $table) {
            $table->foreign('agence_id')->references('id')->on('agences')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agence_dossier', function(Blueprint $table) {
            $table->dropForeign('agence_dossier_dossier_id_foreign');
        });
        Schema::table('agence_dossier', function(Blueprint $table) {
            $table->dropForeign('agence_dossier_agence_id_foreign');
        });
        Schema::dropIfExists('agence_dossier');
    }
}
