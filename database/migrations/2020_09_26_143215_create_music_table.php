<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('link_clone', 255);
            $table->string('uuid', 255);
            $table->integer('master_category_id');
            $table->integer('user_id')->nullable(true);
            $table->string('link', 255);
            $table->string('image', 255)->nullable(true);
            $table->integer('status')->default(0);
            $table->integer('view')->default(0);
            $table->integer('download')->default(0);
            $table->integer('liked')->default(0);
            $table->integer('disliked')->default(0);
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
        Schema::dropIfExists('music');
    }
}
