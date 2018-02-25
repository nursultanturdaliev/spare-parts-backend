<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSparePartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tetik_spare_parts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->string('name');
            $table->string('description');

            $table->unsignedInteger('spare_part_group_id');

            $table->foreign('spare_part_group_id')
                ->references('id')->on('tetik_spare_part_groups')
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
        Schema::dropIfExists('tetik_spare_parts');
    }
}
