<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Supervisor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisors', function(Blueprint $table)
        {
            $table->increments('sid', true);
            $table->string('phone_no');
            $table->timestamps();
            $table->integer('spbu_id')->unsigned()->nullable();
        });
        Schema::table('users', function($table) {
            $table->foreign('sid')->references('sid')->on('supervisors');
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
