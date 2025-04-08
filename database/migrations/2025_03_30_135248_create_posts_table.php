<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('garden_id');
            $table->string('garden_name');
            $table->string('plant_name');
            $table->string('local');
            $table->string('latin');
            $table->string('slug');
            $table->string('kingdom');
            $table->string('sub_kingdom');
            $table->string('super_division');
            $table->string('division');
            $table->string('class');
            $table->string('sub_class');
            $table->string('ordo');
            $table->string('famili');
            $table->string('genus');
            $table->string('species');
            $table->string('description');
            $table->string('plant_image');
            $table->string('leaf_image');
            $table->string('stem_image');
            $table->string('source');
            $table->string('link');
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
        Schema::dropIfExists('posts');
    }
}
