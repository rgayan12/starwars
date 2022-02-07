<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpaceshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spaceships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class');
            $table->unsignedInteger('crew');
            $table->string('image');
            $table->double('value');
            $table->enum('status',['Operational','Damaged']);
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
        Schema::dropIfExists('spaceships');
    }
}
