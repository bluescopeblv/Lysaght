<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnIntoDeliveryInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_thongtinxe', function (Blueprint $table) {
            $table->dateTime('thoigiankehoachxera')->nullable();
            $table->string('maduan')->nullable();
            $table->string('sodonhang')->nullable();
            $table->string('tencs')->nullable();
            $table->double('chieudaihang')->nullable();
            $table->double('khoiluonghang')->nullable();
            $table->string('file_pickinglist')->nullable();
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
