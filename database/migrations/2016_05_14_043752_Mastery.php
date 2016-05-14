<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Mastery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('masteries', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('summonerId');
            $table->integer('page');
            $table->integer('rank');
            $table->integer('masteryId');
            $table->string('pageName');


            $table->timestamp('updated_runes_at');
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
        Schema::drop('masteries');
    }
}
