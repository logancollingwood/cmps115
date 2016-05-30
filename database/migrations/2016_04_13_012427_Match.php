<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Match extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Riot GIVES

        /*
            Will hold generic match data
        */
        Schema::create('match', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->string('matchId');
            $table->string('platformId');
            $table->integer('map');
            $table->string('queue');
            $table->string('season');
            $table->string('serverTime');
            $table->integer('length');
            $table->string('patch');
            $table->integer('ranked');
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
        //
        Schema::drop('match');
    
    }
}
