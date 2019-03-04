//<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnIntoProcureactivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('procu_activity', function (Blueprint $table) {
            $table->boolean('bl_layout_low')->default(false);
            $table->bigInteger('totalcost')->nullable();
            $table->unsignedInteger('a')->nullable();
            $table->unsignedInteger('b')->nullable();
            $table->unsignedInteger('L')->nullable();
            $table->text('para',1000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('procu_activity', function (Blueprint $table) {
            $table->dropColumn('bl_layout_low');
            $table->dropColumn('totalcost');
            $table->dropColumn('a');
            $table->dropColumn('b');
            $table->dropColumn('L');
            $table->dropColumn('para');
        });
        
         
    }
}
