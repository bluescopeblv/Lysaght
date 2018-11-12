<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAudit5s extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fs_nhanvien_group', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('note')->nullable();
            $table->timestamps();
        });

        Schema::create('fs_nhanvien', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->unsignedInteger('group_id');
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('fs_nhanvien_group');
        });

        Schema::create('fs_campaign', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('note')->nullable();
            $table->timestamps(); 
        });

        Schema::create('fs_question_group', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('note')->nullable();
            $table->timestamps(); 
        });

        Schema::create('fs_question', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('stt')->nullable(); ;            
            $table->string('noidung');
            $table->string('chitieu')->nullable();
            $table->unsignedInteger('group_id');

            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('fs_question_group');

        });

        Schema::create('fs_chamdiem', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('nhanvien_group_id');
            $table->unsignedInteger('question_group_id');
            $table->unsignedInteger('campaign_id');
            $table->string('nguoidanhgia')->nullable();
            $table->string('truongnhomdanhgia')->nullable();
            $table->dateTime('ngaydanhgia')->nullable(); 
            $table->timestamps();

            $table->foreign('nhanvien_group_id')->references('id')->on('fs_nhanvien_group');
            $table->foreign('question_group_id')->references('id')->on('fs_question_group');
            $table->foreign('campaign_id')->references('id')->on('fs_campaign');
        });

        Schema::create('fs_chitiet', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('chamdiem_id');
            $table->unsignedInteger('cauhoi_id');
            $table->unsignedInteger('diem')->nullable();
            $table->string('nhanxet')->nullable();
            $table->timestamps(); 

            $table->foreign('chamdiem_id')->references('id')->on('fs_chamdiem');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::drop('fs_chitiet');
        Schema::drop('fs_chamdiem');
        Schema::drop('fs_question');
        Schema::drop('fs_question_group');
        Schema::drop('fs_nhanvien');        
        Schema::drop('fs_nhanvien_group');
        Schema::drop('fs_group');
    }
}
