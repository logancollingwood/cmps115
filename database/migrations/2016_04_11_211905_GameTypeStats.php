<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GameTypeStats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    /* this table organizes stats for a particular summoner in a specific game type
        LIKE aram, unranked5's, 
        in playerStatSummaries 
    */
    public function up()
    {
        //
        Schema::create('gameTypeStats', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('summonerId');
            $table->string('region');

            // AramUnranked5x5 = 0
            // CAP5x5 = 1
            // CoopVsAI = 2
            // OdinUnranked = 3
            // RankedSolo5x5 = 4
            // RankedTeam5x5 = 5
            // Unranked = 6
            // Unranked3v3 = 7

            $table->integer('gameTypeId');
            
            $table->integer('wins');
            $table->integer('totalChampionKills');
            $table->integer('totalMinionKills');
            $table->integer('totalTurretsKilled');
            $table->integer('totalNeutralMinionsKilled');
            $table->integer('totalAssists');
            
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
        Schema::drop('gameTypeStats');
    }
}
