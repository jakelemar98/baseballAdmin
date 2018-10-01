<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePracticeEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practice_events', function (Blueprint $table) {
            $table->increments('id');
	    $table->integer('practice_id')->unsigned();
            $table->foreign('practice_id')->references('practice_id')->on('practices');
            $table->time('event_start');
            $table->time('event_end');
            $table->string('event_name');
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
        Schema::dropIfExists('practice_events');
    }
}
