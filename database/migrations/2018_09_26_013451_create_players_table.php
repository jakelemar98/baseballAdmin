<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('players', function (Blueprint $table) {
             $table->increments('id');
             $table->string('first_name', 25);
             $table->string('last_name', 25);
             $table->integer('position');
             $table->string('elig_year', 10);
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
        Schema::dropIfExists('players');
    }
}
