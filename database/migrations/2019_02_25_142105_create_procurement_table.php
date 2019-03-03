<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proc_transportation_price', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location');
            $table->string('distance')->nullable();
            $table->bigInteger('machinery_movement')->nullable();
            $table->bigInteger('coil_movement')->nullable();
            $table->bigInteger('accessories_movement')->nullable();
            $table->timestamps();
        });

        Schema::create('procu_production_norm', function (Blueprint $table) {
            $table->increments('id');
            $table->string('profile')->nullable();
            $table->string('name');
            $table->unsignedInteger('distance_2_worker')->nullable();
            $table->unsignedInteger('finishgood_per_day')->nullable();
            $table->double('fuel')->nullable();
            $table->double('timber')->nullable();
            $table->double('pcs_default')->nullable();
            $table->double('kg_per_m2')->nullable();
            $table->double('w')->nullable();
            $table->double('covering_nylon')->nullable();
            $table->timestamps();
        });

        Schema::create('procu_estimated_price', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('crane_45_factory')->nullable();
            $table->bigInteger('crane_45_site')->nullable();
            $table->bigInteger('crane_80_site')->nullable();
            $table->bigInteger('crane_8_site')->nullable();
            $table->bigInteger('crane_liftjack')->nullable();
            $table->bigInteger('crane_hamer_liftjack')->nullable();
            $table->bigInteger('machines_insurance')->nullable();
            $table->bigInteger('genset_hiring')->nullable();
            $table->bigInteger('fuel_genset')->nullable();
            $table->bigInteger('daunoidien')->nullable();
            $table->bigInteger('electric_site')->nullable();
            $table->bigInteger('labour_cost')->nullable();
            $table->bigInteger('health_check')->nullable();
            $table->bigInteger('safety_certificate')->nullable();
            $table->bigInteger('insurance')->nullable();
            $table->bigInteger('technician')->nullable();
            $table->bigInteger('timber')->nullable();
            $table->bigInteger('safety_tool')->nullable();
            $table->bigInteger('covering_nylon')->nullable();
            $table->bigInteger('security')->nullable();
            $table->unsignedInteger('active')->default(1);
            //$table->bigInteger('service')->nullable();
            //$table->bigInteger(' ')->nullable();

            $table->timestamps();
        });

        Schema::create('procu_activity', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('quantity');
            $table->double('thickness')->nullable();
            $table->double('length');
            $table->double('weight')->nullable();

            $table->boolean('bl_electric_site');
            
            $table->boolean('bl_mini_layout')->nullable();
            $table->boolean('bl_technician')->nullable();
            $table->boolean('bl_operator_blv')->nullable();
            $table->unsignedInteger('crane_option')->nullable();

            $table->unsignedInteger('pcs_per_packet')->nullable();
            $table->unsignedInteger('point_run_number')->nullable();
            $table->unsignedInteger('point_finishgood_number')->nullable();

            $table->unsignedInteger('proc_transportation_price_id');
            $table->unsignedInteger('procu_production_norm_id');
            $table->unsignedInteger('procu_estimated_price_id');
            $table->unsignedInteger('user_id');

            $table->unsignedInteger('status')->default(0);
            $table->string('note')->nullable();
            $table->foreign('proc_transportation_price_id')->references('id')->on('proc_transportation_price');
            $table->foreign('procu_production_norm_id')->references('id')->on('procu_production_norm');
            $table->foreign('procu_estimated_price_id')->references('id')->on('procu_estimated_price');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('procu_setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('link1')->nullable();
            $table->string('link2')->nullable();
            $table->string('crane_priority')->nullable();
            $table->unsignedInteger('status')->nullable();
            $table->string('note');

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
        Schema::dropIfExists('procu_activity');
        Schema::dropIfExists('procu_estimated_price');
        Schema::dropIfExists('procu_production_norm');
        Schema::dropIfExists('proc_transportation_price');
        Schema::dropIfExists('procu_setting');
    }
}
