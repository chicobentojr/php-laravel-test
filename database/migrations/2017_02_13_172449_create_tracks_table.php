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
            //$table->hasMany('App\Artist');
            $table->json('available_markets');
            $table->integer('disc_number');
            $table->integer('duration_ms');
            $table->boolean('explicit');
            //$table->hasOne('App\ExternalURL');
            $table->integer('external_url_id');
            $table->string('href');
            $table->integer('id');
            $table->boolean('is_playable');
            $table->string('name');
            $table->string('preview_url');
            $table->integer('track_number');
            $table->string('type')->default('track');
            $table->string('uri');
            $table->timestamps();

            $table->foreign('external_url_id')
                  ->references('id')->on('external_u_r_ls')
                  ->onDelete('cascade');
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
