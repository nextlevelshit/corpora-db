<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownloadsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('downloads', function (Blueprint $table) {
      $table->increments('id');

      // foreign key constraint on entry
      $table->integer('entry_id')->unsigned();
      $table->foreign('entry_id')
            ->references('id')->on('entries')
            ->onDelete('cascade');
      // foreign key constraint on texts
      $table->integer('text_id')->unsigned();
      $table->foreign('text_id')
            ->references('id')->on('texts')
            ->onDelete('cascade');

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
    Schema::dropIfExists('downloads');
  }
}
