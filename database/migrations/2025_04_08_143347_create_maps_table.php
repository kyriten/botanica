<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maps', function (Blueprint $table) {
            $table->id();
            $table->string('garden_id')->nullable();
            $table->string('province_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('garden_name');
            $table->string('province_name')->nullable();
            $table->string('city_name')->nullable();
            $table->string('plant_lat')->nullable();
            $table->string('plant_long')->nullable();
            $table->string('local');
            $table->string('latin');
            $table->string('slug')->nullable();
            $table->string('kingdom')->nullable();
            $table->string('sub_kingdom')->nullable();
            $table->string('super_division')->nullable();
            $table->string('division')->nullable();
            $table->string('class')->nullable();
            $table->string('sub_class')->nullable();
            $table->string('ordo')->nullable();
            $table->string('famili')->nullable();
            $table->string('genus')->nullable();
            $table->string('species')->nullable();
            $table->string('description')->nullable();
            $table->string('plant_image')->nullable();
            $table->string('leaf_image')->nullable();
            $table->string('stem_image')->nullable();
            // $table->string('source');
            // $table->string('link');
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
        Schema::dropIfExists('maps');
    }
}
