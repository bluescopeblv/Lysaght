<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDashboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard_mfg', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('oee');
            $table->unsignedInteger('multi_skill');
            $table->unsignedInteger('labor_utilization');
            $table->unsignedInteger('dispatch_leadtime');
            $table->unsignedInteger('cost_of_defect');
            $table->timestamps();
        });

        Schema::create('dashboard_sc', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('revenue');
            $table->unsignedInteger('actual_delivery');
            $table->unsignedInteger('backlog');
            $table->unsignedInteger('customer_complaint');
            $table->unsignedInteger('delivery_service'); 
            $table->timestamps();
        });

        Schema::create('dashboard_hr', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('total_employees');
            $table->unsignedInteger('female_employees');
            $table->timestamps();
        });

        Schema::create('dashboard_safety', function (Blueprint $table) {
            $table->increments('id');
            $table->date('LTI');
            $table->date('MTI');
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
        Schema::dropIfExists('dashboard_mfg');
        Schema::dropIfExists('dashboard_safety');
        Schema::dropIfExists('dashboard_hr');
        Schema::dropIfExists('dashboard_sc');
    }
}
