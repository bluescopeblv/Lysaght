<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnIntoUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('quyen_kpi')->default(0)->after('quyen_activity');
            $table->unsignedInteger('quyen_music')->default(0);
            $table->unsignedInteger('quyen_ros')->default(0);
            $table->unsignedInteger('quyen_dashboard')->default(0);
            $table->unsignedInteger('ver')->default(0);
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
