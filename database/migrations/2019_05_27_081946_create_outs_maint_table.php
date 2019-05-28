<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutsMaintTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outs_maint_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('note')->nullable();
            $table->unsignedInteger('active')->nullable();
            $table->timestamps();
        });

        Schema::create('outs_maint_machine', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('note')->nullable();
            $table->unsignedInteger('active')->nullable();
            $table->timestamps();
        });

        Schema::create('outs_maint_activity', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('outs_maint_type_id');
            $table->unsignedInteger('outs_maint_machine_id');
            $table->unsignedInteger('user_id');
            $table->date('date')->nullable(); 
            $table->string('content')->nullable();
            $table->string('solution')->nullable();
            $table->date('solution_date')->nullable();
            $table->string('note')->nullable();
            $table->string('attach')->nullable();
            $table->unsignedInteger('active')->nullable();
            $table->timestamps();

            $table->foreign('outs_maint_type_id')->references('id')->on('outs_maint_type');
            $table->foreign('outs_maint_machine_id')->references('id')->on('outs_maint_machine');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outs_maint_activity');
        Schema::dropIfExists('outs_maint_machine');
        Schema::dropIfExists('outs_maint_type');
    }
}
