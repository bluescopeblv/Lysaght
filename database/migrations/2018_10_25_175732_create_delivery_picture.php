<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryPicture extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_picture', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('thongtinxe_id');
            $table->string('link_hinh')->nullable();
            $table->timestamps();

            $table->foreign('thongtinxe_id')->references('id')->on('delivery_thongtinxe');

        });


        Schema::table('delivery_thongtinxe', function (Blueprint $table) {
            
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
