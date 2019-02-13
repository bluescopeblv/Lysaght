<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKpiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->decimal('MFG_VOLUME', 5, 2)->nullable(); 
            $table->decimal('MFG_OEE', 5, 2)->nullable(); 
            $table->decimal('MFG_UPTIME', 5, 2)->nullable();     
            $table->decimal('MFG_LOADINGTIME', 5, 2)->nullable();  
            $table->decimal('MFG_UNLOADING', 5, 2)->nullable();  
            $table->decimal('MFG_SCRAP_TON', 5, 2)->nullable(); 
            $table->decimal('MFG_SCRAP_PER', 5, 2)->nullable(); 
            $table->decimal('MFG_OVERTIME', 5, 2)->nullable();  
            $table->decimal('MFG_PRODUCTIVITY', 5, 2)->nullable(); 
            $table->decimal('MFG_LABOUR_UTILI', 5, 2)->nullable();  
            $table->decimal('MFG_POT', 5, 2)->nullable(); 
            $table->bigInteger('MFG_COVERSION_COST_MIL')->nullable();  

            $table->decimal('QC_DEFECT_NUMBER', 5, 2)->nullable(); 
            $table->bigInteger('QC_AMOUNT_OF_CODE')->nullable(); 
            $table->decimal('QC_COD_PER', 5, 2)->nullable(); 
            $table->decimal('QC_PERCENT_INHOUSE', 5, 2)->nullable();  
            $table->decimal('QC_PERCENT_OUTSCOURCE', 5, 2)->nullable(); 
            $table->decimal('QC_RATIO_PROACTIVE', 5, 2)->nullable(); 

            $table->decimal('MAI_BREAK_NUMBER', 5, 2)->nullable(); 
            $table->decimal('MAI_BREAK_LEADTIME', 5, 2)->nullable(); 
            $table->decimal('MAI_PERCEN_PREVENTIVE', 5, 2)->nullable();  
            $table->bigInteger('MAI_COST')->nullable(); 

            $table->decimal('OUT_INBOUND_TRUCK', 5, 2)->nullable();  
            $table->bigInteger('OUT_LOGICTIS_COST')->nullable();  
            $table->decimal('OUT_VOLUME', 5, 2)->nullable(); 
            $table->bigInteger('OUT_COST')->nullable(); 
            $table->bigInteger('OUT_ROS')->nullable(); 
            $table->bigInteger('OUT_ROS_COST')->nullable(); 

            $table->decimal('SAF_SAO_AUDIT', 5, 2)->nullable(); 
            $table->decimal('SAF_TIRED_SAO', 5, 2)->nullable(); 
            $table->decimal('SAF_QUALITY_CHECK', 5, 2)->nullable(); 
            
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
        Schema::dropIfExists('kpi');
    }
}
