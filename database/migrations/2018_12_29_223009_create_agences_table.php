<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name');
            $table->text('Adresse');
            $table->integer('Effectif');
            $table->integer('user_id')->unsigned();
            $table->integer('region_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('agences', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('agences', function(Blueprint $table) {
            $table->foreign('region_id')->references('id')->on('regions')
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
      Schema::table('agences', function(Blueprint $table) {
            $table->dropForeign('agences_user_id_foreign');
        });
      Schema::table('agences', function(Blueprint $table) {
            $table->dropForeign('agences_region_id_foreign');
        });      
        Schema::dropIfExists('agences');
    }
}
