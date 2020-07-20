<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrls extends Migration
{
    public function up()
    {
        Schema::create('urls', function (Blueprint $table) {
            $table->id();
            $table->text('url');
            $table->string('short_url')->unique()->nullable()->collation('utf8_bin');
            $table->timestamp('expire_at')->nullable();
            $table->boolean('is_commercial')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('urls');
    }
}
