<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('texts', function (Blueprint $table) {
      $table->increments('id');

      // foreign key constrain on entry
      $table->integer('entry_id')->unsigned();
      $table->foreign('entry_id')
            ->references('id')->on('entries')
            ->onDelete('cascade');
      // path to text files
      $table->string('path');

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
    Schema::dropIfExists('texts');
  }
}
