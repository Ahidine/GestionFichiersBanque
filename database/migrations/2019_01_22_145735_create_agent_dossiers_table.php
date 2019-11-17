<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_dossiers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dossier_id')->unsigned();
            $table->integer('agent_id')->unsigned();
            $table->date('date_Realisation');
            $table->timestamps();
        });
        Schema::table('agent_dossiers', function(Blueprint $table) {
            $table->foreign('dossier_id')->references('id')->on('dossiers')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('agent_dossiers', function(Blueprint $table) {
            $table->foreign('agent_id')->references('id')->on('agents')
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
        Schema::table('agent_dossiers', function(Blueprint $table) {
            $table->dropForeign('agent_dossiers_dossier_id_foreign');
        });
        Schema::table('agent_dossiers', function(Blueprint $table) {
            $table->dropForeign('agent_dossiers_agent_id_foreign');
        });
        Schema::dropIfExists('agent_dossiers');
    }
}
