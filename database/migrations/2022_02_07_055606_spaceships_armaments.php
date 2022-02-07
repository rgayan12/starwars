<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpaceshipsArmaments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spaceships_armaments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('spaceship_id');
            $table->unsignedInteger('armament_id');
            $table->unsignedInteger('qty');
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
