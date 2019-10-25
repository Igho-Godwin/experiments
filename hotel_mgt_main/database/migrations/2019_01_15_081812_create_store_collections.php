<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreCollections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_collections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_name');
            $table->integer('qty');
            $table->integer('user_id');
            $table->integer('added_by');
            $table->integer('status')->default(0);
            $table->double('unit_price');
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
        Schema::dropIfExists('store_collections');
    }
}
