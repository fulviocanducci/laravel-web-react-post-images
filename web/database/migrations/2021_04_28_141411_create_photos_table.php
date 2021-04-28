<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('description', 100);
            $table->string('filename', 100);
            $table->string('ext', 4);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
