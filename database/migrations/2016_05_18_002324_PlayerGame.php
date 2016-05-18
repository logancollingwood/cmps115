<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlayerGame extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('playergame', function(Blueprint $table)
        {
            $table->integer('id', true);

            // Identifiers
            $table->integer('summonerId');
            $table->string('gameId');
            $table->string('gameMode');
            $table->string('gameType');
            $table->string('subType');
            $table->integer('map');

            $table->integer('championId');
            $table->integer('spell1');
            $table->integer('spell2');
            $table->integer('summonerLevel');
            $table->integer('ipEarned');
            $table->integer('championLevel');
            $table->integer('largestMultiKill');
            $table->integer('largestKillingSpree');
            $table->integer('killingSprees');
            $table->integer('minionsKilled');
            $table->integer('largestCrit');

            $table->integer('team'); // BINARY 0 meaning team 1 or 1 meaning team 2
            $table->integer('won'); // binary 0 meaning loss 1 meaning win

            $table->integer('wardsPlaced');
            $table->integer('wardsKilled');
            $table->integer('firstBlood');
            $table->integer('goldEarned');

            $table->integer('kills');
            $table->integer('deaths');
            $table->integer('assists');

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
        Schema::drop('playergame');

    }
}
