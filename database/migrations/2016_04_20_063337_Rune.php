<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rune extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('runes', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('summonerId');
            $table->integer('page');
            $table->integer('slot');
            $table->integer('runeId');


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
    }
}
