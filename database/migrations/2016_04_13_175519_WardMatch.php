<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WardMatch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('wardmatch', function(Blueprint $table)
        {
            $table->integer('id', true);
            
            $table->integer('matchid');
            $table->integer('summonerId');
            $table->integer('timestamp');

            $table->integer('x');
            $table->integer('y');

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
        Schema::drop('wardmatch');
    }
}
