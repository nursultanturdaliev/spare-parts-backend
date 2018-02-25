<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSparePartGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tetik_spare_part_groups',function (Blueprint $table){
           $table->increments('id');
           $table->string('name');
           $table->string('description');
           $table->string('href');
           $table->longText('content');
           $table->longText('thumbnail');
           $table->string('thumbnail_src');
           $table->longText('image');
           $table->longText('image_html');
           $table->unsignedInteger('spare_part_category_id');

            $table->foreign('spare_part_category_id')
                ->references('id')->on('tetik_spare_part_categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tetik_spare_part_groups');
    }
}
