<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('houses')) {
            Schema::create('houses', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->unsignedInteger('bedrooms');
                $table->unsignedInteger('bathrooms');
                $table->unsignedInteger('storeys');
                $table->unsignedInteger('garages');
                $table->integer('price');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
