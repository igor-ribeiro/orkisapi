<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrchidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orchids', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hash')->unique();
            $table->string('name')->nullable();
            $table->string('scientific_name')->nullable();
            $table->string('image');
            $table->string('origin');
            $table->longText('description');
            $table->longText('instructions');
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
        Schema::drop('orchids');
    }
}
