<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgeObjTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_obj', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agence_id')->unsigned();
            $table->integer('objectif_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('age_obj', function(Blueprint $table) {
            $table->foreign('agence_id')->references('id')->on('agences')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        Schema::table('age_obj', function(Blueprint $table) {
            $table->foreign('objectif_id')->references('id')->on('objectifs')
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
        Schema::table('age_obj', function(Blueprint $table) {
            $table->dropForeign('age_obj_agence_id_foreign');
        });
        Schema::table('age_obj', function(Blueprint $table) {
            $table->dropForeign('age_obj_objectif_id_foreign');
        });
        Schema::dropIfExists('age_obj');
    }
}
