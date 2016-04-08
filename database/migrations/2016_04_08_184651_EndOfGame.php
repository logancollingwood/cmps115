<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EndOfGame extends Migration
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
            riotmatchid (int (big?))
            winner (int) // not sure how to do this given the api
            matchTime (Timestamp)
            createdAt (timestamp)
            updatedAt (timestamp)
        */

        Schema::create('endofgame', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('riotmatchid');
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
        Schema::drop('endofgame');
    }
}
