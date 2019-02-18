<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('linkfile');
            $table->timestamps();
        });

        Schema::create('music_activity', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('music_info_id');
            $table->unsignedInteger('user_id');
            $table->dateTime('start')->nullable();
            $table->dateTime('finish')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedInteger('priority')->nullable();

            $table->foreign('music_info_id')->references('id')->on('music_info');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('music_activity');
        Schema::dropIfExists('music_info');
    }
}
