<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAlbums extends Migration
{
  public function up()
  {
      Schema::create('user_albums', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id');
          $table->integer('album_id');
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
      Schema::dropIfExists('user_albums');
  }
}
