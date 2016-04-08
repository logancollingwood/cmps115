<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlayerMatch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
            id (int)
            playerid (int, FK)
            matchid (int, FK)
            farm (int) 
            kills (int)
            deaths (int)
            assists (int)
            summonerOne (int -- id into first summoner spell)
            summonerTwo (int -- id into second summoner spell)
            yellowWardCount (int)
            pinkWardCount (int)
            largestCrit (int)
            largestMultiKill (int)

        */
        Schema::create('playerMatch', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('kills');
            $table->integer('deaths');
            $table->integer('assists');
            $table->integer('minionKills');
            $table->integer('neutralMinionKills');
            $table->integer('turretsDestroyed');
            $table->integer('currentLeague');
            $table->integer('lastLeague');

            $table->integer('winner');
            $table->timestamp('matchLength');
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
        Schema::drop('playerMatch');
    }
}
