<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->increments('artist_id');
            //$table->hasOne('App\ExternalURL');
            $table->integer('external_url_id');
            $table->string('href');
            $table->string('id');
            $table->string('name');
            $table->string('type')->default('artist');
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
        Schema::dropIfExists('artists');
    }
}
