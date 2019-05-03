<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{

    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('words', function (Blueprint $table) {
            $table->increments('id');
            $table->string('word');
            $table->timestamps();
        });

        Schema::create('document_word', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('document_id');
            $table->integer('word_id');
            $table->integer('freq');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('documents');
        Schema::dropIfExists('words');
        Schema::dropIfExists('document_word');
    }
}
