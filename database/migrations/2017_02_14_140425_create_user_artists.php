<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserArtists extends Migration
{
  public function up()
  {
      Schema::create('user_artists', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id');
          $table->integer('artist_id');
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
      Schema::dropIfExists('user_artists');
  }
}
