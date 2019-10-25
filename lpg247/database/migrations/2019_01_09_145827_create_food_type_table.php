<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->double('price');
            $table->integer('added_by');
            $table->integer('status')->default(0);
            $table->string('picture',100);
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
        Schema::dropIfExists('food_type');
    }
}
