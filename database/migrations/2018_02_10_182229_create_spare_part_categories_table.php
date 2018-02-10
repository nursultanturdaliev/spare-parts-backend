<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSparePartCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tetik_spare_part_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('thumbnail');
            $table->string('href');
            $table->longText('content');

            $table->unsignedInteger('model_group_year_id');

            $table->foreign('model_group_year_id')
                ->references('id')->on('tetik_model_group_years')
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
        Schema::dropIfExists('spare_part_categories');
    }
}
