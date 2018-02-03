<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTetikModelGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tetik_model_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->string('period');
            $table->string('production');
            $table->longText('years_content');
            $table->unsignedInteger('manufacturer_id');
            $table->unsignedInteger('country_id');

            $table->foreign('manufacturer_id')
                ->references('id')->on('tetik_manufacturers')
                ->onDelete('restrict');

            $table->foreign('country_id')
                ->references('id')->on('tetik_countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tetik_model_groups');
    }
}
