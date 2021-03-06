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
        // Riot GIVES

        /*
            {  
                "region":"NA",
                "platformId":"NA1",
                "matchId":2078969667,
                "champion":236,
                "queue":"RANKED_SOLO_5x5",
                "season":"SEASON2016",
                "timestamp":1453748452012,
                "lane":"BOTTOM",
                "role":"DUO_CARRY"
            },
        */
        Schema::create('playermatch', function(Blueprint $table)
        {
            $table->integer('id', true);

            // Identifiers
            $table->integer('summonerId');
            $table->string('platformId');
            
            $table->string('matchId');

            $table->integer('profileIcon');
            $table->string('summonerName');
            $table->integer('champion');

            $table->string('queue');
            $table->string('season');
            $table->string('lane');
            $table->string('role');

            $table->integer('team'); // BINARY 0 meaning team 1 or 1 meaning team 2
            $table->integer('won'); // binary 0 meaning loss 1 meaning win
            $table->integer('kills');
            $table->integer('deaths');
            $table->integer('assists');
            $table->integer('wards_placed');
            $table->integer('wards_killed');
            $table->integer('first_blood');

            $table->integer('serverTime');
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
        Schema::drop('playermatch');
    }
}
