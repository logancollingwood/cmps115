<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Champions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
                Schema::create('champions', function(Blueprint $table)
        {
            $table->integer('id', true);
            $table->integer('championId');
            $table->string('title');
            $table->string('name');
            $table->string('key');
            $table->string('image');
            $table->string('splash');
            $table->timestamp('updated_matches_at');
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
        Schema::drop('champions');
    }
}
