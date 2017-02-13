<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('album_id');
            $table->string('album_type');
            //$table->hasMany('App\Artist');
            $table->json('available_markets');
            $table->integer('external_url_id');
            //$table->hasOne('App\ExternalURL');
            $table->string('href');
            $table->integer('id');
            //$table->hasMany('App\Image');
            $table->string('name');
            $table->string('type')->default('album');
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
        Schema::dropIfExists('albums');
    }
}
