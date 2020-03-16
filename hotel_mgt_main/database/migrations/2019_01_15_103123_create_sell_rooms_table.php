<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name',200);
            $table->integer('room_type');
            $table->integer('qty');
            $table->double('unit_price');
            $table->integer('added_by');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('sell_rooms');
    }
}
