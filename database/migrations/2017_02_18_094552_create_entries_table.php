<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Entries are the mainly searchable increments with relations to
     * multiple authors, multiple texts and several identifing information.
     * Entries cannot be deleted, they can only be updated and purged by a
     * MySQL admin manuelly.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            // manually editable identifier
            $table->string('identifier');
            // foreign key constraint on genre
            $table->foreign('genre_id')
                ->references('id')->on('genres')
                ->onDelete('cascade');
            // publishing year
            $table->integer('year');

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
        Schema::dropIfExists('entries');
    }
}
