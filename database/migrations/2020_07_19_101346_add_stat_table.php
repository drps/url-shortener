<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatTable extends Migration
{
    public function up()
    {
        Schema::create('stat', function (Blueprint $table) {
            $table->id();
            $table->integer('url_id')->references('id')->on('urls')->onDelete('CASCADE');
            $table->string('ip');
            $table->string('img')->nullable();
            $table->timestamps();

            $table->index('ip');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stat');
    }
}
