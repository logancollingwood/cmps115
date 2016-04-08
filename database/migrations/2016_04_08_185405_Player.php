<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Player extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
            id (int, Primary)
            summonerId (int)
            kills (int)
            death (int)
            assist (int)
            minionKills (int)
            neutralMinionKills (int)
            turretsDestroyed (int)
            currentLeague (int)
            lastLeague(int)
        */
        Schema::create('player', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('summonerId');
            $table->string('summonerName');
            $table->string('region');
            $table->integer('kills');
            $table->integer('deaths');
            $table->integer('assists');
            $table->integer('minionKills');
            $table->integer('neutralMinionKills');
            $table->integer('turretsDestroyed');
            $table->integer('currentLeague');
            $table->integer('lastLeague');
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
        Schema::drop('player');
    }
}
