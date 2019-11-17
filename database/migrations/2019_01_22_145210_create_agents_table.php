<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('agence_id')->unsigned();
            $table->timestamps();
        });
         Schema::table('agents', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
         Schema::table('agents', function(Blueprint $table) {
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
        Schema::table('agents', function(Blueprint $table) {
            $table->dropForeign('agents_user_id_foreign');
        });
        Schema::table('agents', function(Blueprint $table) {
            $table->dropForeign('agents_agence_id_foreign');
        });
        Schema::dropIfExists('agents');
    }
}
