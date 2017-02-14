<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->increments('track_id');
            $table->integer('disc_number');
            $table->integer('duration_ms');
            $table->boolean('explicit');
            $table->string('href');
            $table->string('id');
            $table->boolean('is_playable')->default(false);
            $table->string('name');
            $table->string('preview_url');
            $table->integer('track_number');
            $table->string('type')->default('track');
            $table->string('uri');
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
        Schema::dropIfExists('tracks');
    }
}
